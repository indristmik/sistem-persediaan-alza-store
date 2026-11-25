<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var array $ringkasan */
/** @var array $stok_persediaan */
/** @var array $kategori */
/** @var string|null $filter_kategori */
/** @var string|null $filter_ukuran */
/** @var string|null $filter_status */
?>

<?= $this->section('content'); ?>
<div class="container-fluid" style="padding-top: 85px;">

    <!-- A. KARTU RINGKASAN ATAS (SUMMARY CARDS) -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-primary h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Total Item / SKU</span>
                        <h3 class="fw-bold text-primary mb-0 mt-1">
                            <?= number_format($ringkasan['total_sku'], 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">SKU</small>
                        </h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-barcode fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-success h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Total Fisik Persediaan</span>
                        <h3 class="fw-bold text-success mb-0 mt-1">
                            <?= number_format($ringkasan['total_fisik'], 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">pcs</small>
                        </h3>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-packages fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-warning h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Item Stok Menipis</span>
                        <h3 class="fw-bold text-warning mb-0 mt-1">
                            <?= number_format($ringkasan['stok_menipis'], 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">SKU</small>
                        </h3>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-alert-circle fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-danger h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Item Stok Habis</span>
                        <h3 class="fw-bold text-danger mb-0 mt-1">
                            <?= number_format($ringkasan['stok_habis'], 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">SKU</small>
                        </h3>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-alert-triangle fs-6"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- B & C. FILTER CEPAT & TABEL RINCIAN STOK -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">Monitoring Stok Persediaan</h5>
                            <p class="text-muted small mb-0">Pantau sisa stok aktual setiap SKU, batas minimum, dan akses cepat ke Kartu Stok.</p>
                        </div>
                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-3 fw-medium">
                            Real-time (Read-Only)
                        </span>
                    </div>

                    <!-- Baris Filter Cepat -->
                    <form action="/Admin/StokPersediaan" method="get" class="row g-2 align-items-end mb-4 bg-light p-3 rounded-3 border">
                        <div class="col-md-4">
                            <label class="form-label small fw-medium mb-1">Kategori</label>
                            <select name="kategori" class="form-select form-select-sm">
                                <option value="">Semua Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id_kategori']; ?>" <?= ($filter_kategori == $k['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= esc($k['nama_kategori']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-medium mb-1">Ukuran</label>
                            <select name="ukuran" class="form-select form-select-sm">
                                <option value="">Semua Ukuran</option>
                                <?php foreach (['S', 'M', 'L', 'XL', 'XXL'] as $uk) : ?>
                                    <option value="<?= $uk; ?>" <?= ($filter_ukuran === $uk) ? 'selected' : ''; ?>><?= $uk; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium mb-1">Status Stok</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="">Semua Status</option>
                                <option value="Aman" <?= ($filter_status === 'Aman') ? 'selected' : ''; ?>>Stok Aman</option>
                                <option value="Menipis" <?= ($filter_status === 'Menipis') ? 'selected' : ''; ?>>Stok Menipis</option>
                                <option value="Habis" <?= ($filter_status === 'Habis') ? 'selected' : ''; ?>>Stok Habis</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-primary flex-grow-1">Terapkan Filter</button>
                            <a href="/Admin/StokPersediaan" class="btn btn-sm btn-outline-secondary">Reset</a>
                        </div>
                    </form>

                    <!-- Tabel Rincian Stok -->
                    <div class="table-responsive">
                        <table id="tabelStokPersediaan" class="table align-middle mb-0 w-100">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col" class="px-2 text-nowrap">Kode SKU</th>
                                    <th scope="col" class="px-2 text-nowrap">Kategori</th>
                                    <th scope="col" class="px-2">Nama Produk &amp; Warna</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Ukuran</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Batas Min.</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Sisa Stok</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Status</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($stok_persediaan as $s) : ?>
                                <tr>
                                    <td class="px-2 text-nowrap">
                                        <span class="badge bg-secondary-subtle text-dark fw-semibold">
                                            <?= esc($s['kode_sku']); ?>
                                        </span>
                                    </td>
                                    <td class="px-2 text-nowrap"><?= esc($s['nama_kategori']); ?></td>
                                    <td class="px-2">
                                        <span class="text-dark fw-semibold d-block">
                                            <?= esc($s['nama_produk']); ?>
                                            <?= $s['warna'] ? ' — ' . esc($s['warna']) : ''; ?>
                                        </span>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1">
                                            <?= esc($s['ukuran']); ?>
                                        </span>
                                    </td>
                                    <td class="px-2 text-center text-muted text-nowrap" data-order="<?= (int) $s['stok_minimum']; ?>">
                                        <?= (int) $s['stok_minimum']; ?> pcs
                                    </td>
                                    <td class="px-2 text-center text-nowrap" data-order="<?= (int) $s['sisa_stok']; ?>">
                                        <span class="fw-bold fs-4 <?= ($s['sisa_stok'] <= 0) ? 'text-danger' : 'text-dark'; ?>">
                                            <?= number_format((int) $s['sisa_stok'], 0, ',', '.'); ?> pcs
                                        </span>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <?php if ($s['status_stok'] === 'Habis') : ?>
                                            <span class="badge bg-danger rounded-3 fw-semibold">Stok Habis</span>
                                        <?php elseif ($s['status_stok'] === 'Menipis') : ?>
                                            <span class="badge bg-warning text-dark rounded-3 fw-semibold">Stok Menipis</span>
                                        <?php else : ?>
                                            <span class="badge bg-success rounded-3 fw-semibold">Stok Aman</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="/Admin/PergerakanStok?id_varian=<?= $s['id_varian']; ?>" class="btn btn-sm btn-outline-info">
                                                Kartu Stok
                                            </a>
                                            <?php if ($s['status_stok'] === 'Menipis' || $s['status_stok'] === 'Habis') : ?>
                                                <a href="/Admin/BarangMasuk?id_varian=<?= $s['id_varian']; ?>" class="btn btn-sm btn-primary">
                                                    + Masuk
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#tabelStokPersediaan').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[5, 'asc']], // Default urutkan dari sisa stok paling sedikit
            columnDefs: [
                { orderable: false, searchable: false, targets: [7] } // Matikan sorting & search di kolom Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Data stok persediaan tidak ditemukan",
                zeroRecords: "Data stok persediaan tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari total _MAX_ data)",
                search: "Cari:",
                searchPlaceholder: "SKU, produk, warna...",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>