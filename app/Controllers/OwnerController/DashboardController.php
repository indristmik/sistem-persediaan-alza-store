<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class DashboardController extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();

        $produkModel = new ProdukModel();

        // ==============================
        // PERIODE
        // ==============================

        $hariIni   = date('Y-m-d');
        $awalBulan = date('Y-m-01');
        $akhirBulan = date('Y-m-t');

        // ==============================
        // 1. TOTAL PRODUK
        // ==============================

        $totalProduk = $produkModel->countAll();

        // ==============================
        // 2. TOTAL VARIAN
        // ==============================

        $totalVarian = $db->table('varian_produk')
            ->countAllResults();

        // ==============================
        // DATA STOK TERAKHIR
        // ==============================

        // Ambil pergerakan terakhir setiap varian
        $stokTerakhir = "
            SELECT ps1.id_varian, ps1.saldo_stok
            FROM pergerakan_stok ps1
            INNER JOIN (
                SELECT id_varian, MAX(id_pergerakan) AS id_terakhir
                FROM pergerakan_stok
                GROUP BY id_varian
            ) ps2
            ON ps1.id_pergerakan = ps2.id_terakhir
        ";

        // ==============================
        // 3. TOTAL STOK
        // ==============================

        $totalStok = $db->table('varian_produk v')
            ->join(
                "($stokTerakhir) ps",
                'ps.id_varian = v.id_varian',
                'left',
                false
            )
            ->select('COALESCE(SUM(ps.saldo_stok), 0) AS total_stok', false)
            ->get()
            ->getRow()
            ->total_stok;

        // ==============================
        // 4. STOK MENIPIS
        // ==============================

        // $stokMenipis = $db->table('varian_produk v')
        //     ->select("
        //         v.id_varian,
        //         v.kode_sku,
        //         v.warna,
        //         v.ukuran,
        //         v.stok_minimum,
        //         p.nama_produk,
        //         COALESCE(ps.saldo_stok, 0) AS stok_sekarang
        //     ", false)
        //     ->join(
        //         'tb_produk p',
        //         'p.id_produk = v.id_produk'
        //     )
        //     ->join(
        //         "($stokTerakhir) ps",
        //         'ps.id_varian = v.id_varian',
        //         'left',
        //         false
        //     )
        //     ->where(
        //         'COALESCE(ps.saldo_stok, 0) <= v.stok_minimum',
        //         null,
        //         false
        //     )
        //     ->orderBy('stok_sekarang', 'ASC')
        //     ->get()
        //     ->getResultArray();

        $stokMenipis = $db->query("
    SELECT
        v.id_varian,
        v.kode_sku,
        v.warna,
        v.ukuran,
        v.stok_minimum,
        p.nama_produk,
        COALESCE(ps.saldo_stok, 0) AS stok_sekarang
    FROM varian_produk v
    JOIN tb_produk p
        ON p.id_produk = v.id_produk
    LEFT JOIN ($stokTerakhir) ps
        ON ps.id_varian = v.id_varian
    WHERE COALESCE(ps.saldo_stok, 0) <= v.stok_minimum
    ORDER BY stok_sekarang ASC
")->getResultArray();

        // ==============================
        // 5. BARANG MASUK BULAN INI
        // ==============================

        $barangMasuk = $db->table('detail_transaksi_masuk d')
            ->select('COALESCE(SUM(d.jumlah), 0) AS total')
            ->join(
                'transaksi_masuk tm',
                'tm.id_transaksi_masuk = d.id_transaksi_masuk'
            )
            ->where('tm.tanggal_masuk >=', $awalBulan)
            ->where('tm.tanggal_masuk <', date('Y-m-d', strtotime($akhirBulan . ' +1 day')))
            ->get()
            ->getRow()
            ->total;

        // ==============================
        // 6. BARANG KELUAR BULAN INI
        // ==============================

        $barangKeluar = $db->table('detail_transaksi_keluar d')
            ->select('COALESCE(SUM(d.jumlah), 0) AS total')
            ->join(
                'transaksi_keluar tk',
                'tk.id_transaksi_keluar = d.id_transaksi_keluar'
            )
            ->where('tk.tanggal_keluar >=', $awalBulan)
            ->where('tk.tanggal_keluar <', date('Y-m-d', strtotime($akhirBulan . ' +1 day')))
            ->get()
            ->getRow()
            ->total;

        // ==============================
        // 7. JUMLAH TRANSAKSI BULAN INI
        // ==============================

        $transaksiMasuk = $db->table('transaksi_masuk')
            ->where('tanggal_masuk >=', $awalBulan)
            ->where('tanggal_masuk <', date('Y-m-d', strtotime($akhirBulan . ' +1 day')))
            ->countAllResults();

        $transaksiKeluar = $db->table('transaksi_keluar')
            ->where('tanggal_keluar >=', $awalBulan)
            ->where('tanggal_keluar <', date('Y-m-d', strtotime($akhirBulan . ' +1 day')))
            ->countAllResults();

        // ==============================
        // 8. GRAFIK 7 HARI TERAKHIR
        // ==============================

        $tanggalGrafik = [];
        $dataMasuk = [];
        $dataKeluar = [];

        for ($i = 6; $i >= 0; $i--) {

            $tanggal = date('Y-m-d', strtotime("-$i days"));

            $tanggalGrafik[] = date('d M', strtotime($tanggal));

            // Total jumlah barang masuk
            $masuk = $db->table('detail_transaksi_masuk d')
                ->select('COALESCE(SUM(d.jumlah), 0) AS total')
                ->join(
                    'transaksi_masuk tm',
                    'tm.id_transaksi_masuk = d.id_transaksi_masuk'
                )
                ->where('tm.tanggal_masuk >=', $tanggal . ' 00:00:00')
                ->where('tm.tanggal_masuk <', date('Y-m-d', strtotime($tanggal . ' +1 day')) . ' 00:00:00')
                ->get()
                ->getRow()
                ->total;

            // Total jumlah barang keluar
            $keluar = $db->table('detail_transaksi_keluar d')
                ->select('COALESCE(SUM(d.jumlah), 0) AS total')
                ->join(
                    'transaksi_keluar tk',
                    'tk.id_transaksi_keluar = d.id_transaksi_keluar'
                )
                ->where('tk.tanggal_keluar >=', $tanggal . ' 00:00:00')
                ->where('tk.tanggal_keluar <', date('Y-m-d', strtotime($tanggal . ' +1 day')) . ' 00:00:00')
                ->get()
                ->getRow()
                ->total;

            $dataMasuk[] = (int) $masuk;
            $dataKeluar[] = (int) $keluar;
        }

        // ==============================
        // 9. TRANSAKSI TERBARU
        // ==============================

        $sqlTransaksi = "
            SELECT
                tm.nomor_referensi AS referensi,
                tm.tanggal_masuk AS tanggal,
                tm.status_transaksi AS status,
                'Masuk' AS jenis,
                COALESCE(d.jumlah, 0) AS jumlah
            FROM transaksi_masuk tm
            LEFT JOIN (
                SELECT id_transaksi_masuk, SUM(jumlah) AS jumlah
                FROM detail_transaksi_masuk
                GROUP BY id_transaksi_masuk
            ) d ON d.id_transaksi_masuk = tm.id_transaksi_masuk

            UNION ALL

            SELECT
                tk.nomor_pesanan AS referensi,
                tk.tanggal_keluar AS tanggal,
                tk.status_transaksi AS status,
                'Keluar' AS jenis,
                COALESCE(d.jumlah, 0) AS jumlah
            FROM transaksi_keluar tk
            LEFT JOIN (
                SELECT id_transaksi_keluar, SUM(jumlah) AS jumlah
                FROM detail_transaksi_keluar
                GROUP BY id_transaksi_keluar
            ) d ON d.id_transaksi_keluar = tk.id_transaksi_keluar

            ORDER BY tanggal DESC
            LIMIT 5
        ";

        $transaksiTerbaru = $db->query($sqlTransaksi)
            ->getResultArray();

        // ==============================
        // KIRIM DATA KE VIEW
        // ==============================

        $data = [
            'tanggalHariIni' => $hariIni,

            'totalProduk' => $totalProduk,
            'totalVarian' => $totalVarian,
            'totalStok' => $totalStok,

            'stokMenipis' => $stokMenipis,

            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,

            'transaksiMasuk' => $transaksiMasuk,
            'transaksiKeluar' => $transaksiKeluar,

            'tanggalGrafik' => $tanggalGrafik,
            'dataMasuk' => $dataMasuk,
            'dataKeluar' => $dataKeluar,

            'transaksiTerbaru' => $transaksiTerbaru,
        ];

        return view('Owner/Dashboard', $data);
    }
}
