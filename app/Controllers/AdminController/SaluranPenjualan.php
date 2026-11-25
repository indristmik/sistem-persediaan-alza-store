<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\SaluranPenjualanModel;

class SaluranPenjualan extends BaseController
{
    protected $saluranModel;
    protected $db;

    public function __construct()
    {
        $this->saluranModel = new SaluranPenjualanModel();
        $this->db           = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title'   => 'Data Saluran Penjualan',
            'saluran' => $this->saluranModel->getSaluranLengkap(),
        ];

        return view('Admin/saluran_penjualan/index', $data);
    }

    public function simpan()
    {
        $nama   = trim((string) $this->request->getPost('nama_saluran'));
        $status = $this->request->getPost('status') ?: 'Aktif';

        $this->saluranModel->insert([
            'nama_saluran' => $nama,
            'status'       => $status,
        ]);

        return redirect()->to('/Admin/SaluranPenjualan')
            ->with('pesan', 'Saluran penjualan <strong>' . esc($nama) . '</strong> berhasil ditambahkan.');
    }

    public function update($id)
    {
        $nama   = trim((string) $this->request->getPost('nama_saluran'));
        $status = $this->request->getPost('status') ?: 'Aktif';

        $this->saluranModel->update($id, [
            'nama_saluran' => $nama,
            'status'       => $status,
        ]);

        return redirect()->to('/Admin/SaluranPenjualan')
            ->with('pesan', 'Saluran penjualan <strong>' . esc($nama) . '</strong> berhasil diperbarui.');
    }

    public function hapus($id)
    {
        // Cek apakah saluran sudah memiliki riwayat transaksi di barang_keluar
        $dipakai = $this->db->table('transaksi_keluar')
            ->where('id_saluran', $id)
            ->countAllResults();

        if ($dipakai > 0) {
            return redirect()->to('/Admin/SaluranPenjualan')
                ->with('error', 'Gagal menghapus! Saluran ini sudah memiliki <strong>' . $dipakai . ' riwayat transaksi</strong>. Ubah status menjadi <strong>Nonaktif</strong> jika sudah tidak digunakan.');
        }

        $this->saluranModel->delete($id);

        return redirect()->to('/Admin/SaluranPenjualan')
            ->with('pesan', 'Data saluran penjualan berhasil dihapus.');
    }
}