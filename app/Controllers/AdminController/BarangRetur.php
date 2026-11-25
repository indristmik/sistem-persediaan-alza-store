<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\BarangReturModel;

class BarangRetur extends BaseController
{
    protected $barangReturModel;
    protected $db;

    public function __construct()
    {
        $this->barangReturModel = new BarangReturModel();
        $this->db               = \Config\Database::connect();
    }

    public function index()
    {
        $saluran = $this->db->table('saluran_penjualan')
            ->where('status', 'Aktif')
            ->get()
            ->getResultArray();

        $varian = $this->db->table('varian_produk vp')
            ->select('vp.id_varian, vp.kode_sku, vp.warna, vp.ukuran, pr.nama_produk')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('pr.nama_produk', 'ASC')
            ->get()
            ->getResultArray();

        // Ambil daftar transaksi keluar untuk dropdown referensi resi (opsional)
        $transaksiKeluar = $this->db->table('transaksi_keluar tk')
            ->select('
                tk.id_transaksi_keluar,
                tk.nomor_pesanan,
                tk.no_resi,
                tk.id_saluran,
                sp.nama_saluran,
                dtk.id_varian,
                dtk.jumlah as jumlah_keluar,
                pr.nama_produk,
                vp.ukuran,
                vp.warna,
                COALESCE((
                    SELECT SUM(rb.jumlah_retur)
                    FROM tb_retur_barang rb
                    WHERE rb.id_transaksi_keluar = tk.id_transaksi_keluar
                      AND rb.id_varian = dtk.id_varian
                ), 0) as sudah_diretur
            ')
            ->join('saluran_penjualan sp', 'sp.id_saluran = tk.id_saluran', 'left')
            ->join('detail_transaksi_keluar dtk', 'dtk.id_transaksi_keluar = tk.id_transaksi_keluar')
            ->join('varian_produk vp', 'vp.id_varian = dtk.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('tk.tanggal_keluar', 'DESC')
            ->orderBy('tk.id_transaksi_keluar', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title'            => 'Barang Retur',
            'barang_retur'     => $this->barangReturModel->getBarangReturLengkap(),
            'saluran'          => $saluran,
            'varian'           => $varian,
            'transaksi_keluar' => $transaksiKeluar
        ];

        return view('Admin/barang_retur/index', $data);
    }

    public function simpan()
    {
        $idTransaksiKeluar = $this->request->getPost('id_transaksi_keluar') ?: null;
        $idSaluran         = $this->request->getPost('id_saluran');
        $idVarian          = $this->request->getPost('id_varian');
        $jumlahRetur       = (int) $this->request->getPost('jumlah_retur');
        $kategoriRetur     = $this->request->getPost('kategori_retur');
        $tindakLanjut      = $this->request->getPost('tindak_lanjut');
        $alasan            = trim((string) $this->request->getPost('alasan'));

        if ($jumlahRetur <= 0) {
            return redirect()->to('/Admin/BarangRetur')
                ->with('error', 'Gagal! Jumlah barang retur harus lebih dari 0 pcs.');
        }

        // Validasi Retur Sebagian: jika memilih referensi transaksi keluar, cek agar tidak melebihi jumlah beli
        if (!empty($idTransaksiKeluar)) {
            $detailKeluar = $this->db->table('detail_transaksi_keluar')
                ->where('id_transaksi_keluar', $idTransaksiKeluar)
                ->where('id_varian', $idVarian)
                ->get()
                ->getRowArray();

            if ($detailKeluar) {
                $sudahDiretur = (int) ($this->db->table('tb_retur_barang')
                    ->selectSum('jumlah_retur')
                    ->where('id_transaksi_keluar', $idTransaksiKeluar)
                    ->where('id_varian', $idVarian)
                    ->get()
                    ->getRow()->jumlah_retur ?? 0);

                $sisaBisaDiretur = (int) $detailKeluar['jumlah'] - $sudahDiretur;

                if ($jumlahRetur > $sisaBisaDiretur) {
                    return redirect()->to('/Admin/BarangRetur')
                        ->with('error', 'Gagal! Jumlah retur (' . $jumlahRetur . ' pcs) melebihi sisa barang yang bisa diretur dari transaksi ini (maksimal ' . $sisaBisaDiretur . ' pcs).');
                }
            }
        }

        $tanggalRetur = $this->request->getPost('tanggal_retur') . ' ' . date('H:i:s');
        $idPengguna   = session()->get('id_pengguna') ?? 1;
        $kodeRetur    = $this->barangReturModel->generateKodeRetur();

        try {
            $this->db->transException(true)->transStart();

            // 1. Simpan data ke tabel tb_retur_barang
            $this->barangReturModel->insert([
                'nomor_retur'         => $kodeRetur,
                'id_saluran'          => $idSaluran,
                'id_transaksi_keluar' => $idTransaksiKeluar,
                'id_varian'           => $idVarian,
                'jumlah_retur'        => $jumlahRetur,
                'kategori_retur'      => $kategoriRetur,
                'tindak_lanjut'       => $tindakLanjut,
                'alasan'              => $alasan,
                'tanggal_retur'       => $tanggalRetur,
                'id_pengguna'         => $idPengguna
            ]);
            $idRetur = $this->barangReturModel->getInsertID();

            // 2. HANYA jika "Layak Jual Kembali", tambahkan ke pergerakan_stok
            if ($tindakLanjut === 'Layak Jual Kembali') {
                $stokLama = (int) ($this->db->table('pergerakan_stok')
                    ->selectSum('jumlah')
                    ->where('id_varian', $idVarian)
                    ->get()
                    ->getRow()->jumlah ?? 0);

                $this->db->table('pergerakan_stok')->insert([
                    'id_varian'          => $idVarian,
                    'tipe_pergerakan'    => 'MASUK',
                    'id_retur'           => $idRetur,
                    'jumlah'             => $jumlahRetur,
                    'saldo_stok'         => $stokLama + $jumlahRetur,
                    'keterangan'         => 'Retur Masuk - Layak Jual (' . $kodeRetur . ')',
                    'tanggal_pergerakan' => $tanggalRetur,
                    'id_pengguna'        => $idPengguna
                ]);
            }

            $this->db->transComplete();

            return redirect()->to('/Admin/BarangRetur')
                ->with('pesan', 'Data retur <strong>' . $kodeRetur . '</strong> berhasil dicatat.');

        } catch (\Throwable $e) {
            return redirect()->to('/Admin/BarangRetur')
                ->with('error', 'Error SQL: ' . $e->getMessage());
        }
    }

    public function hapus($id)
    {
        $retur = $this->barangReturModel->find($id);

        if (!$retur) {
            return redirect()->to('/Admin/BarangRetur')
                ->with('error', 'Data barang retur tidak ditemukan.');
        }

        // Tolak hapus jika barang retur Layak Jual sudah terlanjur terjual (cegah stok minus)
        if ($retur['tindak_lanjut'] === 'Layak Jual Kembali') {
            $stokSaatIni = (int) ($this->db->table('pergerakan_stok')
                ->selectSum('jumlah')
                ->where('id_varian', $retur['id_varian'])
                ->get()
                ->getRow()->jumlah ?? 0);

            if ($stokSaatIni < (int) $retur['jumlah_retur']) {
                return redirect()->to('/Admin/BarangRetur')
                    ->with('error', 'Gagal menghapus! Sisa stok saat ini (' . $stokSaatIni . ' pcs) lebih kecil dari jumlah retur (' . $retur['jumlah_retur'] . ' pcs) karena sebagian barang sudah terjual.');
            }
        }

        try {
            $this->db->transException(true)->transStart();
            $this->db->table('pergerakan_stok')->where('id_retur', $id)->delete();
            $this->barangReturModel->delete($id);
            $this->db->transComplete();

            return redirect()->to('/Admin/BarangRetur')
                ->with('pesan', 'Data barang retur berhasil dihapus dan stok telah disesuaikan.');

        } catch (\Throwable $e) {
            return redirect()->to('/Admin/BarangRetur')
                ->with('error', 'Error SQL saat menghapus: ' . $e->getMessage());
        }
    }
}