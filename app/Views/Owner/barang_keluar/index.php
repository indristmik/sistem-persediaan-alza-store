<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Barang Keluar</h4>
            <p class="text-muted mb-0">
                Riwayat transaksi barang keluar Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-danger text-danger fs-3 px-3 py-2">
                <iconify-icon icon="solar:box-minimalistic-bold-duotone" class="me-1"></iconify-icon>
                Transaksi Keluar
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
                            <h4 class="fw-semibold mb-0">128</h4>
                            <small class="text-muted">Transaksi barang keluar</small>
                        </div>

                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:document-text-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL BARANG -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Barang Keluar</p>
                            <h4 class="fw-semibold mb-0">486</h4>
                            <small class="text-muted">Pcs barang</small>
                        </div>

                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon icon="solar:box-minimalistic-bold-duotone"
                                class="fs-8 text-danger"></iconify-icon>
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
                            <h4 class="fw-semibold mb-0">8</h4>
                            <small class="text-muted">Transaksi keluar</small>
                        </div>

                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:calendar-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSAKSI BULAN -->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Transaksi Bulan Ini</p>
                            <h4 class="fw-semibold mb-0">42</h4>
                            <small class="text-muted">November 2026</small>
                        </div>

                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:chart-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTER TRANSAKSI ================= -->
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
                            <input type="text" class="form-control" id="searchBarangKeluar"
                                placeholder="Kode transaksi, barang, penerima...">
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
                            <label class="form-label">Keperluan</label>
                            <select class="form-select" id="filterKeperluan">
                                <option value="">Semua Keperluan</option>
                                <option value="Operasional">Operasional</option>
                                <option value="Pemeliharaan">Pemeliharaan</option>
                                <option value="Penggantian">Penggantian</option>
                                <option value="Kebutuhan Kantor">Kebutuhan Kantor</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-primary w-100"
                                onclick="resetFilterBarangKeluar()">
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

    <!-- ================= TABEL BARANG KELUAR ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Riwayat Barang Keluar
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Daftar transaksi pengeluaran persediaan
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="cetakBarangKeluar()">
                                <iconify-icon icon="solar:printer-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Cetak Riwayat
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableBarangKeluar">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>No. Referensi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Penerima</th>
                                    <th>Keperluan</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr data-kategori="Elektronik" data-keperluan="Pemeliharaan">
                                    <td class="ps-0">1</td>
                                    <td class="fw-semibold">KLR-001</td>
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
                                    <td class="fw-semibold text-danger">5 Pcs</td>
                                    <td>Bagian IT</td>
                                    <td>Pemeliharaan</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-001"
                                            data-tanggal="25 November 2026"
                                            data-barang="Mouse Wireless"
                                            data-kategori="Elektronik"
                                            data-jumlah="5 Pcs"
                                            data-penerima="Bagian IT"
                                            data-keperluan="Pemeliharaan"
                                            data-admin="Admin 01"
                                            data-catatan="Penggantian mouse komputer yang rusak.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="ATK" data-keperluan="Kebutuhan Kantor">
                                    <td class="ps-0">2</td>
                                    <td class="fw-semibold">KLR-002</td>
                                    <td>24 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kertas A4</h6>
                                        <small class="text-muted">PRD-008</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-danger">10 Rim</td>
                                    <td>Administrasi</td>
                                    <td>Kebutuhan Kantor</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-002"
                                            data-tanggal="24 November 2026"
                                            data-barang="Kertas A4"
                                            data-kategori="ATK"
                                            data-jumlah="10 Rim"
                                            data-penerima="Administrasi"
                                            data-keperluan="Kebutuhan Kantor"
                                            data-admin="Admin 01"
                                            data-catatan="Pengeluaran kertas untuk kebutuhan administrasi.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="Kebersihan" data-keperluan="Operasional">
                                    <td class="ps-0">3</td>
                                    <td class="fw-semibold">KLR-003</td>
                                    <td>24 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Cairan Pembersih</h6>
                                        <small class="text-muted">PRD-014</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Kebersihan</span>
                                    </td>
                                    <td class="fw-semibold text-danger">8 Botol</td>
                                    <td>Petugas Kebersihan</td>
                                    <td>Operasional</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-003"
                                            data-tanggal="24 November 2026"
                                            data-barang="Cairan Pembersih"
                                            data-kategori="Kebersihan"
                                            data-jumlah="8 Botol"
                                            data-penerima="Petugas Kebersihan"
                                            data-keperluan="Operasional"
                                            data-admin="Admin 02"
                                            data-catatan="Bahan kebersihan untuk penggunaan operasional.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="Peralatan" data-keperluan="Penggantian">
                                    <td class="ps-0">4</td>
                                    <td class="fw-semibold">KLR-004</td>
                                    <td>23 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kabel LAN 5 Meter</h6>
                                        <small class="text-muted">PRD-004</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Peralatan</span>
                                    </td>
                                    <td class="fw-semibold text-danger">3 Pcs</td>
                                    <td>Bagian IT</td>
                                    <td>Penggantian</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-004"
                                            data-tanggal="23 November 2026"
                                            data-barang="Kabel LAN 5 Meter"
                                            data-kategori="Peralatan"
                                            data-jumlah="3 Pcs"
                                            data-penerima="Bagian IT"
                                            data-keperluan="Penggantian"
                                            data-admin="Admin 01"
                                            data-catatan="Penggantian kabel jaringan yang rusak.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="Elektronik" data-keperluan="Pemeliharaan">
                                    <td class="ps-0">5</td>
                                    <td class="fw-semibold">KLR-005</td>
                                    <td>22 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Keyboard USB</h6>
                                        <small class="text-muted">PRD-002</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">Elektronik</span>
                                    </td>
                                    <td class="fw-semibold text-danger">2 Unit</td>
                                    <td>Bagian IT</td>
                                    <td>Pemeliharaan</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-005"
                                            data-tanggal="22 November 2026"
                                            data-barang="Keyboard USB"
                                            data-kategori="Elektronik"
                                            data-jumlah="2 Unit"
                                            data-penerima="Bagian IT"
                                            data-keperluan="Pemeliharaan"
                                            data-admin="Admin 02"
                                            data-catatan="Keyboard untuk mengganti perangkat yang rusak.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="ATK" data-keperluan="Kebutuhan Kantor">
                                    <td class="ps-0">6</td>
                                    <td class="fw-semibold">KLR-006</td>
                                    <td>21 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Pulpen</h6>
                                        <small class="text-muted">PRD-009</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">ATK</span>
                                    </td>
                                    <td class="fw-semibold text-danger">20 Pcs</td>
                                    <td>Administrasi</td>
                                    <td>Kebutuhan Kantor</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-006"
                                            data-tanggal="21 November 2026"
                                            data-barang="Pulpen"
                                            data-kategori="ATK"
                                            data-jumlah="20 Pcs"
                                            data-penerima="Administrasi"
                                            data-keperluan="Kebutuhan Kantor"
                                            data-admin="Admin 01"
                                            data-catatan="Distribusi alat tulis kantor.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="Peralatan" data-keperluan="Operasional">
                                    <td class="ps-0">7</td>
                                    <td class="fw-semibold">KLR-007</td>
                                    <td>20 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Stop Kontak</h6>
                                        <small class="text-muted">PRD-006</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Peralatan</span>
                                    </td>
                                    <td class="fw-semibold text-danger">4 Unit</td>
                                    <td>Bagian Umum</td>
                                    <td>Operasional</td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-007"
                                            data-tanggal="20 November 2026"
                                            data-barang="Stop Kontak"
                                            data-kategori="Peralatan"
                                            data-jumlah="4 Unit"
                                            data-penerima="Bagian Umum"
                                            data-keperluan="Operasional"
                                            data-admin="Admin 02"
                                            data-catatan="Digunakan untuk kebutuhan operasional ruangan.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <tr data-kategori="Elektronik" data-keperluan="Penggantian">
                                    <td class="ps-0">8</td>
                                    <td class="fw-semibold">KLR-008</td>
                                    <td>19 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Flashdisk 32GB</h6>
                                        <small class="text-muted">PRD-003</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">Elektronik</span>
                                    </td>
                                    <td class="fw-semibold text-danger">1 Unit</td>
                                    <td>Bagian IT</td>
                                    <td>Penggantian</td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailBK(this)"
                                            data-kode="KLR-008"
                                            data-tanggal="19 November 2026"
                                            data-barang="Flashdisk 32GB"
                                            data-kategori="Elektronik"
                                            data-jumlah="1 Unit"
                                            data-penerima="Bagian IT"
                                            data-keperluan="Penggantian"
                                            data-admin="Admin 01"
                                            data-catatan="Flashdisk untuk kebutuhan penyimpanan data.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <div id="dataKosongBK" class="text-center py-5 d-none">
                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>
                            <h6 class="mt-2">Data transaksi tidak ditemukan</h6>
                            <p class="text-muted mb-0">Coba ubah kata kunci atau filter.</p>
                        </div>

                    </div>

                    <!-- ================= PAGINATION ================= -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data transaksi barang keluar
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
            Alza Store &copy; <?= date('Y'); ?> - Barang Keluar
        </p>
    </div>

</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailBarangKeluar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold">Detail Barang Keluar</h5>
                    <small class="text-muted" id="detailKodeBK"></small>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Tanggal</span>
                    <span class="fw-semibold" id="detailTanggalBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Nama Barang</span>
                    <span class="fw-semibold" id="detailBarangBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kategori</span>
                    <span id="detailKategoriBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Jumlah</span>
                    <span class="fw-semibold text-danger" id="detailJumlahBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Penerima</span>
                    <span class="fw-semibold" id="detailPenerimaBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Keperluan</span>
                    <span id="detailKeperluanBK"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Admin</span>
                    <span id="detailAdminBK"></span>
                </div>

                <div class="mt-3">
                    <label class="text-muted mb-1">Catatan</label>
                    <p class="mb-0" id="detailCatatanBK"></p>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="cetakDetailBK()">
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
    const searchBarangKeluar = document.getElementById('searchBarangKeluar');
    const filterKategori = document.getElementById('filterKategori');
    const filterKeperluan = document.getElementById('filterKeperluan');
    const tabelBarangKeluar = document.getElementById('tableBarangKeluar');
    const dataKosongBK = document.getElementById('dataKosongBK');

    function filterBarangKeluar() {
        const keyword = searchBarangKeluar.value.toLowerCase();
        const kategori = filterKategori.value;
        const keperluan = filterKeperluan.value;

        const rows = tabelBarangKeluar.querySelectorAll('tbody tr');
        let jumlahTampil = 0;

        rows.forEach(row => {
            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);
            const cocokKategori = !kategori || row.dataset.kategori === kategori;
            const cocokKeperluan = !keperluan || row.dataset.keperluan === keperluan;

            const tampil = cocokKeyword && cocokKategori && cocokKeperluan;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;
        });

        dataKosongBK.classList.toggle('d-none', jumlahTampil > 0);
    }

    searchBarangKeluar.addEventListener('input', filterBarangKeluar);
    filterKategori.addEventListener('change', filterBarangKeluar);
    filterKeperluan.addEventListener('change', filterBarangKeluar);

    function resetFilterBarangKeluar() {
        searchBarangKeluar.value = '';
        filterKategori.value = '';
        filterKeperluan.value = '';
        filterBarangKeluar();
    }

    // ================= DETAIL TRANSAKSI =================
    let dataCetakBK = {};

    function lihatDetailBK(button) {
        dataCetakBK = {
            kode: button.dataset.kode,
            tanggal: button.dataset.tanggal,
            barang: button.dataset.barang,
            kategori: button.dataset.kategori,
            jumlah: button.dataset.jumlah,
            penerima: button.dataset.penerima,
            keperluan: button.dataset.keperluan,
            admin: button.dataset.admin,
            catatan: button.dataset.catatan
        };

        document.getElementById('detailKodeBK').innerText = dataCetakBK.kode;
        document.getElementById('detailTanggalBK').innerText = dataCetakBK.tanggal;
        document.getElementById('detailBarangBK').innerText = dataCetakBK.barang;
        document.getElementById('detailKategoriBK').innerText = dataCetakBK.kategori;
        document.getElementById('detailJumlahBK').innerText = dataCetakBK.jumlah;
        document.getElementById('detailPenerimaBK').innerText = dataCetakBK.penerima;
        document.getElementById('detailKeperluanBK').innerText = dataCetakBK.keperluan;
        document.getElementById('detailAdminBK').innerText = dataCetakBK.admin;
        document.getElementById('detailCatatanBK').innerText = dataCetakBK.catatan;

        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailBarangKeluar')
        );

        modal.show();
    }

    // ================= CETAK DETAIL =================
    function cetakDetailBK() {
        const d = dataCetakBK;

        const html = `
            <html>
            <head>
                <title>Bukti Barang Keluar ${d.kode}</title>
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
                <h2>BUKTI BARANG KELUAR</h2>
                <p style="text-align:center">No. Referensi: ${d.kode}</p>

                <table>
                    <tr><td>Tanggal</td><td>${d.tanggal}</td></tr>
                    <tr><td>Nama Barang</td><td>${d.barang}</td></tr>
                    <tr><td>Kategori</td><td>${d.kategori}</td></tr>
                    <tr><td>Jumlah</td><td>${d.jumlah}</td></tr>
                    <tr><td>Penerima</td><td>${d.penerima}</td></tr>
                    <tr><td>Keperluan</td><td>${d.keperluan}</td></tr>
                    <tr><td>Admin</td><td>${d.admin}</td></tr>
                    <tr><td>Catatan</td><td>${d.catatan}</td></tr>
                </table>

                <div class="signature">
                    <div class="sign">
                        Penerima<br><br><br><br>
                        (${d.penerima})
                    </div>
                    <div class="sign">
                        Petugas<br><br><br><br>
                        (${d.admin})
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
    function cetakBarangKeluar() {
        const rows = tabelBarangKeluar.querySelectorAll('tbody tr');
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
                <title>Laporan Barang Keluar</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    h2 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ccc; padding: 8px; font-size: 11px; }
                    th { background: #f1f5f9; }
                </style>
            </head>
            <body>
                <h2>RIWAYAT BARANG KELUAR</h2>
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
                            <th>Penerima</th>
                            <th>Keperluan</th>
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