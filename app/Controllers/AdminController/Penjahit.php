<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\PenjahitModel;

class Penjahit extends BaseController
{
    protected $penjahitModel;

    public function __construct()
    {
        $this->penjahitModel = new PenjahitModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Penjahit',
            'penjahit' => $this->penjahitModel->orderBy('id_penjahit', 'DESC')->findAll(),
        ];

        return view('Admin/penjahit/index', $data);
    }

    public function simpan()
    {
        $status = $this->request->getPost('status_aktif')
            ?: ($this->request->getPost('status') ?: 'Aktif');

        $this->penjahitModel->save([
            'nama_penjahit' => $this->request->getPost('nama_penjahit'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'alamat'        => $this->request->getPost('alamat'),
            'status_aktif'  => $status,
        ]);

        return redirect()->to('/Admin/Penjahit')->with('pesan', 'Mitra penjahit baru berhasil ditambahkan.');
    }

    public function update($id)
    {
        $status = $this->request->getPost('status_aktif')
            ?: ($this->request->getPost('status') ?: 'Aktif');

        $this->penjahitModel->update($id, [
            'nama_penjahit' => $this->request->getPost('nama_penjahit'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'alamat'        => $this->request->getPost('alamat'),
            'status_aktif'  => $status,
        ]);

        return redirect()->to('/Admin/Penjahit')->with('pesan', 'Data penjahit berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $db = \Config\Database::connect();

        // Proteksi Hapus: Cek riwayat di transaksi_masuk
        $riwayat = $db->table('transaksi_masuk')
            ->where('id_penjahit', $id)
            ->countAllResults();

        if ($riwayat > 0) {
            return redirect()->to('/Admin/Penjahit')->with(
                'error',
                'Gagal menghapus! Penjahit ini sudah memiliki riwayat transaksi masuk. Silakan klik Edit dan ubah statusnya menjadi Nonaktif.'
            );
        }

        $this->penjahitModel->delete($id);
        return redirect()->to('/Admin/Penjahit')->with('pesan', 'Data penjahit berhasil dihapus.');
    }
}