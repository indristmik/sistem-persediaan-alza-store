<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Stok Menipis</h4>
            <p class="text-muted mb-0">
                Pantau produk dengan persediaan rendah agar stok Alza Store tetap terjaga.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-danger text-danger fs-3 px-3 py-2">
                <iconify-icon icon="solar:danger-triangle-bold-duotone" class="me-1"></iconify-icon>
                Peringatan Stok
            </span>
        </div>
    </div>


    <!-- ================= STATISTIK ================= -->
    <div class="row">

        <!-- TOTAL PRODUK MENIPIS -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Produk Menipis</p>
                            <h4 class="fw-semibold mb-0">8</h4>
                            <small class="text-muted">Produk perlu dipantau</small>
                        </div>

                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:box-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STOK KRITIS -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Stok Kritis</p>
                            <h4 class="fw-semibold mb-0">3</h4>
                            <small class="text-muted">Stok hampir habis</small>
                        </div>

                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon icon="solar:danger-bold-duotone"
                                class="fs-8 text-danger"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERLU RESTOCK -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Perlu Restock</p>
                            <h4 class="fw-semibold mb-0">5</h4>
                            <small class="text-muted">Di bawah stok minimum</small>
                        </div>

                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:box-minimalistic-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL KEKURANGAN -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Kekurangan</p>
                            <h4 class="fw-semibold mb-0">42</h4>
                            <small class="text-muted">Pcs / unit</small>
                        </div>

                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:chart-2-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
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
                        Filter Stok Menipis
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-5">
                            <label class="form-label">Cari Produk</label>
                            <input type="text" class="form-control" id="searchStok"
                                placeholder="Nama produk atau kode produk...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="filterKategoriStok">
                                <option value="">Semua Kategori</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="ATK">ATK</option>
                                <option value="Peralatan">Peralatan</option>
                                <option value="Kebersihan">Kebersihan</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Status Stok</label>
                            <select class="form-select" id="filterStatusStok">
                                <option value="">Semua Status</option>
                                <option value="Kritis">Kritis</option>
                                <option value="Menipis">Menipis</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-primary w-100"
                                onclick="resetFilterStok()">
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


    <!-- ================= TABEL STOK MENIPIS ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Daftar Produk Stok Menipis
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Produk yang memiliki stok di bawah batas minimum
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="cetakStokMenipis()">
                                <iconify-icon icon="solar:printer-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Cetak Data
                            </button>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableStokMenipis">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Stok Minimum</th>
                                    <th>Kekurangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- PRODUK 1 -->
                                <tr data-kategori="Elektronik" data-status="Kritis">
                                    <td class="ps-0">1</td>
                                    <td class="fw-semibold">PRD-001</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Mouse Wireless</h6>
                                        <small class="text-muted">Warna: Hitam</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-danger">2 Pcs</td>
                                    <td>10 Pcs</td>
                                    <td class="fw-semibold text-danger">8 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Kritis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-001"
                                            data-nama="Mouse Wireless"
                                            data-kategori="Elektronik"
                                            data-warna="Hitam"
                                            data-ukuran="Standar"
                                            data-harga="Rp75.000"
                                            data-stok="2 Pcs"
                                            data-minimum="10 Pcs"
                                            data-kekurangan="8 Pcs"
                                            data-status="Kritis"
                                            data-catatan="Stok mouse wireless hampir habis dan perlu segera dilakukan pengadaan.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 2 -->
                                <tr data-kategori="ATK" data-status="Menipis">
                                    <td class="ps-0">2</td>
                                    <td class="fw-semibold">PRD-008</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kertas A4</h6>
                                        <small class="text-muted">Warna: Putih</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-warning">5 Rim</td>
                                    <td>10 Rim</td>
                                    <td class="fw-semibold text-warning">5 Rim</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-008"
                                            data-nama="Kertas A4"
                                            data-kategori="ATK"
                                            data-warna="Putih"
                                            data-ukuran="A4"
                                            data-harga="Rp55.000"
                                            data-stok="5 Rim"
                                            data-minimum="10 Rim"
                                            data-kekurangan="5 Rim"
                                            data-status="Menipis"
                                            data-catatan="Persediaan kertas A4 sudah berada di bawah batas minimum.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 3 -->
                                <tr data-kategori="Peralatan" data-status="Kritis">
                                    <td class="ps-0">3</td>
                                    <td class="fw-semibold">PRD-004</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kabel LAN 5 Meter</h6>
                                        <small class="text-muted">Warna: Biru</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Peralatan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-danger">1 Pcs</td>
                                    <td>8 Pcs</td>
                                    <td class="fw-semibold text-danger">7 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Kritis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-004"
                                            data-nama="Kabel LAN 5 Meter"
                                            data-kategori="Peralatan"
                                            data-warna="Biru"
                                            data-ukuran="5 Meter"
                                            data-harga="Rp25.000"
                                            data-stok="1 Pcs"
                                            data-minimum="8 Pcs"
                                            data-kekurangan="7 Pcs"
                                            data-status="Kritis"
                                            data-catatan="Stok kabel LAN sangat rendah dan perlu segera ditambah.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 4 -->
                                <tr data-kategori="Kebersihan" data-status="Menipis">
                                    <td class="ps-0">4</td>
                                    <td class="fw-semibold">PRD-014</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Cairan Pembersih</h6>
                                        <small class="text-muted">Warna: Biru</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-info text-info">
                                            Kebersihan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-warning">4 Botol</td>
                                    <td>10 Botol</td>
                                    <td class="fw-semibold text-warning">6 Botol</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-014"
                                            data-nama="Cairan Pembersih"
                                            data-kategori="Kebersihan"
                                            data-warna="Biru"
                                            data-ukuran="1 Liter"
                                            data-harga="Rp18.000"
                                            data-stok="4 Botol"
                                            data-minimum="10 Botol"
                                            data-kekurangan="6 Botol"
                                            data-status="Menipis"
                                            data-catatan="Stok cairan pembersih perlu ditambah untuk menjaga ketersediaan barang.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 5 -->
                                <tr data-kategori="Elektronik" data-status="Menipis">
                                    <td class="ps-0">5</td>
                                    <td class="fw-semibold">PRD-002</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Keyboard USB</h6>
                                        <small class="text-muted">Warna: Hitam</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-warning">3 Pcs</td>
                                    <td>8 Pcs</td>
                                    <td class="fw-semibold text-warning">5 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-002"
                                            data-nama="Keyboard USB"
                                            data-kategori="Elektronik"
                                            data-warna="Hitam"
                                            data-ukuran="Standar"
                                            data-harga="Rp95.000"
                                            data-stok="3 Pcs"
                                            data-minimum="8 Pcs"
                                            data-kekurangan="5 Pcs"
                                            data-status="Menipis"
                                            data-catatan="Persediaan keyboard USB sudah di bawah stok minimum.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 6 -->
                                <tr data-kategori="ATK" data-status="Kritis">
                                    <td class="ps-0">6</td>
                                    <td class="fw-semibold">PRD-009</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Pulpen</h6>
                                        <small class="text-muted">Warna: Hitam</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-danger">2 Pcs</td>
                                    <td>15 Pcs</td>
                                    <td class="fw-semibold text-danger">13 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger">
                                            Kritis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-009"
                                            data-nama="Pulpen"
                                            data-kategori="ATK"
                                            data-warna="Hitam"
                                            data-ukuran="Standar"
                                            data-harga="Rp3.000"
                                            data-stok="2 Pcs"
                                            data-minimum="15 Pcs"
                                            data-kekurangan="13 Pcs"
                                            data-status="Kritis"
                                            data-catatan="Stok pulpen hampir habis. Disarankan segera melakukan penambahan stok.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 7 -->
                                <tr data-kategori="Peralatan" data-status="Menipis">
                                    <td class="ps-0">7</td>
                                    <td class="fw-semibold">PRD-006</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Stop Kontak</h6>
                                        <small class="text-muted">Warna: Putih</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Peralatan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-warning">3 Pcs</td>
                                    <td>8 Pcs</td>
                                    <td class="fw-semibold text-warning">5 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-006"
                                            data-nama="Stop Kontak"
                                            data-kategori="Peralatan"
                                            data-warna="Putih"
                                            data-ukuran="3 Lubang"
                                            data-harga="Rp35.000"
                                            data-stok="3 Pcs"
                                            data-minimum="8 Pcs"
                                            data-kekurangan="5 Pcs"
                                            data-status="Menipis"
                                            data-catatan="Stok stop kontak perlu ditambah agar tetap tersedia.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- PRODUK 8 -->
                                <tr data-kategori="Elektronik" data-status="Menipis">
                                    <td class="ps-0">8</td>
                                    <td class="fw-semibold">PRD-003</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Flashdisk 32GB</h6>
                                        <small class="text-muted">Warna: Silver</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-warning">4 Pcs</td>
                                    <td>10 Pcs</td>
                                    <td class="fw-semibold text-warning">6 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Menipis
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailStok(this)"
                                            data-kode="PRD-003"
                                            data-nama="Flashdisk 32GB"
                                            data-kategori="Elektronik"
                                            data-warna="Silver"
                                            data-ukuran="32GB"
                                            data-harga="Rp65.000"
                                            data-stok="4 Pcs"
                                            data-minimum="10 Pcs"
                                            data-kekurangan="6 Pcs"
                                            data-status="Menipis"
                                            data-catatan="Stok flashdisk 32GB berada di bawah batas minimum.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- DATA KOSONG -->
                        <div id="dataKosongStok" class="text-center py-5 d-none">
                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>
                            <h6 class="mt-2">Produk tidak ditemukan</h6>
                            <p class="text-muted mb-0">
                                Coba ubah kata kunci atau filter pencarian.
                            </p>
                        </div>

                    </div>


                    <!-- ================= PAGINATION ================= -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data produk stok menipis
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
            Alza Store &copy; <?= date('Y'); ?> - Stok Menipis
        </p>
    </div>

</div>


<!-- ================= MODAL DETAIL STOK ================= -->
<div class="modal fade" id="modalDetailProduk" tabindex="-1"
    aria-labelledby="modalDetailProdukLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="modalDetailProdukLabel">
                    Detail Stok Produk
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>


            <div class="modal-body">

                <!-- IDENTITAS PRODUK -->
                <div class="text-center mb-4">
                    <div class="bg-light-primary rounded-4 p-4 d-inline-block">
                        <iconify-icon
                            icon="solar:box-bold-duotone"
                            class="fs-9 text-primary">
                        </iconify-icon>
                    </div>

                    <h5 class="fw-semibold mt-3 mb-1" id="detailNamaProduk">
                        Nama Produk
                    </h5>

                    <p class="text-muted mb-0" id="detailSKU">
                        Kode Produk
                    </p>
                </div>


                <!-- INFORMASI PRODUK -->
                <div class="row g-3">

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Kategori
                            </small>

                            <h6 class="mb-0" id="detailKategori">-</h6>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Warna
                            </small>

                            <h6 class="mb-0" id="detailWarna">-</h6>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Ukuran
                            </small>

                            <h6 class="mb-0" id="detailUkuran">-</h6>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Harga Jual
                            </small>

                            <h6 class="mb-0" id="detailHarga">-</h6>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Stok Saat Ini
                            </small>

                            <h6 class="mb-0 text-danger" id="detailStok">-</h6>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block mb-1">
                                Stok Minimum
                            </small>

                            <h6 class="mb-0" id="detailMinimum">-</h6>
                        </div>
                    </div>

                </div>


                <!-- INFORMASI KEKURANGAN STOK -->
                <div class="mt-3">
                    <div class="bg-light-warning rounded-3 p-3">
                        <small class="text-muted d-block mb-1">
                            Jumlah Kekurangan Stok
                        </small>

                        <h5 class="fw-semibold text-warning mb-0"
                            id="detailKekurangan">
                            -
                        </h5>
                    </div>
                </div>


                <!-- STATUS PERSEDIAAN -->
                <div class="mt-4">
                    <label class="form-label fw-semibold">
                        Status Persediaan
                    </label>

                    <div id="detailStatus">
                        -
                    </div>
                </div>


                <!-- CATATAN -->
                <div class="mt-3">
                    <label class="form-label fw-semibold">
                        Catatan
                    </label>

                    <p class="text-muted mb-0" id="detailCatatan">
                        -
                    </p>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>

    </div>
</div>


<!-- ================= SCRIPT ================= -->
<script>
    // ================= FILTER DAN PENCARIAN =================
    const searchStok = document.getElementById('searchStok');
    const filterKategoriStok = document.getElementById('filterKategoriStok');
    const filterStatusStok = document.getElementById('filterStatusStok');
    const tabelStok = document.getElementById('tableStokMenipis');
    const dataKosongStok = document.getElementById('dataKosongStok');


    function filterStokMenipis() {

        const keyword = searchStok.value.toLowerCase();
        const kategori = filterKategoriStok.value;
        const status = filterStatusStok.value;

        const rows = tabelStok.querySelectorAll('tbody tr');

        let jumlahTampil = 0;

        rows.forEach(row => {

            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);

            const cocokKategori = !kategori ||
                row.dataset.kategori === kategori;

            const cocokStatus = !status ||
                row.dataset.status === status;

            const tampil = cocokKeyword && cocokKategori && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) {
                jumlahTampil++;
            }

        });

        dataKosongStok.classList.toggle('d-none', jumlahTampil > 0);

    }


    searchStok.addEventListener('input', filterStokMenipis);
    filterKategoriStok.addEventListener('change', filterStokMenipis);
    filterStatusStok.addEventListener('change', filterStokMenipis);


    // ================= RESET FILTER =================
    function resetFilterStok() {

        searchStok.value = '';
        filterKategoriStok.value = '';
        filterStatusStok.value = '';

        filterStokMenipis();

    }


    // ================= DETAIL PRODUK =================
    function lihatDetailStok(button) {

        const data = button.dataset;

        document.getElementById('detailNamaProduk').innerText = data.nama;
        document.getElementById('detailSKU').innerText = data.kode;
        document.getElementById('detailKategori').innerText = data.kategori;
        document.getElementById('detailWarna').innerText = data.warna;
        document.getElementById('detailUkuran').innerText = data.ukuran;
        document.getElementById('detailHarga').innerText = data.harga;
        document.getElementById('detailStok').innerText = data.stok;
        document.getElementById('detailMinimum').innerText = data.minimum;
        document.getElementById('detailKekurangan').innerText = data.kekurangan;
        document.getElementById('detailCatatan').innerText = data.catatan;


        // TAMPILAN STATUS
        const detailStatus = document.getElementById('detailStatus');

        if (data.status === 'Kritis') {

            detailStatus.innerHTML = `
                <span class="badge bg-light-danger text-danger px-3 py-2">
                    <iconify-icon icon="solar:danger-bold-duotone" class="me-1"></iconify-icon>
                    Stok Kritis
                </span>
            `;

        } else {

            detailStatus.innerHTML = `
                <span class="badge bg-light-warning text-warning px-3 py-2">
                    <iconify-icon icon="solar:danger-triangle-bold-duotone" class="me-1"></iconify-icon>
                    Stok Menipis
                </span>
            `;

        }


        // TAMPILKAN MODAL
        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailProduk')
        );

        modal.show();

    }


    // ================= CETAK DATA STOK MENIPIS =================
    function cetakStokMenipis() {

        const rows = tabelStok.querySelectorAll('tbody tr');

        let isiTabel = '';
        let nomor = 1;

        rows.forEach(row => {

            if (row.style.display === 'none') return;

            const cells = row.querySelectorAll('td');

            isiTabel += `
                <tr>
                    <td>${nomor++}</td>
                    <td>${cells[1].innerText}</td>
                    <td>${cells[2].innerText}</td>
                    <td>${cells[3].innerText}</td>
                    <td>${cells[4].innerText}</td>
                    <td>${cells[5].innerText}</td>
                    <td>${cells[6].innerText}</td>
                    <td>${cells[7].innerText}</td>
                </tr>
            `;

        });


        const win = window.open('', '_blank');

        win.document.write(`
            <html>
            <head>
                <title>Laporan Stok Menipis</title>

                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }

                    h2 {
                        text-align: center;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }

                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        font-size: 11px;
                        text-align: left;
                    }

                    th {
                        background: #f1f5f9;
                    }
                </style>
            </head>

            <body>

                <h2>LAPORAN STOK MENIPIS</h2>

                <p>Alza Store</p>
                <p>Dicetak: ${new Date().toLocaleString('id-ID')}</p>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok Saat Ini</th>
                            <th>Stok Minimum</th>
                            <th>Kekurangan</th>
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