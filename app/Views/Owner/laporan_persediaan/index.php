<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Laporan Persediaan</h4>
            <p class="text-muted mb-0">
                Informasi dan laporan ketersediaan stok barang Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-primary text-primary fs-3 px-3 py-2">
                <iconify-icon icon="solar:chart-square-bold-duotone"
                    class="me-1"></iconify-icon>
                Laporan Persediaan
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
                            <h4 class="fw-semibold mb-0">120</h4>
                            <small class="text-muted">Jenis produk terdaftar</small>
                        </div>

                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:box-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
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
                            <h4 class="fw-semibold mb-0">2.450</h4>
                            <small class="text-muted">Pcs seluruh barang</small>
                        </div>

                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:layers-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STOK TERSEDIA -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Stok Tersedia</p>
                            <h4 class="fw-semibold mb-0">108</h4>
                            <small class="text-muted">Produk stok normal</small>
                        </div>

                        <div class="bg-light-info rounded-3 p-3">
                            <iconify-icon icon="solar:check-circle-bold-duotone"
                                class="fs-8 text-info"></iconify-icon>
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
                            <h4 class="fw-semibold mb-0">12</h4>
                            <small class="text-muted">Produk perlu diperhatikan</small>
                        </div>

                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:danger-triangle-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= RINGKASAN PERSEDIAAN ================= -->
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-4">
                        Ringkasan Kondisi Persediaan
                    </h5>

                    <div class="row align-items-center">

                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-flex align-items-center justify-content-center
                                rounded-circle bg-light-primary"
                                style="width: 145px; height: 145px;">

                                <div>
                                    <h3 class="fw-bold text-primary mb-0">90%</h3>
                                    <small class="text-muted">Stok Normal</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold fs-3">
                                        Stok Normal
                                    </span>
                                    <span class="fw-semibold text-success">
                                        108 Produk
                                    </span>
                                </div>

                                <div class="progress" style="height: 9px;">
                                    <div class="progress-bar bg-success"
                                        style="width: 90%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold fs-3">
                                        Stok Menipis
                                    </span>
                                    <span class="fw-semibold text-warning">
                                        12 Produk
                                    </span>
                                </div>

                                <div class="progress" style="height: 9px;">
                                    <div class="progress-bar bg-warning"
                                        style="width: 10%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold fs-3">
                                        Stok Habis
                                    </span>
                                    <span class="fw-semibold text-danger">
                                        0 Produk
                                    </span>
                                </div>

                                <div class="progress" style="height: 9px;">
                                    <div class="progress-bar bg-danger"
                                        style="width: 0%"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- INFORMASI LAPORAN -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-3">
                        Informasi Laporan
                    </h5>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:calendar-bold-duotone"
                                class="fs-7 text-primary"></iconify-icon>
                        </div>

                        <div>
                            <small class="text-muted">Tanggal Laporan</small>
                            <h6 class="mb-0 fw-semibold">25 November 2026</h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:refresh-bold-duotone"
                                class="fs-7 text-success"></iconify-icon>
                        </div>

                        <div>
                            <small class="text-muted">Periode Laporan</small>
                            <h6 class="mb-0 fw-semibold">November 2026</h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:user-bold-duotone"
                                class="fs-7 text-warning"></iconify-icon>
                        </div>

                        <div>
                            <small class="text-muted">Dibuat Oleh</small>
                            <h6 class="mb-0 fw-semibold">Owner</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTER ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-3">
                        Filter Laporan Persediaan
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari Produk</label>
                            <input type="text"
                                class="form-control"
                                id="searchPersediaan"
                                placeholder="Kode produk atau nama barang...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="filterKategori">
                                <option value="">Semua Kategori</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="ATK">ATK</option>
                                <option value="Peralatan">Peralatan</option>
                                <option value="Kebersihan">Kebersihan</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status Persediaan</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Normal">Normal</option>
                                <option value="Menipis">Menipis</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-primary w-100"
                                onclick="resetFilterPersediaan()">

                                <iconify-icon icon="solar:restart-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Reset
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= TABEL LAPORAN ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Data Laporan Persediaan
                            </h5>

                            <p class="text-muted mb-0 fs-3">
                                Daftar kondisi dan jumlah stok seluruh produk
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button"
                                class="btn btn-outline-primary"
                                onclick="cetakLaporanPersediaan()">

                                <iconify-icon icon="solar:printer-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Cetak Laporan
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tablePersediaan">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Stok Awal</th>
                                    <th>Barang Masuk</th>
                                    <th>Barang Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>Minimal Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- PRODUK 1 -->
                                <tr data-kategori="Elektronik" data-status="Normal">
                                    <td class="ps-0">1</td>
                                    <td class="fw-semibold">PRD-001</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Mouse Wireless</h6>
                                        <small class="text-muted">Perangkat komputer</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td>50 Pcs</td>
                                    <td class="text-success fw-semibold">20 Pcs</td>
                                    <td class="text-danger fw-semibold">10 Pcs</td>
                                    <td class="fw-semibold">60 Pcs</td>
                                    <td>10 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Normal
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-001"
                                            data-nama="Mouse Wireless"
                                            data-kategori="Elektronik"
                                            data-awal="50 Pcs"
                                            data-masuk="20 Pcs"
                                            data-keluar="10 Pcs"
                                            data-akhir="60 Pcs"
                                            data-minimal="10 Pcs"
                                            data-status="Normal">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 2 -->
                                <tr data-kategori="ATK" data-status="Normal">
                                    <td class="ps-0">2</td>
                                    <td class="fw-semibold">PRD-002</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kertas A4</h6>
                                        <small class="text-muted">Kebutuhan kantor</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            ATK
                                        </span>
                                    </td>
                                    <td>100 Rim</td>
                                    <td class="text-success fw-semibold">30 Rim</td>
                                    <td class="text-danger fw-semibold">20 Rim</td>
                                    <td class="fw-semibold">110 Rim</td>
                                    <td>20 Rim</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Normal
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-002"
                                            data-nama="Kertas A4"
                                            data-kategori="ATK"
                                            data-awal="100 Rim"
                                            data-masuk="30 Rim"
                                            data-keluar="20 Rim"
                                            data-akhir="110 Rim"
                                            data-minimal="20 Rim"
                                            data-status="Normal">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 3 -->
                                <tr data-kategori="Elektronik" data-status="Menipis">
                                    <td class="ps-0">3</td>
                                    <td class="fw-semibold">PRD-003</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Flashdisk 32GB</h6>
                                        <small class="text-muted">Media penyimpanan</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td>15 Unit</td>
                                    <td class="text-success fw-semibold">8 Unit</td>
                                    <td class="text-danger fw-semibold">18 Unit</td>
                                    <td class="fw-semibold">5 Unit</td>
                                    <td>10 Unit</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-003"
                                            data-nama="Flashdisk 32GB"
                                            data-kategori="Elektronik"
                                            data-awal="15 Unit"
                                            data-masuk="8 Unit"
                                            data-keluar="18 Unit"
                                            data-akhir="5 Unit"
                                            data-minimal="10 Unit"
                                            data-status="Menipis">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 4 -->
                                <tr data-kategori="Peralatan" data-status="Normal">
                                    <td class="ps-0">4</td>
                                    <td class="fw-semibold">PRD-004</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kabel LAN 5 Meter</h6>
                                        <small class="text-muted">Aksesoris jaringan</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Peralatan
                                        </span>
                                    </td>
                                    <td>40 Pcs</td>
                                    <td class="text-success fw-semibold">10 Pcs</td>
                                    <td class="text-danger fw-semibold">15 Pcs</td>
                                    <td class="fw-semibold">35 Pcs</td>
                                    <td>10 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Normal
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-004"
                                            data-nama="Kabel LAN 5 Meter"
                                            data-kategori="Peralatan"
                                            data-awal="40 Pcs"
                                            data-masuk="10 Pcs"
                                            data-keluar="15 Pcs"
                                            data-akhir="35 Pcs"
                                            data-minimal="10 Pcs"
                                            data-status="Normal">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 5 -->
                                <tr data-kategori="Kebersihan" data-status="Habis">
                                    <td class="ps-0">5</td>
                                    <td class="fw-semibold">PRD-005</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Cairan Pembersih</h6>
                                        <small class="text-muted">Perlengkapan kebersihan</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Kebersihan
                                        </span>
                                    </td>
                                    <td>20 Botol</td>
                                    <td class="text-success fw-semibold">5 Botol</td>
                                    <td class="text-danger fw-semibold">25 Botol</td>
                                    <td class="fw-semibold">0 Botol</td>
                                    <td>5 Botol</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Habis
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-005"
                                            data-nama="Cairan Pembersih"
                                            data-kategori="Kebersihan"
                                            data-awal="20 Botol"
                                            data-masuk="5 Botol"
                                            data-keluar="25 Botol"
                                            data-akhir="0 Botol"
                                            data-minimal="5 Botol"
                                            data-status="Habis">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 6 -->
                                <tr data-kategori="ATK" data-status="Normal">
                                    <td class="ps-0">6</td>
                                    <td class="fw-semibold">PRD-006</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Pulpen</h6>
                                        <small class="text-muted">Alat tulis kantor</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            ATK
                                        </span>
                                    </td>
                                    <td>80 Pcs</td>
                                    <td class="text-success fw-semibold">30 Pcs</td>
                                    <td class="text-danger fw-semibold">20 Pcs</td>
                                    <td class="fw-semibold">90 Pcs</td>
                                    <td>15 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Normal
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailPersediaan(this)"
                                            data-kode="PRD-006"
                                            data-nama="Pulpen"
                                            data-kategori="ATK"
                                            data-awal="80 Pcs"
                                            data-masuk="30 Pcs"
                                            data-keluar="20 Pcs"
                                            data-akhir="90 Pcs"
                                            data-minimal="15 Pcs"
                                            data-status="Normal">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- DATA KOSONG -->
                        <div id="dataKosongPersediaan"
                            class="text-center py-5 d-none">

                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>

                            <h6 class="mt-2">
                                Data persediaan tidak ditemukan
                            </h6>

                            <p class="text-muted mb-0">
                                Coba ubah kata kunci atau filter pencarian.
                            </p>

                        </div>

                    </div>

                    <!-- PAGINATION -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data laporan persediaan
                        </p>

                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Sebelumnya</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Selanjutnya</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <div class="py-4 text-center">
        <p class="mb-0 fs-3 text-muted">
            Alza Store &copy; <?= date('Y'); ?> - Laporan Persediaan
        </p>
    </div>

</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailPersediaan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold">
                        Detail Persediaan
                    </h5>
                    <small class="text-muted" id="detailKode"></small>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Nama Produk</span>
                    <span class="fw-semibold" id="detailNama"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kategori</span>
                    <span id="detailKategori"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Stok Awal</span>
                    <span class="fw-semibold" id="detailAwal"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Barang Masuk</span>
                    <span class="fw-semibold text-success" id="detailMasuk"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Barang Keluar</span>
                    <span class="fw-semibold text-danger" id="detailKeluar"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Stok Akhir</span>
                    <span class="fw-semibold" id="detailAkhir"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Minimal Stok</span>
                    <span class="fw-semibold" id="detailMinimal"></span>
                </div>

                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted">Status</span>
                    <span id="detailStatus"></span>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">
                    Tutup
                </button>

                <button type="button" class="btn btn-primary"
                    onclick="cetakDetailPersediaan()">

                    <iconify-icon icon="solar:printer-bold-duotone"
                        class="me-1"></iconify-icon>
                    Cetak
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    // ================= FILTER DAN PENCARIAN =================

    const searchPersediaan = document.getElementById('searchPersediaan');
    const filterKategori = document.getElementById('filterKategori');
    const filterStatus = document.getElementById('filterStatus');
    const tablePersediaan = document.getElementById('tablePersediaan');
    const dataKosongPersediaan = document.getElementById('dataKosongPersediaan');

    function filterPersediaan() {

        const keyword = searchPersediaan.value.toLowerCase();
        const kategori = filterKategori.value;
        const status = filterStatus.value;

        const rows = tablePersediaan.querySelectorAll('tbody tr');

        let jumlahTampil = 0;

        rows.forEach(row => {

            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);

            const cocokKategori = !kategori || row.dataset.kategori === kategori;

            const cocokStatus = !status || row.dataset.status === status;

            const tampil =
                cocokKeyword && cocokKategori && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;

        });

        dataKosongPersediaan.classList.toggle(
            'd-none',
            jumlahTampil > 0
        );

    }

    searchPersediaan.addEventListener('input', filterPersediaan);
    filterKategori.addEventListener('change', filterPersediaan);
    filterStatus.addEventListener('change', filterPersediaan);

    function resetFilterPersediaan() {

        searchPersediaan.value = '';
        filterKategori.value = '';
        filterStatus.value = '';

        filterPersediaan();

    }


    // ================= DETAIL PERSEDIAAN =================

    let dataCetakPersediaan = {};

    function lihatDetailPersediaan(button) {

        dataCetakPersediaan = {

            kode: button.dataset.kode,
            nama: button.dataset.nama,
            kategori: button.dataset.kategori,
            awal: button.dataset.awal,
            masuk: button.dataset.masuk,
            keluar: button.dataset.keluar,
            akhir: button.dataset.akhir,
            minimal: button.dataset.minimal,
            status: button.dataset.status

        };

        document.getElementById('detailKode').innerText =
            dataCetakPersediaan.kode;

        document.getElementById('detailNama').innerText =
            dataCetakPersediaan.nama;

        document.getElementById('detailKategori').innerText =
            dataCetakPersediaan.kategori;

        document.getElementById('detailAwal').innerText =
            dataCetakPersediaan.awal;

        document.getElementById('detailMasuk').innerText =
            dataCetakPersediaan.masuk;

        document.getElementById('detailKeluar').innerText =
            dataCetakPersediaan.keluar;

        document.getElementById('detailAkhir').innerText =
            dataCetakPersediaan.akhir;

        document.getElementById('detailMinimal').innerText =
            dataCetakPersediaan.minimal;

        document.getElementById('detailStatus').innerText =
            dataCetakPersediaan.status;

        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailPersediaan')
        );

        modal.show();

    }


    // ================= CETAK DETAIL =================

    function cetakDetailPersediaan() {

        const d = dataCetakPersediaan;

        const html = `
            <html>
            <head>
                <title>Detail Persediaan ${d.kode}</title>

                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 30px;
                    }

                    h2 {
                        text-align: center;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 25px;
                    }

                    td {
                        padding: 10px;
                        border-bottom: 1px solid #ddd;
                    }

                    td:first-child {
                        width: 35%;
                        font-weight: bold;
                    }
                </style>
            </head>

            <body>

                <h2>LAPORAN DETAIL PERSEDIAAN</h2>

                <p style="text-align:center">
                    Kode Produk: ${d.kode}
                </p>

                <table>
                    <tr><td>Nama Produk</td><td>${d.nama}</td></tr>
                    <tr><td>Kategori</td><td>${d.kategori}</td></tr>
                    <tr><td>Stok Awal</td><td>${d.awal}</td></tr>
                    <tr><td>Barang Masuk</td><td>${d.masuk}</td></tr>
                    <tr><td>Barang Keluar</td><td>${d.keluar}</td></tr>
                    <tr><td>Stok Akhir</td><td>${d.akhir}</td></tr>
                    <tr><td>Minimal Stok</td><td>${d.minimal}</td></tr>
                    <tr><td>Status</td><td>${d.status}</td></tr>
                </table>

                <p style="margin-top:30px">
                    Dicetak: ${new Date().toLocaleString('id-ID')}
                </p>

                <script>
                    window.onload = () => window.print();
                <\/script>

            </body>
            </html>
        `;

        const win = window.open('', '_blank');

        if (!win) {
            alert('Izinkan pop-up browser untuk mencetak laporan.');
            return;
        }

        win.document.write(html);
        win.document.close();

    }


    // ================= CETAK LAPORAN KESELURUHAN =================

    function cetakLaporanPersediaan() {

        const rows = tablePersediaan.querySelectorAll('tbody tr');

        let isiTabel = '';
        let nomor = 1;

        rows.forEach(row => {

            if (row.style.display === 'none') return;

            const cells = row.querySelectorAll('td');

            isiTabel += '<tr>';

            for (let i = 0; i < cells.length - 1; i++) {

                isiTabel += '<td>' + cells[i].innerText + '</td>';

            }

            isiTabel += '</tr>';

            nomor++;

        });

        if (nomor === 1) {
            alert('Tidak ada data persediaan yang dapat dicetak.');
            return;
        }

        const win = window.open('', '_blank');

        if (!win) {
            alert('Izinkan pop-up browser untuk mencetak laporan.');
            return;
        }

        win.document.write(`
            <html>
            <head>

                <title>Laporan Persediaan Alza Store</title>

                <style>

                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }

                    h2 {
                        text-align: center;
                    }

                    p {
                        font-size: 12px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }

                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        font-size: 10px;
                        text-align: left;
                    }

                    th {
                        background: #f1f5f9;
                    }

                    @media print {
                        body {
                            padding: 0;
                        }
                    }

                </style>

            </head>

            <body>

                <h2>LAPORAN PERSEDIAAN BARANG</h2>

                <p>Alza Store</p>

                <p>
                    Tanggal Cetak:
                    ${new Date().toLocaleString('id-ID')}
                </p>

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok Awal</th>
                            <th>Barang Masuk</th>
                            <th>Barang Keluar</th>
                            <th>Stok Akhir</th>
                            <th>Minimal Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        ${isiTabel}
                    </tbody>

                </table>

                <script>
                    window.onload = () => window.print();
                <\/script>

            </body>
            </html>
        `);

        win.document.close();

    }
</script>

<?= $this->endSection(); ?>