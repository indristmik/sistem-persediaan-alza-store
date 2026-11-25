<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Barang Masuk</h4>
            <p class="text-muted mb-0">
                Riwayat transaksi barang masuk dan penambahan persediaan Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-success text-success fs-3 px-3 py-2">
                <iconify-icon icon="solar:box-add-bold-duotone" class="me-1"></iconify-icon>
                Transaksi Masuk
            </span>
        </div>
    </div>

    <!-- ================= STATISTIK ================= -->
    <div class="row">

        <!-- TOTAL TRANSAKSI -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Transaksi</p>
                            <h4 class="fw-semibold mb-0">156</h4>
                            <small class="text-muted">Transaksi barang masuk</small>
                        </div>

                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:document-add-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL BARANG MASUK -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Barang Masuk</p>
                            <h4 class="fw-semibold mb-0">1.320</h4>
                            <small class="text-muted">Pcs barang</small>
                        </div>

                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:box-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSAKSI HARI INI -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Transaksi Hari Ini</p>
                            <h4 class="fw-semibold mb-0">6</h4>
                            <small class="text-muted">Transaksi masuk</small>
                        </div>

                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:calendar-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSAKSI BULAN INI -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Transaksi Bulan Ini</p>
                            <h4 class="fw-semibold mb-0">38</h4>
                            <small class="text-muted">November 2026</small>
                        </div>

                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon icon="solar:chart-bold-duotone"
                                class="fs-8 text-danger"></iconify-icon>
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
                        Filter Transaksi
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari Transaksi</label>
                            <input type="text" class="form-control" id="searchBarangMasuk"
                                placeholder="Kode transaksi, barang, supplier...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="filterKategoriBM">
                                <option value="">Semua Kategori</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="ATK">ATK</option>
                                <option value="Peralatan">Peralatan</option>
                                <option value="Kebersihan">Kebersihan</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Sumber Barang</label>
                            <select class="form-select" id="filterSumberBM">
                                <option value="">Semua Sumber</option>
                                <option value="Pembelian">Pembelian</option>
                                <option value="Supplier">Supplier</option>
                                <option value="Retur">Retur</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-primary w-100"
                                onclick="resetFilterBarangMasuk()">
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

    <!-- ================= TABEL BARANG MASUK ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Riwayat Barang Masuk
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Daftar transaksi penambahan persediaan
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="cetakBarangMasuk()">
                                <iconify-icon icon="solar:printer-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Cetak Riwayat
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableBarangMasuk">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>No. Referensi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Sumber</th>
                                    <th>Supplier</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- TRANSAKSI 1 -->
                                <tr data-kategori="Elektronik" data-sumber="Pembelian">
                                    <td class="ps-0">1</td>
                                    <td class="fw-semibold">MSK-001</td>
                                    <td>25 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Mouse Wireless</h6>
                                        <small class="text-muted">PRD-001</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">20 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Pembelian
                                        </span>
                                    </td>
                                    <td>CV Teknologi Jaya</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-001"
                                            data-tanggal="25 November 2026"
                                            data-barang="Mouse Wireless"
                                            data-kategori="Elektronik"
                                            data-jumlah="20 Pcs"
                                            data-sumber="Pembelian"
                                            data-supplier="CV Teknologi Jaya"
                                            data-admin="Admin 01"
                                            data-catatan="Pembelian stok mouse wireless untuk persediaan toko.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 2 -->
                                <tr data-kategori="ATK" data-sumber="Supplier">
                                    <td class="ps-0">2</td>
                                    <td class="fw-semibold">MSK-002</td>
                                    <td>24 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kertas A4</h6>
                                        <small class="text-muted">PRD-008</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-success">30 Rim</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Supplier
                                        </span>
                                    </td>
                                    <td>PT Sumber ATK</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-002"
                                            data-tanggal="24 November 2026"
                                            data-barang="Kertas A4"
                                            data-kategori="ATK"
                                            data-jumlah="30 Rim"
                                            data-sumber="Supplier"
                                            data-supplier="PT Sumber ATK"
                                            data-admin="Admin 01"
                                            data-catatan="Penambahan stok kertas A4 dari supplier.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 3 -->
                                <tr data-kategori="Kebersihan" data-sumber="Pembelian">
                                    <td class="ps-0">3</td>
                                    <td class="fw-semibold">MSK-003</td>
                                    <td>23 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Cairan Pembersih</h6>
                                        <small class="text-muted">PRD-014</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Kebersihan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">15 Botol</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Pembelian
                                        </span>
                                    </td>
                                    <td>Toko Bersih Sejahtera</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-003"
                                            data-tanggal="23 November 2026"
                                            data-barang="Cairan Pembersih"
                                            data-kategori="Kebersihan"
                                            data-jumlah="15 Botol"
                                            data-sumber="Pembelian"
                                            data-supplier="Toko Bersih Sejahtera"
                                            data-admin="Admin 02"
                                            data-catatan="Pembelian cairan pembersih untuk stok.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 4 -->
                                <tr data-kategori="Peralatan" data-sumber="Supplier">
                                    <td class="ps-0">4</td>
                                    <td class="fw-semibold">MSK-004</td>
                                    <td>22 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kabel LAN 5 Meter</h6>
                                        <small class="text-muted">PRD-004</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Peralatan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">10 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Supplier
                                        </span>
                                    </td>
                                    <td>CV Teknologi Jaya</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-004"
                                            data-tanggal="22 November 2026"
                                            data-barang="Kabel LAN 5 Meter"
                                            data-kategori="Peralatan"
                                            data-jumlah="10 Pcs"
                                            data-sumber="Supplier"
                                            data-supplier="CV Teknologi Jaya"
                                            data-admin="Admin 01"
                                            data-catatan="Pengadaan kabel LAN untuk kebutuhan toko.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 5 -->
                                <tr data-kategori="Elektronik" data-sumber="Pembelian">
                                    <td class="ps-0">5</td>
                                    <td class="fw-semibold">MSK-005</td>
                                    <td>21 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Keyboard USB</h6>
                                        <small class="text-muted">PRD-002</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">12 Unit</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Pembelian
                                        </span>
                                    </td>
                                    <td>CV Teknologi Jaya</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-005"
                                            data-tanggal="21 November 2026"
                                            data-barang="Keyboard USB"
                                            data-kategori="Elektronik"
                                            data-jumlah="12 Unit"
                                            data-sumber="Pembelian"
                                            data-supplier="CV Teknologi Jaya"
                                            data-admin="Admin 02"
                                            data-catatan="Pembelian keyboard USB untuk persediaan.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 6 -->
                                <tr data-kategori="ATK" data-sumber="Retur">
                                    <td class="ps-0">6</td>
                                    <td class="fw-semibold">MSK-006</td>
                                    <td>20 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Pulpen</h6>
                                        <small class="text-muted">PRD-009</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-success">10 Pcs</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Retur
                                        </span>
                                    </td>
                                    <td>Retur Pelanggan</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-006"
                                            data-tanggal="20 November 2026"
                                            data-barang="Pulpen"
                                            data-kategori="ATK"
                                            data-jumlah="10 Pcs"
                                            data-sumber="Retur"
                                            data-supplier="Retur Pelanggan"
                                            data-admin="Admin 01"
                                            data-catatan="Barang retur yang masih layak dimasukkan kembali ke stok.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 7 -->
                                <tr data-kategori="Peralatan" data-sumber="Pembelian">
                                    <td class="ps-0">7</td>
                                    <td class="fw-semibold">MSK-007</td>
                                    <td>19 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Stop Kontak</h6>
                                        <small class="text-muted">PRD-006</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">
                                            Peralatan
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">15 Unit</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">
                                            Pembelian
                                        </span>
                                    </td>
                                    <td>Toko Elektrik</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-007"
                                            data-tanggal="19 November 2026"
                                            data-barang="Stop Kontak"
                                            data-kategori="Peralatan"
                                            data-jumlah="15 Unit"
                                            data-sumber="Pembelian"
                                            data-supplier="Toko Elektrik"
                                            data-admin="Admin 02"
                                            data-catatan="Pembelian stop kontak untuk stok persediaan.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- TRANSAKSI 8 -->
                                <tr data-kategori="Elektronik" data-sumber="Supplier">
                                    <td class="ps-0">8</td>
                                    <td class="fw-semibold">MSK-008</td>
                                    <td>18 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Flashdisk 32GB</h6>
                                        <small class="text-muted">PRD-003</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Elektronik
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-success">8 Unit</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">
                                            Supplier
                                        </span>
                                    </td>
                                    <td>CV Teknologi Jaya</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBM(this)"
                                            data-kode="MSK-008"
                                            data-tanggal="18 November 2026"
                                            data-barang="Flashdisk 32GB"
                                            data-kategori="Elektronik"
                                            data-jumlah="8 Unit"
                                            data-sumber="Supplier"
                                            data-supplier="CV Teknologi Jaya"
                                            data-admin="Admin 01"
                                            data-catatan="Penambahan stok flashdisk 32GB.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- DATA KOSONG -->
                        <div id="dataKosongBM" class="text-center py-5 d-none">
                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>
                            <h6 class="mt-2">Data transaksi tidak ditemukan</h6>
                            <p class="text-muted mb-0">
                                Coba ubah kata kunci atau filter pencarian.
                            </p>
                        </div>

                    </div>

                    <!-- ================= PAGINATION ================= -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data transaksi barang masuk
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
            Alza Store &copy; <?= date('Y'); ?> - Barang Masuk
        </p>
    </div>

</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailBarangMasuk" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold">Detail Barang Masuk</h5>
                    <small class="text-muted" id="detailKodeBM"></small>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Tanggal</span>
                    <span class="fw-semibold" id="detailTanggalBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Nama Barang</span>
                    <span class="fw-semibold" id="detailBarangBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kategori</span>
                    <span id="detailKategoriBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Jumlah Masuk</span>
                    <span class="fw-semibold text-success" id="detailJumlahBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Sumber</span>
                    <span id="detailSumberBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Supplier</span>
                    <span id="detailSupplierBM"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Admin</span>
                    <span id="detailAdminBM"></span>
                </div>

                <div class="mt-3">
                    <label class="text-muted mb-1">Catatan</label>
                    <p class="mb-0" id="detailCatatanBM"></p>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Tutup
                </button>

                <button type="button" class="btn btn-primary" onclick="cetakDetailBM()">
                    <iconify-icon icon="solar:printer-bold-duotone" class="me-1"></iconify-icon>
                    Cetak
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    // ================= FILTER & SEARCH =================
    const searchBarangMasuk = document.getElementById('searchBarangMasuk');
    const filterKategoriBM = document.getElementById('filterKategoriBM');
    const filterSumberBM = document.getElementById('filterSumberBM');
    const tabelBarangMasuk = document.getElementById('tableBarangMasuk');
    const dataKosongBM = document.getElementById('dataKosongBM');

    function filterBarangMasuk() {
        const keyword = searchBarangMasuk.value.toLowerCase();
        const kategori = filterKategoriBM.value;
        const sumber = filterSumberBM.value;

        const rows = tabelBarangMasuk.querySelectorAll('tbody tr');
        let jumlahTampil = 0;

        rows.forEach(row => {
            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);
            const cocokKategori = !kategori || row.dataset.kategori === kategori;
            const cocokSumber = !sumber || row.dataset.sumber === sumber;

            const tampil = cocokKeyword && cocokKategori && cocokSumber;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;
        });

        dataKosongBM.classList.toggle('d-none', jumlahTampil > 0);
    }

    searchBarangMasuk.addEventListener('input', filterBarangMasuk);
    filterKategoriBM.addEventListener('change', filterBarangMasuk);
    filterSumberBM.addEventListener('change', filterBarangMasuk);

    function resetFilterBarangMasuk() {
        searchBarangMasuk.value = '';
        filterKategoriBM.value = '';
        filterSumberBM.value = '';
        filterBarangMasuk();
    }

    // ================= DETAIL TRANSAKSI =================
    let dataCetakBM = {};

    function lihatDetailBM(button) {
        dataCetakBM = {
            kode: button.dataset.kode,
            tanggal: button.dataset.tanggal,
            barang: button.dataset.barang,
            kategori: button.dataset.kategori,
            jumlah: button.dataset.jumlah,
            sumber: button.dataset.sumber,
            supplier: button.dataset.supplier,
            admin: button.dataset.admin,
            catatan: button.dataset.catatan
        };

        document.getElementById('detailKodeBM').innerText = dataCetakBM.kode;
        document.getElementById('detailTanggalBM').innerText = dataCetakBM.tanggal;
        document.getElementById('detailBarangBM').innerText = dataCetakBM.barang;
        document.getElementById('detailKategoriBM').innerText = dataCetakBM.kategori;
        document.getElementById('detailJumlahBM').innerText = dataCetakBM.jumlah;
        document.getElementById('detailSumberBM').innerText = dataCetakBM.sumber;
        document.getElementById('detailSupplierBM').innerText = dataCetakBM.supplier;
        document.getElementById('detailAdminBM').innerText = dataCetakBM.admin;
        document.getElementById('detailCatatanBM').innerText = dataCetakBM.catatan;

        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailBarangMasuk')
        );

        modal.show();
    }

    // ================= CETAK DETAIL =================
    function cetakDetailBM() {
        const d = dataCetakBM;

        const html = `
            <html>
            <head>
                <title>Bukti Barang Masuk ${d.kode}</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 30px; }
                    h2 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 25px; }
                    td { padding: 10px; border-bottom: 1px solid #ddd; }
                    td:first-child { width: 35%; font-weight: bold; }
                    .signature { display: flex; justify-content: space-between; margin-top: 70px; }
                    .sign { width: 40%; text-align: center; }
                </style>
            </head>
            <body>
                <h2>BUKTI BARANG MASUK</h2>
                <p style="text-align:center">No. Referensi: ${d.kode}</p>

                <table>
                    <tr><td>Tanggal</td><td>${d.tanggal}</td></tr>
                    <tr><td>Nama Barang</td><td>${d.barang}</td></tr>
                    <tr><td>Kategori</td><td>${d.kategori}</td></tr>
                    <tr><td>Jumlah Masuk</td><td>${d.jumlah}</td></tr>
                    <tr><td>Sumber</td><td>${d.sumber}</td></tr>
                    <tr><td>Supplier</td><td>${d.supplier}</td></tr>
                    <tr><td>Admin</td><td>${d.admin}</td></tr>
                    <tr><td>Catatan</td><td>${d.catatan}</td></tr>
                </table>

                <div class="signature">
                    <div class="sign">
                        Penerima<br><br><br><br>
                        ( __________________ )
                    </div>
                    <div class="sign">
                        Petugas<br><br><br><br>
                        ( ${d.admin} )
                    </div>
                </div>

                <script>
                    window.onload = () => window.print();
                <\/script>
            </body>
            </html>
        `;

        const win = window.open('', '_blank');
        win.document.write(html);
        win.document.close();
    }

    // ================= CETAK RIWAYAT =================
    function cetakBarangMasuk() {
        const rows = tabelBarangMasuk.querySelectorAll('tbody tr');
        let isiTabel = '';

        rows.forEach(row => {
            if (row.style.display === 'none') return;

            const cells = row.querySelectorAll('td');
            isiTabel += '<tr>';

            for (let i = 0; i < cells.length - 1; i++) {
                isiTabel += '<td>' + cells[i].innerText + '</td>';
            }

            isiTabel += '</tr>';
        });

        const win = window.open('', '_blank');

        win.document.write(`
            <html>
            <head>
                <title>Laporan Barang Masuk</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    h2 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ccc; padding: 8px; font-size: 11px; }
                    th { background: #f1f5f9; }
                </style>
            </head>
            <body>
                <h2>RIWAYAT BARANG MASUK</h2>
                <p>Dicetak: ${new Date().toLocaleString('id-ID')}</p>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Referensi</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Sumber</th>
                            <th>Supplier</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>${isiTabel}</tbody>
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