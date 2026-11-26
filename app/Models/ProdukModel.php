<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'tb_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    // Tambahkan 'foto' di sini jika nanti Anda menambahkan kolom foto pada tb_produk
    protected $allowedFields    = ['nama_produk', 'id_kategori', 'deskripsi', 'foto'];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';

    /**
     * Mengambil seluruh data produk beserta kategori, rincian stok per ukuran,
     * status riwayat transaksi tiap varian, warna unik, dan total stok.
     *
     * @return array
     */


    public function getProdukDenganStok(): array
    {
        // Ambil produk beserta kategori
        $produk = $this->db->table('tb_produk p')
            ->select('p.*, k.nama_kategori, k.kode_produk')
            ->join(
                'kategori_produk k',
                'k.id_kategori = p.id_kategori',
                'left'
            )
            ->orderBy('p.id_produk', 'DESC')
            ->get()
            ->getResultArray();

        // Ambil varian dan hitung stok dari pergerakan stok
        $stokPerUkuran = $this->db->table('varian_produk vp')
            ->select('
            vp.id_varian,
            vp.id_produk,
            vp.kode_sku,
            vp.warna,
            vp.ukuran,
            vp.harga_jual,
            vp.stok_minimum,
            COALESCE(SUM(ps.jumlah), 0) AS stok
        ')
            ->join(
                'pergerakan_stok ps',
                'ps.id_varian = vp.id_varian',
                'left'
            )
            ->groupBy('vp.id_varian')
            ->get()
            ->getResultArray();

        // Kelompokkan varian berdasarkan produk
        $mapStok = [];

        foreach ($stokPerUkuran as $row) {
            $mapStok[$row['id_produk']][] = $row;
        }

        // Masukkan rincian varian ke setiap produk
        foreach ($produk as &$p) {

            $varian = $mapStok[$p['id_produk']] ?? [];

            $p['rincian_varian'] = $varian;

            $p['total_stok'] = array_sum(
                array_column($varian, 'stok')
            );

            $warnaUnik = array_unique(
                array_filter(
                    array_map(
                        'trim',
                        array_column($varian, 'warna')
                    )
                )
            );

            $p['daftar_warna'] = implode(', ', $warnaUnik);
        }

        unset($p);

        return $produk;
    }


    /**
     * Cek apakah varian sudah pernah tercatat di tabel pergerakan_stok
     */
    public function varianPunyaRiwayat(int $idVarian): bool
    {
        return $this->db->table('pergerakan_stok')
            ->where('id_varian', $idVarian)
            ->countAllResults() > 0;
    }
}