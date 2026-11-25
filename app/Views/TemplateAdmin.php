<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Admin - ALZA.STORE'); ?></title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/seodashlogo.png'); ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css'); ?>" />
  <!-- CSS DataTables Bootstrap 5 (Global untuk semua halaman Admin) -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?= site_url('Admin/Dashboard'); ?>" class="text-nowrap logo-img">
            <img src="<?= base_url('assets/images/logos/logo-light.svg'); ?>" alt="ALZA.STORE" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">HOME</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/Dashboard'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">MASTER DATA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/Kategori'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Kategori Produk</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/Produk'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:box-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Data Produk</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/Penjahit'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:scissors-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Penjahit</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/SaluranPenjualan'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:shop-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Saluran Penjualan</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">TRANSAKSI</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/BarangMasuk'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:inbox-in-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Barang Masuk</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/BarangKeluar'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:inbox-out-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Barang Keluar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/BarangRetur'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:refresh-square-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Barang Retur</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
              <span class="hide-menu">MONITORING</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/StokPersediaan'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:chart-square-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Stock Persediaan</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
              <span class="hide-menu">LAPORAN</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('Admin/Laporan'); ?>" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:document-text-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Laporan Periodik</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
              <span class="hide-menu">AUTENTIKASI</span>
            </li>
            <li class="sidebar-item">
              <form action="<?= site_url('Logout') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" class="sidebar-link border-0 bg-transparent w-100 text-start">
                  <span>
                    <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                  </span>
                  <span class="hide-menu">Keluar</span>
                </button>
              </form>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <div class="starter-template">
        <?= $this->renderSection('content'); ?>
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sidebarmenu.js'); ?>"></script>
  <script src="<?= base_url('assets/js/app.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <!-- JS DataTables Bootstrap 5 (Dimuat setelah jQuery bawaan template) -->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

  <!-- Slot untuk script khusus per halaman -->
  <?= $this->renderSection('scripts'); ?>
</body>

</html>