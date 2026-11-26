<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class StokMenipisController extends BaseController
{
    public function stokmenipis()
    {
        $db = \Config\Database::connect();

        // =====================================
        // 1. AMBIL SALDO TERAKHIR SETIAP VARIAN
        // =====================================

        $stokTerakhir = "
            SELECT
                ps1.id_varian,
                ps1.saldo_stok
            FROM pergerakan_stok ps1

            INNER JOIN (
                SELECT
                    id_varian,
                    MAX(id_pergerakan) AS id_terakhir
                FROM pergerakan_stok
                GROUP BY id_varian
            ) ps2
                ON ps1.id_pergerakan = ps2.id_terakhir
        ";

        // =====================================
        // 2. AMBIL DATA VARIAN STOK MENIPIS
        // =====================================

        $stokMenipis = $db->query("
            SELECT
                v.id_varian,
                v.id_produk,
                v.kode_sku,
                v.warna,
                v.ukuran,
                v.harga_jual,
                v.stok_minimum,

                p.nama_produk,
                k.nama_kategori,

                COALESCE(ps.saldo_stok, 0) AS stok_sekarang

            FROM varian_produk v

            INNER JOIN tb_produk p
                ON p.id_produk = v.id_produk

            LEFT JOIN kategori_produk k
                ON k.id_kategori = p.id_kategori

            LEFT JOIN ($stokTerakhir) ps
                ON ps.id_varian = v.id_varian

            WHERE
                COALESCE(ps.saldo_stok, 0) <= v.stok_minimum
                AND v.stok_minimum > 0

            ORDER BY
                stok_sekarang ASC,
                p.nama_produk ASC
        ")->getResultArray();

        // =====================================
        // 3. HITUNG STATISTIK
        // =====================================

        $totalMenipis = count($stokMenipis);

        $totalKritis = 0;
        $totalPerluRestock = 0;
        $totalKekurangan = 0;

        foreach ($stokMenipis as &$stok) {

            $stokSekarang = (int) $stok['stok_sekarang'];
            $stokMinimum  = (int) $stok['stok_minimum'];

            $kekurangan = max(
                0,
                $stokMinimum - $stokSekarang
            );

            // Status stok
            if ($stokSekarang <= floor($stokMinimum / 2)) {

                $status = 'Kritis';

                $totalKritis++;

                $catatan = 'Stok produk sudah sangat rendah. Disarankan segera melakukan pengadaan barang.';
            } else {

                $status = 'Menipis';

                $totalPerluRestock++;

                $catatan = 'Persediaan produk sudah berada di bawah batas minimum dan perlu dilakukan restock.';
            }

            $stok['kekurangan'] = $kekurangan;
            $stok['status'] = $status;
            $stok['catatan'] = $catatan;
        }

        unset($stok);

        foreach ($stokMenipis as $stok) {
            $totalKekurangan += $stok['kekurangan'];
        }

        // =====================================
        // 4. AMBIL DAFTAR KATEGORI
        // =====================================

        $kategori = $db->table('kategori_produk')
            ->select('nama_kategori')
            ->orderBy('nama_kategori', 'ASC')
            ->get()
            ->getResultArray();

        // =====================================
        // 5. KIRIM DATA KE VIEW
        // =====================================

        $data = [
            'stokMenipis' => $stokMenipis,

            'totalMenipis' => $totalMenipis,
            'totalKritis' => $totalKritis,
            'totalPerluRestock' => $totalPerluRestock,
            'totalKekurangan' => $totalKekurangan,

            'kategori' => $kategori,
        ];

        return view('Owner/stok_menipis/index', $data);
    }
}
