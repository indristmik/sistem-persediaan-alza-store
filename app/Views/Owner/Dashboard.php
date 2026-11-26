
<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER DASHBOARD ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Dashboard Owner</h4>
            <p class="text-muted mb-0">
                Selamat datang di halaman monitoring persediaan Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-primary text-primary fs-3 px-3 py-2">
                <iconify-icon icon="solar:calendar-bold-duotone" class="me-1"></iconify-icon>
                25 November 2026
            </span>
        </div>
    </div>


    <!-- ================= STATISTIK ================= -->
    <div class="row">

        <!-- TOTAL PRODUK -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Produk</p>
                            <h4 class="fw-semibold mb-0">24</h4>
                            <small class="text-muted">Produk terdaftar</small>
                        </div>

                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon
                                icon="solar:box-bold-duotone"
                                class="fs-8 text-primary">
                            </iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL VARIAN -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Varian</p>
                            <h4 class="fw-semibold mb-0">86</h4>
                            <small class="text-muted">Warna dan ukuran</small>
                        </div>

                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon
                                icon="solar:layers-bold-duotone"
                                class="fs-8 text-success">
                            </iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL STOK -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Stok</p>
                            <h4 class="fw-semibold mb-0">1.245</h4>
                            <small class="text-muted">Pcs barang tersedia</small>
                        </div>

                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon
                                icon="solar:warehouse-bold-duotone"
                                class="fs-8 text-warning">
                            </iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STOK MENIPIS -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Stok Menipis</p>
                            <h4 class="fw-semibold mb-0">8</h4>
                            <small class="text-danger">Perlu perhatian</small>
                        </div>

                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon
                                icon="solar:danger-triangle-bold-duotone"
                                class="fs-8 text-danger">
                            </iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ================= GRAFIK & RINGKASAN ================= -->
    <div class="row">

        <!-- GRAFIK BARANG MASUK DAN KELUAR -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Grafik Pergerakan Stok
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Barang masuk dan keluar
                            </p>
                        </div>

                        <span class="badge bg-light-primary text-primary">
                            7 Hari Terakhir
                        </span>
                    </div>

                    <div id="grafik-stok" style="height: 320px;"></div>

                </div>
            </div>
        </div>


        <!-- RINGKASAN TRANSAKSI -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-4">
                        Ringkasan Transaksi
                    </h5>

                    <!-- BARANG MASUK -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light-success rounded-3 p-3">
                                <iconify-icon
                                    icon="solar:box-add-bold-duotone"
                                    class="fs-7 text-success">
                                </iconify-icon>
                            </div>

                            <div>
                                <h6 class="mb-1 fw-semibold">Barang Masuk</h6>
                                <small class="text-muted">Bulan ini</small>
                            </div>
                        </div>

                        <h5 class="text-success mb-0">320 Pcs</h5>
                    </div>

                    <hr>

                    <!-- BARANG KELUAR -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light-danger rounded-3 p-3">
                                <iconify-icon
                                    icon="solar:box-minimalistic-bold-duotone"
                                    class="fs-7 text-danger">
                                </iconify-icon>
                            </div>

                            <div>
                                <h6 class="mb-1 fw-semibold">Barang Keluar</h6>
                                <small class="text-muted">Bulan ini</small>
                            </div>
                        </div>

                        <h5 class="text-danger mb-0">185 Pcs</h5>
                    </div>

                    <hr>

                    <!-- TRANSAKSI MASUK -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light-primary rounded-3 p-3">
                                <iconify-icon
                                    icon="solar:document-add-bold-duotone"
                                    class="fs-7 text-primary">
                                </iconify-icon>
                            </div>

                            <div>
                                <h6 class="mb-1 fw-semibold">Transaksi Masuk</h6>
                                <small class="text-muted">Bulan ini</small>
                            </div>
                        </div>

                        <h5 class="mb-0">18</h5>
                    </div>

                    <hr>

                    <!-- TRANSAKSI KELUAR -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light-warning rounded-3 p-3">
                                <iconify-icon
                                    icon="solar:document-text-bold-duotone"
                                    class="fs-7 text-warning">
                                </iconify-icon>
                            </div>

                            <div>
                                <h6 class="mb-1 fw-semibold">Transaksi Keluar</h6>
                                <small class="text-muted">Bulan ini</small>
                            </div>
                        </div>

                        <h5 class="mb-0">26</h5>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- ================= STOK MENIPIS ================= -->
    <div class="row">

        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-0">
                            Peringatan Stok Menipis
                        </h5>

                        <a href="/Owner/StokMenipis"
                           class="text-primary fw-semibold fs-3">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="alert alert-warning d-flex align-items-center mb-4"
                         role="alert">
                        <iconify-icon
                            icon="solar:danger-triangle-bold-duotone"
                            class="fs-7 me-2">
                        </iconify-icon>

                        <div class="fs-3">
                            Terdapat 8 varian produk dengan stok menipis.
                        </div>
                    </div>


                    <!-- PRODUK 1 -->
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-semibold">Kaos Polos</h6>
                            <small class="text-muted">Hitam / M</small>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-light-danger text-danger">
                                3 Pcs
                            </span>
                            <small class="d-block text-muted mt-1">
                                Min. 10 Pcs
                            </small>
                        </div>
                    </div>


                    <!-- PRODUK 2 -->
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-semibold">Hoodie Basic</h6>
                            <small class="text-muted">Abu-abu / L</small>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-light-danger text-danger">
                                5 Pcs
                            </span>
                            <small class="d-block text-muted mt-1">
                                Min. 10 Pcs
                            </small>
                        </div>
                    </div>


                    <!-- PRODUK 3 -->
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-semibold">Celana Jogger</h6>
                            <small class="text-muted">Hitam / XL</small>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-light-danger text-danger">
                                2 Pcs
                            </span>
                            <small class="d-block text-muted mt-1">
                                Min. 5 Pcs
                            </small>
                        </div>
                    </div>


                    <!-- PRODUK 4 -->
                    <div class="d-flex align-items-center justify-content-between py-3">
                        <div>
                            <h6 class="mb-1 fw-semibold">Kemeja Casual</h6>
                            <small class="text-muted">Putih / L</small>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-light-danger text-danger">
                                4 Pcs
                            </span>
                            <small class="d-block text-muted mt-1">
                                Min. 8 Pcs
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- ================= TRANSAKSI TERBARU ================= -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-0">
                            Transaksi Terbaru
                        </h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0">

                            <thead>
                                <tr>
                                    <th class="ps-0">No. Referensi</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td class="ps-0 fw-semibold">
                                        MSK-001
                                    </td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Masuk
                                        </span>
                                    </td>

                                    <td>25 Nov 2026</td>

                                    <td>50 Pcs</td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-0 fw-semibold">
                                        KLR-001
                                    </td>

                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Keluar
                                        </span>
                                    </td>

                                    <td>24 Nov 2026</td>

                                    <td>12 Pcs</td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-0 fw-semibold">
                                        MSK-002
                                    </td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Masuk
                                        </span>
                                    </td>

                                    <td>23 Nov 2026</td>

                                    <td>30 Pcs</td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-0 fw-semibold">
                                        KLR-002
                                    </td>

                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Keluar
                                        </span>
                                    </td>

                                    <td>22 Nov 2026</td>

                                    <td>8 Pcs</td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-0 fw-semibold">
                                        MSK-003
                                    </td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Masuk
                                        </span>
                                    </td>

                                    <td>20 Nov 2026</td>

                                    <td>75 Pcs</td>

                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-4">
                        <a href="/Owner/BarangMasuk"
                           class="btn btn-outline-primary">
                            Lihat Riwayat Transaksi
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- ================= FOOTER ================= -->
    <div class="py-4 text-center">
        <p class="mb-0 fs-3 text-muted">
            Alza Store &copy; <?= date('Y'); ?> - Dashboard Owner
        </p>
    </div>

</div>


<!-- ================= GRAFIK APEXCHARTS ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.querySelector("#grafik-stok");

    if (chartElement && typeof ApexCharts !== 'undefined') {

        const options = {
            series: [
                {
                    name: 'Barang Masuk',
                    data: [45, 60, 35, 80, 55, 70, 95]
                },
                {
                    name: 'Barang Keluar',
                    data: [30, 40, 25, 55, 45, 60, 65]
                }
            ],

            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                },
                fontFamily: 'inherit'
            },

            colors: ['#5D87FF', '#FA896B'],

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: 'smooth',
                width: 3
            },

            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.35,
                    opacityTo: 0.05
                }
            },

            xaxis: {
                categories: [
                    '19 Nov',
                    '20 Nov',
                    '21 Nov',
                    '22 Nov',
                    '23 Nov',
                    '24 Nov',
                    '25 Nov'
                ]
            },

            yaxis: {
                title: {
                    text: 'Jumlah Barang (Pcs)'
                },
                min: 0
            },

            legend: {
                position: 'top',
                horizontalAlign: 'right'
            },

            grid: {
                borderColor: '#E5EAEF',
                strokeDashArray: 4
            },

            tooltip: {
                y: {
                    formatter: function (value) {
                        return value + ' Pcs';
                    }
                }
            }
        };

        const chart = new ApexCharts(chartElement, options);
        chart.render();
    }

});
</script>

<?= $this->endSection(); ?>
