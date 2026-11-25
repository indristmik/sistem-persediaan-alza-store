<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel   = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    // Menampilkan halaman utama Data Produk
    public function index()
    {
        $data = [
            'title'    => 'Data Produk',
            'produk'   => $this->produkModel->getProdukDenganStok(),
            'kategori' => $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll()
        ];

        return view('Admin/produk/index', $data);
    }

    // Helper internal: validasi & simpan file foto ke public/uploads/produk/
    private function prosesUploadFoto($file): array
    {
        if (!$file || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return ['status' => 'empty', 'filename' => null];
        }

        if (!$file->isValid()) {
            return ['status' => 'error', 'message' => 'Upload foto gagal: ' . $file->getErrorString()];
        }

        $allowedMime = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMime, true)) {
            return ['status' => 'error', 'message' => 'Format foto tidak didukung. Gunakan JPG, PNG, atau WEBP.'];
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return ['status' => 'error', 'message' => 'Ukuran foto terlalu besar. Maksimal 2 MB.'];
        }

        $uploadPath = FCPATH . 'uploads/produk';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $namaBaru = $file->getRandomName();
        $file->move($uploadPath, $namaBaru);

        return ['status' => 'ok', 'filename' => $namaBaru];
    }

    // Helper internal: hapus file fisik foto lama jika ada
    private function hapusFileFoto(?string $namaFile): void
    {
        if (!empty($namaFile)) {
            $path = FCPATH . 'uploads/produk/' . $namaFile;
            if (is_file($path)) {
                @unlink($path);
            }
        }
    }

    // Memproses penyimpanan produk baru + upload foto opsional
    public function simpan()
    {
        $hasilUpload = $this->prosesUploadFoto($this->request->getFile('foto'));
        if ($hasilUpload['status'] === 'error') {
            return redirect()->to('/Admin/Produk')->with('error', $hasilUpload['message']);
        }

        $this->produkModel->save([
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $hasilUpload['filename'],
        ]);

        return redirect()->to('/Admin/Produk')->with('pesan', 'Produk berhasil ditambahkan.');
    }

    // Memproses update data produk + ganti/hapus foto
    public function update($id)
    {
        $produkLama = $this->produkModel->find($id);
        if (!$produkLama) {
            return redirect()->to('/Admin/Produk')->with('error', 'Data produk tidak ditemukan.');
        }

        $namaFoto    = $produkLama['foto'] ?? null;
        $hapusFoto   = $this->request->getPost('hapus_foto') === '1';
        $hasilUpload = $this->prosesUploadFoto($this->request->getFile('foto'));

        if ($hasilUpload['status'] === 'error') {
            return redirect()->to('/Admin/Produk')->with('error', $hasilUpload['message']);
        }

        if ($hasilUpload['status'] === 'ok') {
            // Hapus foto lama jika user mengunggah foto baru
            $this->hapusFileFoto($namaFoto);
            $namaFoto = $hasilUpload['filename'];
        } elseif ($hapusFoto) {
            // Hapus foto lama jika user mencentang opsi hapus foto
            $this->hapusFileFoto($namaFoto);
            $namaFoto = null;
        }

        $this->produkModel->update($id, [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $namaFoto,
        ]);

        return redirect()->to('/Admin/Produk')->with('pesan', 'Data produk berhasil diperbarui.');
    }

    // Menghapus produk beserta variannya & file fotonya (dengan proteksi riwayat transaksi)
    public function hapus($id)
    {
        $db         = \Config\Database::connect();
        $produkLama = $this->produkModel->find($id);

        if (!$produkLama) {
            return redirect()->to('/Admin/Produk')->with('error', 'Data produk tidak ditemukan.');
        }

        // Cek apakah ada varian dari produk ini yang sudah pernah dipakai transaksi stok
        $varianProduk = $db->table('varian_produk')
            ->select('id_varian')
            ->where('id_produk', $id)
            ->get()
            ->getResultArray();

        foreach ($varianProduk as $v) {
            if ($this->produkModel->varianPunyaRiwayat((int) $v['id_varian'])) {
                return redirect()->to('/Admin/Produk')
                    ->with('error', 'Gagal! Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi stok.');
            }
        }

        // Hapus file foto, varian, lalu produk
        $this->hapusFileFoto($produkLama['foto'] ?? null);
        $db->table('varian_produk')->where('id_produk', $id)->delete();
        $this->produkModel->delete($id);

        return redirect()->to('/Admin/Produk')->with('pesan', 'Produk berhasil dihapus.');
    }

    // Simpan Varian Baru (Validasi Ukuran Kembar & SKU Unik)
    public function simpanVarian()
    {
        $db       = \Config\Database::connect();
        $idProduk = (int) $this->request->getPost('id_produk');
        $ukuran   = strtoupper(trim((string) $this->request->getPost('ukuran')));
        $kodeSku  = trim((string) $this->request->getPost('kode_sku'));

        $cekSku = $db->table('varian_produk')->where('kode_sku', $kodeSku)->countAllResults();
        if ($cekSku > 0) {
            return redirect()->to('/Admin/Produk')
                ->with('error', 'Gagal! Kode SKU "' . $kodeSku . '" sudah digunakan oleh produk lain.');
        }

        $cekUkuran = $db->table('varian_produk')
            ->where('id_produk', $idProduk)
            ->where('ukuran', $ukuran)
            ->countAllResults();
        if ($cekUkuran > 0) {
            return redirect()->to('/Admin/Produk')
                ->with('error', 'Gagal! Ukuran ' . $ukuran . ' sudah terdaftar pada produk ini.');
        }

        $hargaInput   = $this->request->getPost('harga_jual');
        $stokMinInput = $this->request->getPost('stok_minimum');

        $db->table('varian_produk')->insert([
            'id_produk'    => $idProduk,
            'kode_sku'     => $kodeSku,
            'warna'        => trim((string) $this->request->getPost('warna')),
            'ukuran'       => $ukuran,
            'harga_jual'   => ($hargaInput !== null && $hargaInput !== '') ? max(0, (int) $hargaInput) : 0,
            'stok_minimum' => ($stokMinInput !== null && $stokMinInput !== '') ? max(0, (int) $stokMinInput) : 10,
        ]);

        return redirect()->to('/Admin/Produk')->with('pesan', 'Varian ' . $kodeSku . ' berhasil ditambahkan.');
    }

    // Update Varian Lengkap (Stok dikunci)
    public function updateVarian($idVarian)
    {
        $db       = \Config\Database::connect();
        $idProduk = (int) $this->request->getPost('id_produk');
        $ukuran   = strtoupper(trim((string) $this->request->getPost('ukuran')));
        $kodeSku  = trim((string) $this->request->getPost('kode_sku'));

        $cekSku = $db->table('varian_produk')
            ->where('kode_sku', $kodeSku)
            ->where('id_varian !=', $idVarian)
            ->countAllResults();
        if ($cekSku > 0) {
            return redirect()->to('/Admin/Produk')
                ->with('error', 'Gagal! Kode SKU "' . $kodeSku . '" sudah digunakan.');
        }

        $cekUkuran = $db->table('varian_produk')
            ->where('id_produk', $idProduk)
            ->where('ukuran', $ukuran)
            ->where('id_varian !=', $idVarian)
            ->countAllResults();
        if ($cekUkuran > 0) {
            return redirect()->to('/Admin/Produk')
                ->with('error', 'Gagal! Ukuran ' . $ukuran . ' sudah terdaftar pada produk ini.');
        }

        $hargaInput   = $this->request->getPost('harga_jual');
        $stokMinInput = $this->request->getPost('stok_minimum');

        $db->table('varian_produk')->where('id_varian', $idVarian)->update([
            'kode_sku'     => $kodeSku,
            'warna'        => trim((string) $this->request->getPost('warna')),
            'ukuran'       => $ukuran,
            'harga_jual'   => ($hargaInput !== null && $hargaInput !== '') ? max(0, (int) $hargaInput) : 0,
            'stok_minimum' => ($stokMinInput !== null && $stokMinInput !== '') ? max(0, (int) $stokMinInput) : 10,
        ]);

        return redirect()->to('/Admin/Produk')->with('pesan', 'Data varian berhasil diperbarui.');
    }

    // Update Cepat Batas Minimum dari tabel di Modal + Ukuran
    public function updateStokMinimum($idVarian)
    {
        $db       = \Config\Database::connect();
        $idVarian = (int) $idVarian;

        $varian = $db->table('varian_produk')
            ->where('id_varian', $idVarian)
            ->get()
            ->getRowArray();

        if (!$varian) {
            return redirect()->to('/Admin/Produk')->with('error', 'Data ukuran tidak ditemukan.');
        }

        $stokMinInput = $this->request->getPost('stok_minimum');
        $stokMinimum  = ($stokMinInput !== null && $stokMinInput !== '') ? max(0, (int) $stokMinInput) : 0;

        $db->table('varian_produk')
            ->where('id_varian', $idVarian)
            ->update(['stok_minimum' => $stokMinimum]);

        return redirect()->to('/Admin/Produk')
            ->with('pesan', 'Batas minimum ukuran ' . $varian['ukuran'] . ' berhasil diperbarui menjadi ' . $stokMinimum . '.');
    }

    // Menghapus 1 varian berdasarkan ID (hanya jika belum punya riwayat transaksi)
    public function hapusVarian($idVarian)
    {
        $db       = \Config\Database::connect();
        $idVarian = (int) $idVarian;

        $varian = $db->table('varian_produk')
            ->where('id_varian', $idVarian)
            ->get()
            ->getRowArray();

        if (!$varian) {
            return redirect()->to('/Admin/Produk')->with('error', 'Data ukuran tidak ditemukan.');
        }

        if ($this->produkModel->varianPunyaRiwayat($idVarian)) {
            return redirect()->to('/Admin/Produk')
                ->with('error', 'Gagal! Ukuran ' . $varian['ukuran'] . ' tidak dapat dihapus karena sudah memiliki riwayat transaksi stok.');
        }

        $db->table('varian_produk')->where('id_varian', $idVarian)->delete();

        return redirect()->to('/Admin/Produk')
            ->with('pesan', 'Ukuran ' . $varian['ukuran'] . ' berhasil dihapus.');
    }
}