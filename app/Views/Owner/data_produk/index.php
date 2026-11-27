<?php

/**
 * @var array $produk
 * @var array $kategori
 * @var \App\Models\VarianProdukModel $varianModel
 * @var int $totalProduk
 * @var int $totalKategori
 * @var int $totalVarian
 * @var int $totalStokMenipis
 */
?>

<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Data Produk</h4>
            <p class="text-muted mb-0">
                Kelola informasi produk dan persediaan Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-primary text-primary fs-3 px-3 py-2">
                <iconify-icon icon="solar:box-bold-duotone" class="me-1"></iconify-icon>
                Manajemen Produk
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
                            <p class="text-muted mb-1">Total Produk</p>
                            <!-- <h4 class="fw-semibold mb-0">125</h4> -->
                            <h4 class="fw-semibold mb-0">
                                <?= $totalProduk; ?>
                            </h4>
                            <small class="text-muted">Produk terdaftar</small>
                        </div>
                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:box-bold-duotone"
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
                            <p class="text-muted mb-1">Kategori Produk</p>
                            <!-- <h4 class="fw-semibold mb-0">8</h4> -->
                            <h4 class="fw-semibold mb-0">
                                <?= $totalKategori; ?>
                            </h4>
                            <small class="text-muted">Kategori tersedia</small>
                        </div>
                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:widget-bold-duotone"
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
                            <p class="text-muted mb-1">Produk Varian Tersedia</p>
                            <!-- <h4 class="fw-semibold mb-0">112</h4> -->
                            <h4 class="fw-semibold mb-0">
                                <?= $totalVarian; ?>
                            </h4>
                            <small class="text-muted">Stok mencukupi</small>
                        </div>
                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:check-circle-bold-duotone"
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
                            <p class="text-muted mb-1">Stok Menipis</p>
                            <!-- <h4 class="fw-semibold mb-0">13</h4> -->
                            <h4 class="fw-semibold mb-0">
                                <?= $totalStokMenipis; ?>
                            </h4>
                            <small class="text-muted">Perlu diperhatikan</small>
                        </div>
                        <div class="bg-light-danger rounded-3 p-3">
                            <iconify-icon icon="solar:danger-triangle-bold-duotone"
                                class="fs-8 text-danger"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTER PRODUK ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-3">
                        Filter Produk
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari Produk</label>
                            <input type="text" class="form-control"
                                id="searchProduk"
                                placeholder="Nama produk atau SKU...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="filterKategori">
                                <option value="">Semua Kategori</option>
                                <option value="Kaos">Kaos</option>
                                <option value="Kemeja">Kemeja</option>
                                <option value="Celana">Celana</option>
                                <option value="Jaket">Jaket</option>
                                <option value="Hoodie">Hoodie</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status Stok</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Menipis">Menipis</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-primary w-100"
                                onclick="resetFilterProduk()">
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

    <!-- ================= TABEL PRODUK ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Daftar Produk
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Informasi produk dan jumlah persediaan
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0 d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="cetakProduk()">
                                <iconify-icon icon="solar:printer-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Cetak
                            </button>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableProduk">


                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Varian & Total Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1; ?>

                                <?php foreach ($produk as $p): ?>

                                    <?php
                                    $totalStok = 0;
                                    $totalMinimum = 0;
                                    $stokUkuran = [];

                                    foreach ($p['rincian_varian'] as $v) {

                                        $ukuran = $v['ukuran'];

                                        if (!isset($stokUkuran[$ukuran])) {
                                            $stokUkuran[$ukuran] = 0;
                                        }

                                        $stokUkuran[$ukuran] += (int) $v['stok'];

                                        $totalStok += (int) $v['stok'];
                                        $totalMinimum += (int) $v['stok_minimum'];
                                    }

                                    if ($totalStok == 0) {
                                        $status = 'Habis';
                                        $warnaStatus = 'danger';
                                    } elseif ($totalStok <= $totalMinimum) {
                                        $status = 'Menipis';
                                        $warnaStatus = 'warning';
                                    } else {
                                        $status = 'Tersedia';
                                        $warnaStatus = 'success';
                                    }
                                    ?>

                                    <tr
                                        data-kategori="<?= esc($p['nama_kategori'] ?? '-'); ?>"
                                        data-status="<?= $status; ?>">

                                        <!-- NOMOR -->
                                        <td><?= $no++; ?></td>

                                        <!-- FOTO -->
                                        <td>
                                            <?php if (
                                                !empty($p['foto']) &&
                                                file_exists(FCPATH . 'uploads/produk/' . $p['foto'])
                                            ): ?>

                                                <img
                                                    src="<?= base_url('uploads/produk/' . $p['foto']); ?>"
                                                    width="55"
                                                    height="55"
                                                    class="rounded-3"
                                                    style="object-fit: cover;">

                                            <?php else: ?>

                                                <img
                                                    src="<?= base_url('assets/images/products/default.png'); ?>"
                                                    width="55"
                                                    height="55"
                                                    class="rounded-3"
                                                    style="object-fit: cover;">

                                            <?php endif; ?>
                                        </td>

                                        <!-- NAMA PRODUK -->
                                        <td>
                                            <h6 class="mb-0 fw-semibold">
                                                <?= esc($p['nama_produk']); ?>
                                            </h6>

                                            <small class="text-muted">
                                                <?= esc($p['daftar_warna']); ?>
                                            </small>
                                        </td>

                                        <!-- KATEGORI -->
                                        <td>
                                            <span class="badge bg-light-primary text-primary">
                                                <?= esc($p['nama_kategori'] ?? '-'); ?>
                                            </span>
                                        </td>

                                        <!-- VARIAN DAN TOTAL STOK -->
                                        <td>
                                            <div class="d-flex flex-wrap gap-1 mb-2">

                                                <?php foreach ($stokUkuran as $ukuran => $stok): ?>

                                                    <?php
                                                    $warnaVarian = $stok > 0 ? 'primary' : 'danger';
                                                    ?>

                                                    <span class="badge bg-light-<?= $warnaVarian; ?> text-<?= $warnaVarian; ?>">
                                                        <?= esc($ukuran); ?> (<?= $stok; ?>)
                                                    </span>

                                                <?php endforeach; ?>

                                            </div>

                                            <span class="fw-semibold text-dark">
                                                — <?= $totalStok; ?> pcs
                                            </span>
                                        </td>

                                        <!-- STATUS -->
                                        <td>
                                            <span class="badge bg-light-<?= $warnaStatus; ?> text-<?= $warnaStatus; ?>">
                                                <?= $status; ?>
                                            </span>
                                        </td>

                                        <!-- AKSI -->
                                        <td>
                                            <button
                                                class="btn btn-sm btn-light-primary"
                                                type="button"
                                                onclick="lihatDetailProduk(this)"

                                                data-nama="<?= esc($p['nama_produk']); ?>"
                                                data-kategori="<?= esc($p['nama_kategori'] ?? '-'); ?>"
                                                data-warna="<?= esc($p['daftar_warna']); ?>"
                                                data-total-stok="<?= $totalStok; ?>"
                                                data-total-varian="<?= count($p['rincian_varian']); ?>"
                                                data-status="<?= $status; ?>"
                                                data-foto="<?= esc($p['foto'] ?? ''); ?>"

                                                data-varian="<?= esc(json_encode($p['rincian_varian'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), 'attr'); ?>">

                                                <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>

                                            </button>
                                        </td>


                                    </tr>

                                <?php endforeach; ?>

                            </tbody>


                        </table>

                        <div id="dataKosongProduk" class="text-center py-5 d-none">
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
                            Menampilkan data produk
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
            Alza Store &copy; <?= date('Y'); ?> - Data Produk
        </p>
    </div>

</div>

<!-- ================= MODAL DETAIL PRODUK ================= -->

<!-- ================= MODAL DETAIL PRODUK ================= -->
<div class="modal fade" id="modalDetailProduk" tabindex="-1"
    aria-labelledby="modalDetailProdukLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="modalDetailProdukLabel">
                    Detail Produk
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body">

                <!-- IDENTITAS PRODUK -->
                <div class="row align-items-center mb-4">

                    <div class="col-md-3 text-center mb-3 mb-md-0">

                        <div class="bg-light-primary rounded-4 p-2 d-inline-block">

                            <img
                                src="<?= base_url('assets/images/products/default.png'); ?>"
                                id="detailFotoProduk"
                                class="rounded-3"
                                style="width: 130px; height: 130px; object-fit: cover;"
                                alt="Foto Produk">

                        </div>

                    </div>

                    <div class="col-md-9">

                        <h4 class="fw-semibold mb-2" id="detailNamaProduk">
                            Nama Produk
                        </h4>

                        <div class="d-flex flex-wrap gap-2 mb-2">

                            <span class="badge bg-light-primary text-primary">
                                <iconify-icon icon="solar:widget-bold-duotone"
                                    class="me-1"></iconify-icon>
                                <span id="detailKategori">-</span>
                            </span>

                        </div>

                        <p class="text-muted mb-0">
                            <iconify-icon icon="solar:palette-bold-duotone"
                                class="me-1"></iconify-icon>
                            Warna:
                            <span id="detailWarna">-</span>
                        </p>

                    </div>

                </div>

                <hr>

                <!-- RINGKASAN PERSEDIAAN -->
                <div class="mb-3">
                    <h6 class="fw-semibold mb-3">
                        <iconify-icon icon="solar:chart-square-bold-duotone"
                            class="text-primary me-1"></iconify-icon>
                        Ringkasan Persediaan
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-2">
                                    Total Varian
                                </small>

                                <h4 class="fw-semibold mb-0"
                                    id="detailTotalVarian">
                                    0
                                </h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-2">
                                    Total Stok
                                </small>

                                <h4 class="fw-semibold mb-0 text-primary"
                                    id="detailTotalStok">
                                    0 pcs
                                </h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-2">
                                    Status Persediaan
                                </small>

                                <div class="mt-1" id="detailStatus">
                                    -
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- DAFTAR VARIAN -->
                <div class="mt-4">

                    <div class="d-md-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h6 class="fw-semibold mb-1">
                                <iconify-icon icon="solar:list-bold-duotone"
                                    class="text-primary me-1"></iconify-icon>
                                Daftar SKU dan Varian
                            </h6>

                            <p class="text-muted small mb-0">
                                Informasi harga dan persediaan setiap varian produk.
                            </p>
                        </div>

                    </div>

                    <div class="table-responsive rounded-3">

                        <table class="table table-hover align-middle text-nowrap mb-0">

                            <thead class="">
                                <tr>
                                    <th class="ps-3">No</th>
                                    <th>SKU</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th class="pe-3">Stok Minimum</th>
                                </tr>
                            </thead>

                            <tbody id="detailDaftarVarian">
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    <iconify-icon icon="solar:close-circle-bold-duotone"
                        class="me-1"></iconify-icon>

                    Tutup
                </button>

            </div>

        </div>
    </div>
</div>


<!-- ================= MODAL TAMBAH PRODUK (UI SAJA) ================= -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1"
    aria-labelledby="modalTambahProdukLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="modalTambahProdukLabel">
                    Tambah Produk
                </h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formTambahProduk">

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control"
                            placeholder="Masukkan nama produk" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control"
                            placeholder="Masukkan SKU produk" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <!-- <select class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option>Kaos</option>
                            <option>Kemeja</option>
                            <option>Celana</option>
                            <option>Jaket</option>
                            <option>Hoodie</option>
                        </select> -->
                        <select class="form-select" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>

                            <?php foreach ($kategori as $kat): ?>
                                <option value="<?= $kat['id_kategori']; ?>">
                                    <?= esc($kat['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Warna</label>
                            <input type="text" class="form-control"
                                placeholder="Warna">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Ukuran</label>
                            <input type="text" class="form-control"
                                placeholder="Ukuran">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" class="form-control"
                            placeholder="Masukkan harga">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" class="form-control"
                                placeholder="Jumlah stok">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Stok Minimum</label>
                            <input type="number" class="form-control"
                                placeholder="Stok minimum">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary"
                    onclick="alert('Form ini masih berupa tampilan. Database belum dihubungkan.')">
                    Simpan Produk
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    // ================= FILTER DAN SEARCH =================
    const searchProduk = document.getElementById('searchProduk');
    const filterKategori = document.getElementById('filterKategori');
    const filterStatus = document.getElementById('filterStatus');
    const tabelProduk = document.getElementById('tableProduk');
    const dataKosongProduk = document.getElementById('dataKosongProduk');

    function filterProduk() {

        const keyword = searchProduk.value.toLowerCase();
        const kategori = filterKategori.value;
        const status = filterStatus.value;

        const rows = tabelProduk.querySelectorAll('tbody tr');

        let jumlahTampil = 0;

        rows.forEach(row => {

            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);
            const cocokKategori = !kategori || row.dataset.kategori === kategori;
            const cocokStatus = !status || row.dataset.status === status;

            const tampil = cocokKeyword && cocokKategori && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;

        });

        dataKosongProduk.classList.toggle('d-none', jumlahTampil > 0);
    }

    searchProduk.addEventListener('input', filterProduk);
    filterKategori.addEventListener('change', filterProduk);
    filterStatus.addEventListener('change', filterProduk);

    function resetFilterProduk() {

        searchProduk.value = '';
        filterKategori.value = '';
        filterStatus.value = '';

        filterProduk();
    }

    // ================= DETAIL PRODUK =================
    function lihatDetailProduk(button) {

        const data = button.dataset;

        // Informasi utama
        document.getElementById('detailNamaProduk').innerText = data.nama;
        document.getElementById('detailKategori').innerText = data.kategori;
        document.getElementById('detailWarna').innerText = data.warna;

        // Foto produk
        const fotoProduk = document.getElementById('detailFotoProduk');

        fotoProduk.src = data.foto ?
            '<?= base_url("uploads/produk/"); ?>' + encodeURIComponent(data.foto) :
            '<?= base_url("assets/images/products/default.png"); ?>';

        fotoProduk.onerror = function() {
            this.src = '<?= base_url("assets/images/products/default.png"); ?>';
        };

        // Ringkasan
        document.getElementById('detailTotalVarian').innerText =
            data.totalVarian;

        document.getElementById('detailTotalStok').innerText =
            data.totalStok + ' pcs';

        // Status
        let warnaStatus = 'success';

        if (data.status === 'Menipis') {
            warnaStatus = 'warning';
        } else if (data.status === 'Habis') {
            warnaStatus = 'danger';
        }

        document.getElementById('detailStatus').innerHTML = `
        <span class="badge bg-light-${warnaStatus} text-${warnaStatus}">
            ${data.status}
        </span>
    `;

        // Daftar seluruh varian
        const varian = JSON.parse(data.varian);

        const tbody = document.getElementById('detailDaftarVarian');

        tbody.innerHTML = '';

        varian.forEach((v, index) => {

            const stok = Number(v.stok);
            const minimum = Number(v.stok_minimum);

            let statusVarian = 'Tersedia';
            let warnaVarian = 'success';

            if (stok === 0) {
                statusVarian = 'Habis';
                warnaVarian = 'danger';
            } else if (stok <= minimum) {
                statusVarian = 'Menipis';
                warnaVarian = 'warning';
            }

            const row = document.createElement('tr');

            const values = [
                index + 1,
                v.kode_sku || v.sku || '-',
                v.warna || '-',
                v.ukuran || '-',
                'Rp' + Number(v.harga_jual).toLocaleString('id-ID'),
                stok + ' pcs',
                minimum + ' pcs'
            ];

            values.forEach(value => {
                const td = document.createElement('td');
                td.textContent = value;
                row.appendChild(td);
            });

            tbody.appendChild(row);

        });

        // Tampilkan modal
        const modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalDetailProduk')
        );

        modal.show();
    }

    // ================= CETAK PRODUK =================
    function cetakProduk() {

        const rows = tabelProduk.querySelectorAll('tbody tr');
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
            <title>Laporan Data Produk</title>
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

            <h2>DATA PRODUK ALZA STORE</h2>

            <p>Dicetak: ${new Date().toLocaleString('id-ID')}</p>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
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