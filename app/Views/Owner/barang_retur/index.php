<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Barang Retur</h4>
            <p class="text-muted mb-0">
                Riwayat pengembalian barang dari pelanggan maupun ke supplier Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-warning text-warning fs-3 px-3 py-2">
                <iconify-icon icon="solar:box-minimalistic-bold-duotone" class="me-1"></iconify-icon>
                Transaksi Retur
            </span>
        </div>
    </div>

    <!-- ================= STATISTIK ================= -->
    <div class="row">

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Retur</p>
                            <h4 class="fw-semibold mb-0">48</h4>
                            <small class="text-muted">Seluruh transaksi retur</small>
                        </div>
                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:document-text-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Retur Pelanggan</p>
                            <h4 class="fw-semibold mb-0">32</h4>
                            <small class="text-muted">Barang dikembalikan pelanggan</small>
                        </div>
                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:undo-left-round-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Retur Supplier</p>
                            <h4 class="fw-semibold mb-0">16</h4>
                            <small class="text-muted">Barang dikembalikan ke supplier</small>
                        </div>
                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:undo-right-round-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Menunggu Proses</p>
                            <h4 class="fw-semibold mb-0">5</h4>
                            <small class="text-muted">Retur belum diselesaikan</small>
                        </div>
                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon icon="solar:clock-circle-bold-duotone"
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
                        Filter Transaksi Retur
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari Transaksi</label>
                            <input type="text" class="form-control" id="searchRetur"
                                placeholder="Kode retur, barang, pelanggan, supplier...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Jenis Retur</label>
                            <select class="form-select" id="filterJenisRetur">
                                <option value="">Semua Jenis</option>
                                <option value="Pelanggan">Retur Pelanggan</option>
                                <option value="Supplier">Retur Supplier</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status Retur</label>
                            <select class="form-select" id="filterStatusRetur">
                                <option value="">Semua Status</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Menunggu">Menunggu</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-primary w-100"
                                onclick="resetFilterRetur()">
                                <iconify-icon icon="solar:restart-bold-duotone" class="me-1"></iconify-icon>
                                Reset
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= TABEL BARANG RETUR ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Riwayat Barang Retur
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Daftar transaksi pengembalian barang
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="cetakBarangRetur()">
                                <iconify-icon icon="solar:printer-bold-duotone" class="me-1"></iconify-icon>
                                Cetak Riwayat
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableBarangRetur">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>No. Retur</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Retur</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- RETUR 1 -->
                                <tr data-jenis="Pelanggan" data-status="Selesai">
                                    <td class="ps-0">1</td>
                                    <td class="fw-semibold">RTR-001</td>
                                    <td>25 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Mouse Wireless</h6>
                                        <small class="text-muted">PRD-001</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Pelanggan</span>
                                    </td>
                                    <td class="fw-semibold">2 Pcs</td>
                                    <td>Barang tidak sesuai</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Selesai</span>
                                    </td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-001"
                                            data-tanggal="25 November 2026"
                                            data-barang="Mouse Wireless"
                                            data-produk="PRD-001"
                                            data-jenis="Pelanggan"
                                            data-jumlah="2 Pcs"
                                            data-alasan="Barang tidak sesuai dengan pesanan pelanggan."
                                            data-pihak="Budi Santoso"
                                            data-kondisi="Baik"
                                            data-status="Selesai"
                                            data-admin="Admin 01"
                                            data-catatan="Barang telah diperiksa dan masih layak untuk dimasukkan kembali ke stok.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- RETUR 2 -->
                                <tr data-jenis="Supplier" data-status="Diproses">
                                    <td class="ps-0">2</td>
                                    <td class="fw-semibold">RTR-002</td>
                                    <td>24 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Keyboard USB</h6>
                                        <small class="text-muted">PRD-002</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Supplier</span>
                                    </td>
                                    <td class="fw-semibold">3 Unit</td>
                                    <td>Barang rusak</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Diproses</span>
                                    </td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-002"
                                            data-tanggal="24 November 2026"
                                            data-barang="Keyboard USB"
                                            data-produk="PRD-002"
                                            data-jenis="Supplier"
                                            data-jumlah="3 Unit"
                                            data-alasan="Beberapa tombol keyboard tidak berfungsi."
                                            data-pihak="CV Teknologi Jaya"
                                            data-kondisi="Rusak"
                                            data-status="Diproses"
                                            data-admin="Admin 01"
                                            data-catatan="Barang sedang menunggu konfirmasi pengembalian dari supplier.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- RETUR 3 -->
                                <tr data-jenis="Pelanggan" data-status="Selesai">
                                    <td class="ps-0">3</td>
                                    <td class="fw-semibold">RTR-003</td>
                                    <td>23 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Flashdisk 32GB</h6>
                                        <small class="text-muted">PRD-003</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Pelanggan</span>
                                    </td>
                                    <td class="fw-semibold">1 Unit</td>
                                    <td>Tidak dapat digunakan</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Selesai</span>
                                    </td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-003"
                                            data-tanggal="23 November 2026"
                                            data-barang="Flashdisk 32GB"
                                            data-produk="PRD-003"
                                            data-jenis="Pelanggan"
                                            data-jumlah="1 Unit"
                                            data-alasan="Flashdisk tidak dapat terbaca oleh perangkat."
                                            data-pihak="Siti Aminah"
                                            data-kondisi="Rusak"
                                            data-status="Selesai"
                                            data-admin="Admin 02"
                                            data-catatan="Retur telah selesai diproses dan barang dipisahkan dari stok layak jual.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- RETUR 4 -->
                                <tr data-jenis="Supplier" data-status="Menunggu">
                                    <td class="ps-0">4</td>
                                    <td class="fw-semibold">RTR-004</td>
                                    <td>22 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kabel LAN 5 Meter</h6>
                                        <small class="text-muted">PRD-004</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Supplier</span>
                                    </td>
                                    <td class="fw-semibold">5 Pcs</td>
                                    <td>Kualitas tidak sesuai</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger">Menunggu</span>
                                    </td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-004"
                                            data-tanggal="22 November 2026"
                                            data-barang="Kabel LAN 5 Meter"
                                            data-produk="PRD-004"
                                            data-jenis="Supplier"
                                            data-jumlah="5 Pcs"
                                            data-alasan="Kualitas barang tidak sesuai dengan spesifikasi pesanan."
                                            data-pihak="CV Teknologi Jaya"
                                            data-kondisi="Tidak Sesuai"
                                            data-status="Menunggu"
                                            data-admin="Admin 02"
                                            data-catatan="Menunggu persetujuan supplier untuk pengembalian barang.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- RETUR 5 -->
                                <tr data-jenis="Pelanggan" data-status="Diproses">
                                    <td class="ps-0">5</td>
                                    <td class="fw-semibold">RTR-005</td>
                                    <td>21 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Stop Kontak</h6>
                                        <small class="text-muted">PRD-006</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Pelanggan</span>
                                    </td>
                                    <td class="fw-semibold">2 Unit</td>
                                    <td>Produk cacat</td>
                                    <td>
                                        <span class="badge bg-light-warning text-warning">Diproses</span>
                                    </td>
                                    <td>Admin 01</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-005"
                                            data-tanggal="21 November 2026"
                                            data-barang="Stop Kontak"
                                            data-produk="PRD-006"
                                            data-jenis="Pelanggan"
                                            data-jumlah="2 Unit"
                                            data-alasan="Produk mengalami kerusakan pada bagian sakelar."
                                            data-pihak="Andi Pratama"
                                            data-kondisi="Rusak"
                                            data-status="Diproses"
                                            data-admin="Admin 01"
                                            data-catatan="Barang sedang diperiksa untuk menentukan tindak lanjut retur.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                                <!-- RETUR 6 -->
                                <tr data-jenis="Pelanggan" data-status="Selesai">
                                    <td class="ps-0">6</td>
                                    <td class="fw-semibold">RTR-006</td>
                                    <td>20 Nov 2026</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold">Kertas A4</h6>
                                        <small class="text-muted">PRD-008</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Pelanggan</span>
                                    </td>
                                    <td class="fw-semibold">2 Rim</td>
                                    <td>Salah ukuran</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Selesai</span>
                                    </td>
                                    <td>Admin 02</td>
                                    <td>
                                        <button class="btn btn-sm btn-light-primary"
                                            onclick="lihatDetailRetur(this)"
                                            data-kode="RTR-006"
                                            data-tanggal="20 November 2026"
                                            data-barang="Kertas A4"
                                            data-produk="PRD-008"
                                            data-jenis="Pelanggan"
                                            data-jumlah="2 Rim"
                                            data-alasan="Ukuran barang tidak sesuai dengan kebutuhan pelanggan."
                                            data-pihak="Rina Marlina"
                                            data-kondisi="Baik"
                                            data-status="Selesai"
                                            data-admin="Admin 02"
                                            data-catatan="Barang telah diperiksa dan dikembalikan ke persediaan.">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- DATA KOSONG -->
                        <div id="dataKosongRetur" class="text-center py-5 d-none">
                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>
                            <h6 class="mt-2">Data retur tidak ditemukan</h6>
                            <p class="text-muted mb-0">
                                Coba ubah kata kunci atau filter pencarian.
                            </p>
                        </div>

                    </div>

                    <!-- ================= PAGINATION ================= -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data transaksi barang retur
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
            Alza Store &copy; <?= date('Y'); ?> - Barang Retur
        </p>
    </div>

</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailRetur" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold">Detail Barang Retur</h5>
                    <small class="text-muted" id="detailKodeRetur"></small>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Tanggal</span>
                    <span class="fw-semibold" id="detailTanggalRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Nama Barang</span>
                    <span class="fw-semibold" id="detailBarangRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kode Produk</span>
                    <span class="fw-semibold" id="detailProdukRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Jenis Retur</span>
                    <span id="detailJenisRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Jumlah Retur</span>
                    <span class="fw-semibold" id="detailJumlahRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Pihak Terkait</span>
                    <span class="fw-semibold" id="detailPihakRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kondisi Barang</span>
                    <span id="detailKondisiRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Status</span>
                    <span id="detailStatusRetur"></span>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Admin</span>
                    <span class="fw-semibold" id="detailAdminRetur"></span>
                </div>

                <div class="mt-3">
                    <label class="text-muted mb-1">Alasan Retur</label>
                    <p class="mb-2" id="detailAlasanRetur"></p>

                    <label class="text-muted mb-1">Catatan</label>
                    <p class="mb-0" id="detailCatatanRetur"></p>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Tutup
                </button>

                <button type="button" class="btn btn-primary" onclick="cetakDetailRetur()">
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
    const searchRetur = document.getElementById('searchRetur');
    const filterJenisRetur = document.getElementById('filterJenisRetur');
    const filterStatusRetur = document.getElementById('filterStatusRetur');
    const tabelBarangRetur = document.getElementById('tableBarangRetur');
    const dataKosongRetur = document.getElementById('dataKosongRetur');

    function filterBarangRetur() {
        const keyword = searchRetur.value.toLowerCase();
        const jenis = filterJenisRetur.value;
        const status = filterStatusRetur.value;

        const rows = tabelBarangRetur.querySelectorAll('tbody tr');
        let jumlahTampil = 0;

        rows.forEach(row => {
            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);
            const cocokJenis = !jenis || row.dataset.jenis === jenis;
            const cocokStatus = !status || row.dataset.status === status;

            const tampil = cocokKeyword && cocokJenis && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;
        });

        dataKosongRetur.classList.toggle('d-none', jumlahTampil > 0);
    }

    searchRetur.addEventListener('input', filterBarangRetur);
    filterJenisRetur.addEventListener('change', filterBarangRetur);
    filterStatusRetur.addEventListener('change', filterBarangRetur);

    function resetFilterRetur() {
        searchRetur.value = '';
        filterJenisRetur.value = '';
        filterStatusRetur.value = '';

        filterBarangRetur();
    }

    // ================= DETAIL RETUR =================
    let dataCetakRetur = {};

    function lihatDetailRetur(button) {

        dataCetakRetur = {
            kode: button.dataset.kode,
            tanggal: button.dataset.tanggal,
            barang: button.dataset.barang,
            produk: button.dataset.produk,
            jenis: button.dataset.jenis,
            jumlah: button.dataset.jumlah,
            alasan: button.dataset.alasan,
            pihak: button.dataset.pihak,
            kondisi: button.dataset.kondisi,
            status: button.dataset.status,
            admin: button.dataset.admin,
            catatan: button.dataset.catatan
        };

        document.getElementById('detailKodeRetur').innerText = dataCetakRetur.kode;
        document.getElementById('detailTanggalRetur').innerText = dataCetakRetur.tanggal;
        document.getElementById('detailBarangRetur').innerText = dataCetakRetur.barang;
        document.getElementById('detailProdukRetur').innerText = dataCetakRetur.produk;
        document.getElementById('detailJenisRetur').innerText = dataCetakRetur.jenis;
        document.getElementById('detailJumlahRetur').innerText = dataCetakRetur.jumlah;
        document.getElementById('detailPihakRetur').innerText = dataCetakRetur.pihak;
        document.getElementById('detailKondisiRetur').innerText = dataCetakRetur.kondisi;
        document.getElementById('detailStatusRetur').innerText = dataCetakRetur.status;
        document.getElementById('detailAdminRetur').innerText = dataCetakRetur.admin;
        document.getElementById('detailAlasanRetur').innerText = dataCetakRetur.alasan;
        document.getElementById('detailCatatanRetur').innerText = dataCetakRetur.catatan;

        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailRetur')
        );

        modal.show();
    }

    // ================= CETAK DETAIL RETUR =================
    function cetakDetailRetur() {
        const d = dataCetakRetur;

        const win = window.open('', '_blank');

        win.document.write(`
            <html>
            <head>
                <title>Bukti Retur ${d.kode}</title>
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
                <h2>BUKTI TRANSAKSI BARANG RETUR</h2>
                <p style="text-align:center">No. Retur: ${d.kode}</p>

                <table>
                    <tr><td>Tanggal</td><td>${d.tanggal}</td></tr>
                    <tr><td>Nama Barang</td><td>${d.barang}</td></tr>
                    <tr><td>Kode Produk</td><td>${d.produk}</td></tr>
                    <tr><td>Jenis Retur</td><td>${d.jenis}</td></tr>
                    <tr><td>Jumlah</td><td>${d.jumlah}</td></tr>
                    <tr><td>Pihak Terkait</td><td>${d.pihak}</td></tr>
                    <tr><td>Kondisi Barang</td><td>${d.kondisi}</td></tr>
                    <tr><td>Alasan Retur</td><td>${d.alasan}</td></tr>
                    <tr><td>Status</td><td>${d.status}</td></tr>
                    <tr><td>Admin</td><td>${d.admin}</td></tr>
                    <tr><td>Catatan</td><td>${d.catatan}</td></tr>
                </table>

                <div class="signature">
                    <div class="sign">
                        Pihak Terkait<br><br><br><br>
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
        `);

        win.document.close();
    }

    // ================= CETAK RIWAYAT RETUR =================
    function cetakBarangRetur() {
        const rows = tabelBarangRetur.querySelectorAll('tbody tr');
        let isiTabel = '';
        let nomor = 1;

        rows.forEach(row => {
            if (row.style.display === 'none') return;

            const cells = row.querySelectorAll('td');

            isiTabel += '<tr>';

            isiTabel += '<td>' + nomor++ + '</td>';

            for (let i = 1; i < cells.length - 1; i++) {
                isiTabel += '<td>' + cells[i].innerText + '</td>';
            }

            isiTabel += '</tr>';
        });

        const win = window.open('', '_blank');

        win.document.write(`
            <html>
            <head>
                <title>Laporan Barang Retur</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    h2 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ccc; padding: 8px; font-size: 11px; }
                    th { background: #f1f5f9; }
                </style>
            </head>
            <body>
                <h2>RIWAYAT BARANG RETUR</h2>
                <p>Dicetak: ${new Date().toLocaleString('id-ID')}</p>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Retur</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jenis Retur</th>
                            <th>Jumlah</th>
                            <th>Alasan</th>
                            <th>Status</th>
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