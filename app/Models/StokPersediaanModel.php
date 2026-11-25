<?php

namespace App\Models;

use CodeIgniter\Model;

class StokPersediaanModel extends Model
{
    protected $table      = 'varian_produk';
    protected $primaryKey = 'id_varian';

    /**
     * Mengambil data stok persediaan lengkap dengan filter kategori, ukuran, dan status
     */
    public function getStokPersediaan($filterKategori = null, $filterUkuran = null, $filterStatus = null)
    {
        $builder = $this->db->table('varian_produk vp')
            ->select('
                vp.id_varian,
                vp.kode_sku,
                vp.warna,
                vp.ukuran,
                vp.stok_minimum,
                pr.nama_produk,
                k.id_kategori,
                k.nama_kategori,
                COALESCE(SUM(ps.jumlah), 0) as sisa_stok
            ')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = pr.id_kategori')
            ->join('pergerakan_stok ps', 'ps.id_varian = vp.id_varian', 'left')
            ->groupBy('vp.id_varian')
            ->orderBy('pr.nama_produk', 'ASC')
            ->orderBy("FIELD(vp.ukuran, 'S', 'M', 'L', 'XL', 'XXL')", '', false);

        // Terapkan filter Kategori jika dipilih
        if (!empty($filterKategori)) {
            $builder->where('k.id_kategori', $filterKategori);
        }

        // Terapkan filter Ukuran jika dipilih
        if (!empty($filterUkuran)) {
            $builder->where('vp.ukuran', $filterUkuran);
        }

        $hasil = $builder->get()->getResultArray();

        // Klasifikasi status otomatis & filter berdasarkan status stok
        $dataFinal = [];
        foreach ($hasil as $row) {
            $stok = (int) $row['sisa_stok'];
            $min  = (int) $row['stok_minimum'];

            if ($stok <= 0) {
                $row['status_stok'] = 'Habis';
            } elseif ($stok <= $min) {
                $row['status_stok'] = 'Menipis';
            } else {
                $row['status_stok'] = 'Aman';
            }

            // Jika user memfilter status tertentu, saring di sini
            if (!empty($filterStatus) && $row['status_stok'] !== $filterStatus) {
                continue;
            }

            $dataFinal[] = $row;
        }

        return $dataFinal;
    }

    /**
     * Menghitung 4 indikator agregat untuk Kartu Ringkasan Atas (tanpa terpengaruh filter)
     */
    public function getRingkasanStok()
    {
        $semuaStok = $this->getStokPersediaan();

        $ringkasan = [
            'total_sku'     => count($semuaStok),
            'total_fisik'   => 0,
            'stok_menipis'  => 0,
            'stok_habis'    => 0,
        ];

        foreach ($semuaStok as $item) {
            $stok = (int) $item['sisa_stok'];
            $ringkasan['total_fisik'] += max(0, $stok);

            if ($item['status_stok'] === 'Habis') {
                $ringkasan['stok_habis']++;
            } elseif ($item['status_stok'] === 'Menipis') {
                $ringkasan['stok_menipis']++;
            }
        }

        return $ringkasan;
    }
}