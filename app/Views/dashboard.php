<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var int $total_stok */
/** @var int $masuk_hari_ini */
/** @var int $keluar_hari_ini */
/** @var int $jumlah_kritis */
/** @var array $top5_kritis */
/** @var string $label_grafik */
/** @var string $data_masuk_7 */
/** @var string $data_keluar_7 */
/** @var array $log_aktivitas */
?>

<?= $this->section('content'); ?>
<div class="container-fluid" style="padding-top: 85px;">

    <!-- HEADER: Judul & Keterangan Dashboard Admin -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h4 class="fw-semibold text-dark mb-1">Dashboard Admin</h4>
            <p class="text-muted small mb-0">
                kucing persediaan barang, pintasan input transaksi harian, dan pantauan stok ALZA.STORE.
            </p>
        </div>
        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-3 fw-medium">
            <i class="ti ti-calendar me-1"></i> <?= date('d M Y'); ?>
        </span>
    </div>

    <!-- BARIS 1: 4 Kartu Ringkasan (Summary Cards) -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-primary h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Total Stok Siap Jual</span>
                        <h3 class="fw-bold text-primary mb-0 mt-1">
                            <?= number_format($total_stok, 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">pcs</small>
                        </h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-box fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-success h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Barang Masuk Hari Ini</span>
                        <h3 class="fw-bold text-success mb-0 mt-1">
                            <?= $masuk_hari_ini > 0 ? '+' : ''; ?><?= number_format($masuk_hari_ini, 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">pcs</small>
                        </h3>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-arrow-down-left fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-info h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Barang Keluar Hari Ini</span>
                        <h3 class="fw-bold text-info mb-0 mt-1">
                            <?= $keluar_hari_ini > 0 ? '-' : ''; ?><?= number_format($keluar_hari_ini, 0, ',', '.'); ?>
                            <small class="fs-4 fw-normal text-muted">pcs</small>
                        </h3>
                    </div>
                    <div class="bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="ti ti-arrow-up-right fs-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card border-start border-4 border-danger h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-medium d-block">Stok Menipis & Habis</span>
                        <h3 class="fw-bold text-danger mb-0 mt-1">
                            <?= number_format($jumlah_kritis, 0, ',', '.'); ?>
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

    <!-- BARIS 2: Bilah Pintasan Cepat (Quick Actions) -->
    <div class="card mb-4">
        <div class="card-body py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                <i class="ti ti-bolt text-primary fs-5"></i>
                <span class="fw-semibold text-dark">Pintasan Input Harian</span>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="/Admin/BarangMasuk" class="btn btn-success btn-sm fw-semibold">
                    <i class="ti ti-plus me-1"></i> Catat Barang Masuk
                </a>
                <a href="/Admin/BarangKeluar" class="btn btn-primary btn-sm fw-semibold">
                    <i class="ti ti-plus me-1"></i> Catat Barang Keluar
                </a>
                <a href="/Admin/BarangRetur" class="btn btn-warning text-dark btn-sm fw-semibold">
                    <i class="ti ti-refresh me-1"></i> Catat Retur Barang
                </a>
            </div>
        </div>
    </div>

    <!-- BARIS 3: Grafik Harian (7 Hari Terakhir) & Tabel Top 5 Stok Kritis -->
    <div class="row g-3 mb-4">
        <!-- Grafik Batang -->
        <div class="col-lg-7">
            <div class="card h-100 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title fw-semibold mb-0">Volume Masuk vs. Keluar</h5>
                        <span class="text-muted small">7 hari terakhir</span>
                    </div>
                    <div style="height: 280px;">
                        <canvas id="grafikMutasi7Hari"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 5 Stok Kritis -->
        <div class="col-lg-5">
            <div class="card h-100 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title fw-semibold mb-0">Top 5 Stok Kritis</h5>
                        <a href="/Admin/StokPersediaan" class="small text-primary fw-medium">Lihat Semua &rarr;</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr class="border-bottom">
                                    <th class="ps-0">Produk & Ukuran</th>
                                    <th class="text-center text-nowrap">Sisa</th>
                                    <th class="text-end pe-0 text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top5_kritis as $tk) :
                                    $sisa = (int) $tk['sisa_stok'];
                                    $badgeClass = ($sisa <= 0)
                                        ? 'bg-danger'
                                        : (($sisa <= (int) $tk['stok_minimum']) ? 'bg-warning text-dark' : 'bg-success');
                                ?>
                                <tr>
                                    <td class="ps-0 py-2">
                                        <span class="fw-semibold text-dark d-block"><?= esc($tk['nama_produk']); ?></span>
                                        <small class="text-muted">Ukuran <?= esc($tk['ukuran']); ?> • <?= esc($tk['kode_sku']); ?></small>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <span class="badge <?= $badgeClass; ?> rounded-3"><?= $sisa; ?> pcs</span>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <a href="/Admin/BarangMasuk" class="btn btn-sm btn-outline-success py-0 px-2" style="font-size: 12px;">
                                            + Masuk
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($top5_kritis)) : ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data SKU.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 4: Log Aktivitas Terbaru -->
    <div class="card mb-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold mb-0">Log Aktivitas Pergerakan Stok Terbaru</h5>
                <span class="text-muted small">7 mutasi terakhir</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0 w-100">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th class="px-2 text-nowrap">Waktu</th>
                            <th class="px-2">Produk & Ukuran</th>
                            <th class="px-2 text-nowrap">Jenis Mutasi</th>
                            <th class="px-2">Keterangan Transaksi</th>
                            <th class="px-2 text-center text-nowrap">Perubahan</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($log_aktivitas as $log) :
                            $qty = (int) $log['jumlah'];
                            $isRetur = !empty($log['id_retur']);
                        ?>
                        <tr>
                            <td class="px-2 text-muted small text-nowrap">
                                <?= date('d/m/Y H:i', strtotime($log['tanggal_pergerakan'])); ?>
                            </td>
                            <td class="px-2">
                                <span class="fw-semibold text-dark d-block"><?= esc($log['nama_produk']); ?></span>
                                <small class="text-muted">Ukuran <?= esc($log['ukuran']); ?> • <?= esc($log['kode_sku']); ?></small>
                            </td>
                            <td class="px-2 text-nowrap">
                                <?php if ($isRetur) : ?>
                                    <span class="badge bg-info rounded-3 fw-semibold">Retur Masuk</span>
                                <?php elseif ($qty > 0) : ?>
                                    <span class="badge bg-success rounded-3 fw-semibold">Barang Masuk</span>
                                <?php else : ?>
                                    <span class="badge bg-danger rounded-3 fw-semibold">Barang Keluar</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2"><?= esc($log['keterangan']); ?></td>
                            <td class="px-2 text-center text-nowrap">
                                <?php if ($qty > 0) : ?>
                                    <span class="fw-bold text-success">+<?= $qty; ?> pcs</span>
                                <?php else : ?>
                                    <span class="fw-bold text-danger"><?= $qty; ?> pcs</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if (empty($log_aktivitas)) : ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada aktivitas pergerakan stok.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<!-- Chart.js CDN untuk Grafik Batang 7 Hari Terakhir -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikMutasi7Hari').getContext('2d');
    new window.Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $label_grafik; ?>,
            datasets: [
                {
                    label: 'Barang Masuk (pcs)',
                    data: <?= $data_masuk_7; ?>,
                    backgroundColor: 'rgba(19, 222, 185, 0.85)',
                    borderRadius: 6,
                    maxBarThickness: 32
                },
                {
                    label: 'Barang Keluar (pcs)',
                    data: <?= $data_keluar_7; ?>,
                    backgroundColor: 'rgba(250, 137, 107, 0.85)',
                    borderRadius: 6,
                    maxBarThickness: 32
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                }
            }
        }
    });
</script>
<?= $this->endSection(); ?>