<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $laporanModel;
    protected $db;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();$this->db           = \Config\Database::connect();
    }

    public function index()
    {
        // Default tab adalah 'masuk' (pilihan: masuk, keluar, retur, stok)
        $jenis        =$this->request->getGet('jenis') ?: 'masuk';
        $tglMulai     =$this->request->getGet('tgl_mulai') ?: date('Y-m-01');
        $tglSelesai   =$this->request->getGet('tgl_selesai') ?: date('Y-m-d');
        $idPenjahit   =$this->request->getGet('id_penjahit');
        $idSaluran    =$this->request->getGet('id_saluran');
        $tindakLanjut =$this->request->getGet('tindak_lanjut');
        $idKategori   =$this->request->getGet('id_kategori');
        $statusStok   =$this->request->getGet('status_stok');

        $errorTanggal = null;
        $laporan      = [];

        // Validasi Kasus Batas: Rentang Tanggal Terbalik
        if ($jenis !== 'stok' &&$tglMulai > $tglSelesai) {$errorTanggal = 'Rentang tanggal tidak valid! Tanggal Awal (' . date('d/m/Y', strtotime($tglMulai)) . ') tidak boleh lebih besar daripada Tanggal Akhir (' . date('d/m/Y', strtotime($tglSelesai)) . ').';
        } else {
            if ($jenis === 'masuk') {$laporan = $this->laporanModel->getLaporanMasuk($tglMulai, $tglSelesai,$idPenjahit);
            } elseif ($jenis === 'keluar') {$laporan = $this->laporanModel->getLaporanKeluar($tglMulai, $tglSelesai,$idSaluran);
            } elseif ($jenis === 'retur') {$laporan = $this->laporanModel->getLaporanRetur($tglMulai, $tglSelesai,$tindakLanjut);
            } elseif ($jenis === 'stok') {
                $laporan =$this->laporanModel->getLaporanStokAkhir($idKategori,$statusStok);
            }
        }

        $data = [
            'title'         => 'Laporan Periodik',
            'jenis'         => $jenis,
            'laporan'       => $laporan,
            'error_tanggal' => $errorTanggal,
            'tgl_mulai'     => $tglMulai,
            'tgl_selesai'   => $tglSelesai,
            'id_penjahit'   => $idPenjahit,
            'id_saluran'    => $idSaluran,
            'tindak_lanjut' => $tindakLanjut,
            'id_kategori'   => $idKategori,
            'status_stok'   => $statusStok,
            // Data master untuk dropdown filter
            'penjahit'      => $this->db->table('penjahit')->get()->getResultArray(),
            'saluran'       => $this->db->table('saluran_penjualan')->get()->getResultArray(),
            'kategori'      => $this->db->table('kategori_produk')->get()->getResultArray(),
        ];

        return view('Admin/laporan/index', $data);
    }
}