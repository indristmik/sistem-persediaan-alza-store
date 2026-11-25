<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;
    protected $db;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->db            = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Kategori Produk',
            'kategori' => $this->kategoriModel->getKategoriLengkap(),
        ];

        return view('Admin/kategori/index', $data);
    }

    public function simpan()
    {
        $kode = strtoupper(trim((string) $this->request->getPost('kode_kategori')));
        $nama = trim((string) $this->request->getPost('nama_kategori'));
        $desk = trim((string) $this->request->getPost('deskripsi'));

        $this->kategoriModel->insert([
            'kode_produk'   => $kode,
            'nama_kategori' => $nama,
            'deskripsi'     => $desk ?: null,
        ]);

        return redirect()->to('/Admin/Kategori')
            ->with('pesan', 'Kategori <strong>' . esc($nama) . ' (' . esc($kode) . ')</strong> berhasil ditambahkan.');
    }

    public function update($id)
    {
        $kode = strtoupper(trim((string) $this->request->getPost('kode_kategori')));
        $nama = trim((string) $this->request->getPost('nama_kategori'));
        $desk = trim((string) $this->request->getPost('deskripsi'));

        $this->kategoriModel->update($id, [
            'kode_produk'   => $kode,
            'nama_kategori' => $nama,
            'deskripsi'     => $desk ?: null,
        ]);

        return redirect()->to('/Admin/Kategori')
            ->with('pesan', 'Kategori <strong>' . esc($nama) . ' (' . esc($kode) . ')</strong> berhasil diperbarui.');
    }

    public function hapus($id)
    {
        // Cek apakah kategori masih dipakai di tabel tb_produk
        $dipakai = $this->db->table('tb_produk')
            ->where('id_kategori', $id)
            ->countAllResults();

        if ($dipakai > 0) {
            return redirect()->to('/Admin/Kategori')
                ->with('error', 'Gagal menghapus! Kategori ini masih digunakan oleh <strong>' . $dipakai . ' produk</strong> aktif.');
        }

        $this->kategoriModel->delete($id);

        return redirect()->to('/Admin/Kategori')
            ->with('pesan', 'Data kategori produk berhasil dihapus.');
    }
}