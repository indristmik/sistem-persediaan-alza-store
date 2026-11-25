<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function dashboard()
    {
        $db      = \Config\Database::connect();
        $hariIni = date('Y-m-d');

        // 1. Ambil seluruh SKU beserta sisa stoknya (untuk Total Stok, Hitung Kritis, & Top 5 Kritis)
        $semuaVarian = $db->table('varian_produk vp')
            ->select('
                vp.id_varian,
                vp.kode_sku,
                vp.ukuran,
                vp.warna,
                vp.stok_minimum,
                pr.nama_produk,
                COALESCE(SUM(ps.jumlah), 0) as sisa_stok
            ')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('pergerakan_stok ps', 'ps.id_varian = vp.id_varian', 'left')
            ->groupBy('vp.id_varian')
            ->orderBy('sisa_stok', 'ASC')
            ->get()
            ->getResultArray();

        $totalStok       = 0;
        $jumlahKritis    = 0;
        foreach ($semuaVarian as $v) {
            $stok = (int) $v['sisa_stok'];
            $totalStok += max(0, $stok);
            if ($stok <= (int) $v['stok_minimum']) {
                $jumlahKritis++;
            }
        }
        $top5Kritis = array_slice($semuaVarian, 0, 5);

        // 2. Barang Masuk Hari Ini (pcs)
        $masukHariIni = (int) ($db->table('detail_transaksi_masuk dtm')
            ->selectSum('dtm.jumlah')
            ->join('transaksi_masuk tm', 'tm.id_transaksi_masuk = dtm.id_transaksi_masuk')
            ->where('DATE(tm.tanggal_masuk)', $hariIni)
            ->get()
            ->getRow()->jumlah ?? 0);

        // 3. Barang Keluar Hari Ini (pcs)
        $keluarHariIni = (int) ($db->table('detail_transaksi_keluar dtk')
            ->selectSum('dtk.jumlah')
            ->join('transaksi_keluar tk', 'tk.id_transaksi_keluar = dtk.id_transaksi_keluar')
            ->where('DATE(tk.tanggal_keluar)', $hariIni)
            ->get()
            ->getRow()->jumlah ?? 0);

        // 4. Data Grafik Batang 7 Hari Terakhir (Masuk vs Keluar)
        $labelGrafik = [];
        $dataMasuk7  = [];
        $dataKeluar7 = [];

        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $labelGrafik[] = date('d/m', strtotime($tgl));

            $m = (int) ($db->table('detail_transaksi_masuk dtm')
                ->selectSum('dtm.jumlah')
                ->join('transaksi_masuk tm', 'tm.id_transaksi_masuk = dtm.id_transaksi_masuk')
                ->where('DATE(tm.tanggal_masuk)', $tgl)
                ->get()
                ->getRow()->jumlah ?? 0);

            $k = (int) ($db->table('detail_transaksi_keluar dtk')
                ->selectSum('dtk.jumlah')
                ->join('transaksi_keluar tk', 'tk.id_transaksi_keluar = dtk.id_transaksi_keluar')
                ->where('DATE(tk.tanggal_keluar)', $tgl)
                ->get()
                ->getRow()->jumlah ?? 0);

            $dataMasuk7[]  = $m;
            $dataKeluar7[] = $k;
        }

        // 5. Log Aktivitas Terbaru (7 mutasi terakhir dari pergerakan_stok)
        $logAktivitas = $db->table('pergerakan_stok ps')
            ->select('
                ps.*,
                vp.kode_sku,
                vp.ukuran,
                vp.warna,
                pr.nama_produk
            ')
            ->join('varian_produk vp', 'vp.id_varian = ps.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('ps.id_pergerakan', 'DESC')
            ->limit(7)
            ->get()
            ->getResultArray();

        $data = [
            'title'           => 'Dashboard Admin',
            'total_stok'      => $totalStok,
            'masuk_hari_ini'  => $masukHariIni,
            'keluar_hari_ini' => $keluarHariIni,
            'jumlah_kritis'   => $jumlahKritis,
            'top5_kritis'     => $top5Kritis,
            'label_grafik'    => json_encode($labelGrafik),
            'data_masuk_7'    => json_encode($dataMasuk7),
            'data_keluar_7'   => json_encode($dataKeluar7),
            'log_aktivitas'   => $logAktivitas,
        ];

        return view('dashboard', $data);
    }
}