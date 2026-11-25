<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/seodashlogo.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/logo-light.svg" alt="" />
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
                            <span class="hide-menu">HALAMAN UTAMA</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/Dashboard" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:home-smile-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">DATA PERSEDIAAN</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/StokMenipis" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:danger-triangle-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Stok Menipis</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/DataProduk" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:box-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Data Produk</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">TRANSAKSI</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/BarangMasuk" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:inbox-in-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Barang Masuk</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/BarangKeluar" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:box-minimalistic-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Barang Keluar</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/BarangRetur" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:refresh-square-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Barang Retur</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">MANAJEMEN</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/ManajemenUser" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:users-group-rounded-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Manajemen User</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/Owner/LaporanPersediaan" aria-expanded="false">
                                <span>
                                    <iconify-icon
                                        icon="solar:chart-square-bold-duotone"
                                        class="fs-6">
                                    </iconify-icon>
                                </span>
                                <span class="hide-menu">Laporan Persediaan</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">AUTENTIKASI</span>
                        </li>

                        <li class="sidebar-item">
                            <form action="<?= site_url('Logout') ?>" method="POST">
                                <?= csrf_field() ?>

                                <button type="submit"
                                    class="sidebar-link border-0 bg-transparent w-100 text-start">
                                    <span>
                                        <iconify-icon
                                            icon="solar:logout-3-bold-duotone"
                                            class="fs-6">
                                        </iconify-icon>
                                    </span>

                                    <span class="hide-menu">Keluar</span>
                                </button>
                            </form>
                        </li>

                    </ul>

                    <!-- <div class="unlimited-access hide-menu bg-primary-subtle position-relative mb-7 mt-7 rounded-3">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-75">Upgrade to pro</h6>
                                <a href="#" target="_blank"
                                    class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="../assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div> -->
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li> -->
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <a href="#" target="_blank"
                                class="btn btn-primary me-2"><span class="d-none d-md-block">Check Pro Version</span> <span class="d-block d-md-none">Pro</span></a>
                            <a href="#" target="_blank"
                                class="btn btn-success"><span class="d-none d-md-block">Download Free </span> <span class="d-block d-md-none">Free</span></a>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="starter-template">
                <?= $this->renderSection('content'); ?>
            </div>
        </div>
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/js/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>