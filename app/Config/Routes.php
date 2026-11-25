<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// LOGIN
$routes->get('/', 'LoginController::index');
$routes->post('Login', 'LoginController::login');
$routes->post('Logout', 'LoginController::logout');


// OWNER
$routes->group('Owner', [
    'filter' => ['auth', 'role:owner']
], function ($routes) {

    $routes->get(
        'Dashboard',
        'OwnerController\DashboardController::dashboard'
    );
    $routes->get(
        'StokMenipis',
        'OwnerController\StokMenipisController::stokmenipis'
    );
    $routes->get(
        'DataProduk',
        'OwnerController\DataProdukController::dataproduk'
    );
    $routes->get(
        'BarangMasuk',
        'OwnerController\BarangMasukController::barangmasuk'
    );
    $routes->get(
        'BarangKeluar',
        'OwnerController\BarangKeluarController::barangkeluar'
    );
    $routes->get(
        'ManajemenUser',
        'OwnerController\ManajemenUserController::manajemenuser'
    );
    $routes->get(
        'LaporanPersediaan',
        'OwnerController\LaporanPersediaanController::laporan_persediaan'
    );
    $routes->get(
        'BarangRetur',
        'OwnerController\BarangReturController::barang_retur'
    );
});


// ADMIN
$routes->group('Admin', [
    'filter' => ['auth', 'role:admin']
], function ($routes) {

    $routes->get(
        'Dashboard',
        'AdminController\Dashboard::dashboard'
    );

    // ===================================
    // RUTE KATEGORI PRODUK
    // ===================================
    $routes->get('Kategori', 'AdminController\Kategori::index');
    $routes->post('Kategori/simpan', 'AdminController\Kategori::simpan');
    $routes->post('Kategori/update/(:num)', 'AdminController\Kategori::update/$1');
    $routes->delete('Kategori/hapus/(:num)', 'AdminController\Kategori::hapus/$1');
    // Rute Edit 

    // ===================================
    // RUTE PRODUK
    // ===================================
    $routes->get('Produk', 'AdminController\Produk::index');
    $routes->post('Produk/simpan', 'AdminController\Produk::simpan');
    $routes->post('Produk/updateStokMinimum/(:num)', 'AdminController\Produk::updateStokMinimum/$1');
    $routes->delete('Produk/hapus/(:num)', 'AdminController\Produk::hapus/$1');

    // ===================================
    // RUTE Penjahit (1 HALAMAN)
    // ===================================
    $routes->get('Penjahit', 'AdminController\Penjahit::index');
    $routes->post('Penjahit/simpan', 'AdminController\Penjahit::simpan');
    $routes->post('Penjahit/update/(:num)', 'AdminController\Penjahit::update/$1');
    $routes->delete('Penjahit/hapus/(:num)', 'AdminController\Penjahit::hapus/$1');


    // ===================================
    // RUTE SALURAN PENJUALAN
    // ===================================
    $routes->get('SaluranPenjualan', 'AdminController\SaluranPenjualan::index');
    $routes->post('SaluranPenjualan/simpan', 'AdminController\SaluranPenjualan::simpan');
    $routes->post('SaluranPenjualan/update/(:num)', 'AdminController\SaluranPenjualan::update/$1');
    $routes->delete('SaluranPenjualan/hapus/(:num)', 'AdminController\SaluranPenjualan::hapus/$1');

    // ===================================
    // RUTE BARANG MASUK
    // ===================================
    $routes->get('BarangMasuk', 'AdminController\BarangMasuk::index');
    $routes->post('BarangMasuk/simpan', 'AdminController\BarangMasuk::simpan');
    $routes->get('BarangMasuk/nota/(:num)', 'AdminController\BarangMasuk::nota/$1');
    $routes->delete('BarangMasuk/hapus/(:num)', 'AdminController\BarangMasuk::hapus/$1');

    // ===================================
    // RUTE BARANG KELUAR
    // ===================================
    $routes->get('BarangKeluar', 'AdminController\BarangKeluar::index');
    $routes->post('BarangKeluar/simpan', 'AdminController\BarangKeluar::simpan');
    $routes->delete('BarangKeluar/hapus/(:num)', 'AdminController\BarangKeluar::hapus/$1');

    // ===================================
    // RUTE BARANG RETUR
    // ===================================
    $routes->get('BarangRetur', 'AdminController\BarangRetur::index');
    $routes->post('BarangRetur/simpan', 'AdminController\BarangRetur::simpan');
    $routes->delete('BarangRetur/hapus/(:num)', 'AdminController\BarangRetur::hapus/$1');

    // ===================================
    // RUTE STOK PERSEDIAAN
    // ===================================
    $routes->get('StokPersediaan', 'AdminController\StokPersediaan::index');


    // ===================================
    // RUTE STOK PERSEDIAAN
    // ===================================
    $routes->get('PergerakanStok', 'AdminController\StokPersediaan::kartuStok');
    $routes->get('StokPersediaan/kartuStok/(:num)', 'AdminController\StokPersediaan::kartuStok/$1');
    $routes->get('StokPersediaan/cetakKartuStok/(:num)', 'AdminController\StokPersediaan::cetakKartuStok/$1');

    // ===================================
    // RUTE LAPORAN PERIODIK (1 HALAMAN)
    // ===================================
    $routes->get('Laporan', 'AdminController\Laporan::index');

    // ===================================
    // RUTE PRODUK & VARIAN
    // ===================================
    $routes->get('Produk', 'AdminController\Produk::index');
    $routes->post('Produk/simpan', 'AdminController\Produk::simpan');
    $routes->post('Produk/update/(:num)', 'AdminController\Produk::update/$1');
    $routes->delete('Produk/hapus/(:num)', 'AdminController\Produk::hapus/$1');
    $routes->post('Produk/simpanVarian', 'AdminController\Produk::simpanVarian');
    $routes->post('Produk/updateVarian/(:num)', 'AdminController\Produk::updateVarian/$1');
    $routes->delete('Produk/hapusVarian/(:num)', 'AdminController\Produk::hapusVarian/$1');
});
