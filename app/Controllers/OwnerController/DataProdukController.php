<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\VarianProdukModel;

class DataProdukController extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;
    protected $varianModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->varianModel = new VarianProdukModel();
    }


    public function dataproduk()
    {
        // Ambil produk beserta rincian stok
        $produk = $this->produkModel->getProdukDenganStok();

        // Ambil kategori
        $kategori = $this->kategoriModel->findAll();

        // Hitung total produk
        $totalProduk = count($produk);

        // Hitung total kategori
        $totalKategori = $this->kategoriModel->countAllResults();

        // Hitung total varian
        $totalVarian = 0;

        // Hitung varian dengan stok menipis
        $totalStokMenipis = 0;

        foreach ($produk as $p) {
            foreach ($p['rincian_varian'] as $v) {

                $totalVarian++;

                if ($v['stok'] <= $v['stok_minimum']) {
                    $totalStokMenipis++;
                }
            }
        }

        $data = [
            'produk' => $produk,
            'kategori' => $kategori,

            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'totalVarian' => $totalVarian,
            'totalStokMenipis' => $totalStokMenipis
        ];

        return view('Owner/data_produk/index', $data);
    }
}
