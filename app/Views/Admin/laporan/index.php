<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var string $jenis */
/** @var array $laporan */
/** @var string|null $error_tanggal */
/** @var string $tgl_mulai */
/** @var string $tgl_selesai */
/** @var string|int|null $id_penjahit */
/** @var string|int|null $id_saluran */
/** @var string|null $tindak_lanjut */
/** @var string|int|null $id_kategori */
/** @var string|null $status_stok */
/** @var array $penjahit */
/** @var array $saluran */
/** @var array $kategori */
?>
<?= $this->section('content'); ?>

<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 12mm;
    }
    .left-sidebar, .app-header, .d-print-none {
        display: none !important;
    }
    .body-wrapper, .page-wrapper {
        margin-left: 0 !important;
        padding-top: 0 !important;
    }
    .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
    }
    .card, .card-body {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
    table {
        width: 100% !important;
        font-size: 11px !important;
        border-collapse: collapse !important;
    }
    table th, table td {
        padding: 4px 6px !important;
        border: 1px solid #333 !important;
        white-space: normal !important;
    }
    .badge {
        background: transparent !important;
        color: #000 !important;
        padding: 0 !important;
        font-weight: 600 !important;
    }
}
</style>

<?php
// Judul dinamis untuk kop cetak
$judulCetak = [
    'masuk'  => 'Laporan Barang Masuk & Upah Maklun Penjahit',
    'keluar' => 'Laporan Barang Keluar',
    'retur'  => 'Laporan Retur Barang',
    'stok'   => 'Laporan Stok Akhir Persediaan',
];

// Label filter aktif untuk ditampilkan di kop cetak
$infoFilter = 'Semua Data';
if ($jenis === 'masuk' && !empty($id_penjahit)) {
    foreach ($penjahit as $p) {
        if ($p['id_penjahit'] == $id_penjahit) $infoFilter = 'Mitra Penjahit: ' . $p['nama_penjahit'];
    }
} elseif ($jenis === 'keluar' && !empty($id_saluran)) {
    foreach ($saluran as $s) {
        if ($s['id_saluran'] == $id_saluran) $infoFilter = 'Saluran Penjualan: ' . $s['nama_saluran'];
    }
} elseif ($jenis === 'retur' && !empty($tindak_lanjut)) {
    $infoFilter = 'Tindak Lanjut: ' . $tindak_lanjut;
} elseif ($jenis === 'stok') {
    $bagian = [];
    if (!empty($id_kategori)) {
        foreach ($kategori as $k) {
            if ($k['id_kategori'] == $id_kategori) $bagian[] = 'Kategori: ' . $k['nama_kategori'];
        }
    }
    if (!empty($status_stok)) {
        $bagian[] = 'Status Stok: ' . $status_stok;
    }
    if (!empty($bagian)) $infoFilter = implode(' | ', $bagian);
}
?>

<div class="container-fluid" style="padding-top: 85px;">

    <!-- Alert Validasi Rentang Tanggal Terbalik -->
    <?php if (!empty($error_tanggal)) : ?>
        <div class="alert alert-danger alert-dismissible fade show d-print-none" role="alert">
            <?= esc($error_tanggal); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-0">
        <div class="card-body">

            <!-- Kop Laporan (Hanya Muncul Saat Dicetak / PDF) -->
            <div class="d-none d-print-block text-center border-bottom border-dark pb-3 mb-3">
                <h4 class="fw-bold mb-1">TOKO ALZA.STORE</h4>
                <p class="fw-semibold mb-1"><?= $judulCetak[$jenis] ?? 'Laporan Periodik'; ?></p>
                <?php if ($jenis === 'stok') : ?>
                    <small class="d-block">Tanggal Cetak: <?= date('d/m/Y H:i'); ?> WIB</small>
                <?php else : ?>
                    <small class="d-block">Periode: <?= date('d/m/Y', strtotime($tgl_mulai)); ?> s/d <?= date('d/m/Y', strtotime($tgl_selesai)); ?></small>
                <?php endif; ?>
                <small class="d-block text-muted">Filter Aktif: <?= esc($infoFilter); ?></small>
            </div>

            <!-- Header & Tombol Cetak -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 d-print-none">
                <div>
                    <h5 class="card-title fw-semibold mb-1">Laporan Periodik</h5>
                    <p class="text-muted small mb-0">Rekapitulasi transaksi masuk, keluar, retur, dan stok akhir persediaan ALZA.STORE.</p>
                </div>
                <button onclick="window.print()" class="btn btn-success btn-sm fw-semibold" <?= !empty($error_tanggal) ? 'disabled' : ''; ?>>
                    <i class="ti ti-printer me-1"></i> Cetak / Simpan PDF
                </button>
            </div>

            <!-- Navigasi Tab 4 Laporan -->
            <ul class="nav nav-pills flex-wrap gap-1 mb-4 d-print-none">
                <li class="nav-item">
                    <a class="nav-link <?= ($jenis === 'masuk') ? 'active' : ''; ?>" href="/Admin/Laporan?jenis=masuk">
                        Barang Masuk &amp; Maklun
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($jenis === 'keluar') ? 'active' : ''; ?>" href="/Admin/Laporan?jenis=keluar">
                        Barang Keluar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($jenis === 'retur') ? 'active' : ''; ?>" href="/Admin/Laporan?jenis=retur">
                        Retur Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($jenis === 'stok') ? 'active' : ''; ?>" href="/Admin/Laporan?jenis=stok">
                        Stok Akhir Persediaan
                    </a>
                </li>
            </ul>

            <!-- Form Filter Dinamis Sesuai Tab -->
            <form action="/Admin/Laporan" method="get" class="row g-2 align-items-end mb-4 bg-light p-3 rounded-3 border d-print-none">
                <input type="hidden" name="jenis" value="<?= esc($jenis); ?>">

                <?php if ($jenis !== 'stok') : ?>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium mb-1">Dari Tanggal</label>
                        <input type="date" name="tgl_mulai" class="form-control form-control-sm" value="<?= esc($tgl_mulai); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium mb-1">Sampai Tanggal</label>
                        <input type="date" name="tgl_selesai" class="form-control form-control-sm" value="<?= esc($tgl_selesai); ?>">
                    </div>
                <?php endif; ?>

                <?php if ($jenis === 'masuk') : ?>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium mb-1">Mitra Penjahit</label>
                        <select name="id_penjahit" class="form-select form-select-sm">
                            <option value="">Semua Penjahit</option>
                            <?php foreach ($penjahit as $p) : ?>
                                <option value="<?= $p['id_penjahit']; ?>" <?= ($id_penjahit == $p['id_penjahit']) ? 'selected' : ''; ?>>
                                    <?= esc($p['nama_penjahit']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php elseif ($jenis === 'keluar') : ?>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium mb-1">Saluran Penjualan</label>
                        <select name="id_saluran" class="form-select form-select-sm">
                            <option value="">Semua Saluran</option>
                            <?php foreach ($saluran as $s) : ?>
                                <option value="<?= $s['id_saluran']; ?>" <?= ($id_saluran == $s['id_saluran']) ? 'selected' : ''; ?>>
                                    <?= esc($s['nama_saluran']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php elseif ($jenis === 'retur') : ?>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium mb-1">Tindak Lanjut</label>
                        <select name="tindak_lanjut" class="form-select form-select-sm">
                            <option value="">Semua Tindak Lanjut</option>
                            <option value="Layak Jual Kembali" <?= ($tindak_lanjut === 'Layak Jual Kembali') ? 'selected' : ''; ?>>Layak Jual Kembali</option>
                            <option value="Perbaikan Penjahit" <?= ($tindak_lanjut === 'Perbaikan Penjahit') ? 'selected' : ''; ?>>Perbaikan Penjahit</option>
                            <option value="Rusak / Afkir" <?= ($tindak_lanjut === 'Rusak / Afkir') ? 'selected' : ''; ?>>Rusak / Afkir</option>
                        </select>
                    </div>
                <?php elseif ($jenis === 'stok') : ?>
                    <div class="col-md-4">
                        <label class="form-label small fw-medium mb-1">Kategori Produk</label>
                        <select name="id_kategori" class="form-select form-select-sm">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>" <?= ($id_kategori == $k['id_kategori']) ? 'selected' : ''; ?>>
                                    <?= esc($k['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-medium mb-1">Status Stok</label>
                        <select name="status_stok" class="form-select form-select-sm">
                            <option value="">Semua Status</option>
                            <option value="Aman" <?= ($status_stok === 'Aman') ? 'selected' : ''; ?>>Aman</option>
                            <option value="Menipis" <?= ($status_stok === 'Menipis') ? 'selected' : ''; ?>>Menipis</option>
                            <option value="Habis" <?= ($status_stok === 'Habis') ? 'selected' : ''; ?>>Habis</option>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="<?= ($jenis === 'stok') ? 'col-md-4' : 'col-md-3'; ?> d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Tampilkan</button>
                    <a href="/Admin/Laporan?jenis=<?= esc($jenis); ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>

            <!-- Tabel Laporan Sesuai Tab Aktif -->
            <div class="table-responsive">

                <?php if ($jenis === 'masuk') : ?>
                    <!-- 1. TABEL BARANG MASUK & MAKLUN -->
                    <table class="table table-bordered align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-2 text-center text-nowrap" width="5%">No</th>
                                <th class="px-2 text-nowrap">Kode Transaksi</th>
                                <th class="px-2 text-nowrap">Tanggal</th>
                                <th class="px-2 text-nowrap">Nama Penjahit</th>
                                <th class="px-2">Produk &amp; Ukuran</th>
                                <th class="px-2 text-center text-nowrap">Jumlah</th>
                                <th class="px-2 text-end text-nowrap">Tarif</th>
                                <th class="px-2 text-end text-nowrap">Total Upah</th>
                                <th class="px-2 text-center text-nowrap">Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; $totalPcs = 0; $totalUpah = 0; ?>
                            <?php foreach ($laporan as $row) : ?>
                                <?php $totalPcs += (int) $row['jumlah']; $totalUpah += (float) $row['total_upah']; ?>
                                <tr>
                                    <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                                    <td class="px-2 text-nowrap fw-medium"><?= esc($row['nomor_referensi']); ?></td>
                                    <td class="px-2 text-nowrap"><?= date('d/m/Y', strtotime($row['tanggal_masuk'])); ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['nama_penjahit'] ?? '-'); ?></td>
                                    <td class="px-2"><?= esc($row['nama_produk']); ?> (<?= esc($row['ukuran']); ?>)</td>
                                    <td class="px-2 text-center text-nowrap"><?= (int) $row['jumlah']; ?> pcs</td>
                                    <td class="px-2 text-end text-nowrap">Rp <?= number_format($row['biaya_produksi'], 0, ',', '.'); ?></td>
                                    <td class="px-2 text-end text-nowrap fw-medium">Rp <?= number_format($row['total_upah'], 0, ',', '.'); ?></td>
                                    <td class="px-2 text-center text-nowrap">
                                        <span class="badge bg-success-subtle text-success fw-semibold"><?= esc($row['status_transaksi']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($laporan)) : ?>
                                <tr><td colspan="9" class="text-center text-muted py-4">Tidak ada data pada periode yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="5" class="px-2 text-end">TOTAL REKAPITULASI</td>
                                <td class="px-2 text-center text-nowrap"><?= number_format($totalPcs, 0, ',', '.'); ?> pcs</td>
                                <td></td>
                                <td class="px-2 text-end text-nowrap">Rp <?= number_format($totalUpah, 0, ',', '.'); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                <?php elseif ($jenis === 'keluar') : ?>
                    <!-- 2. TABEL BARANG KELUAR -->
                    <table class="table table-bordered align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-2 text-center text-nowrap" width="5%">No</th>
                                <th class="px-2 text-nowrap">Kode Transaksi</th>
                                <th class="px-2 text-nowrap">Tanggal</th>
                                <th class="px-2 text-nowrap">Saluran Penjualan</th>
                                <th class="px-2 text-nowrap">No. Resi</th>
                                <th class="px-2">Produk &amp; Ukuran</th>
                                <th class="px-2 text-center text-nowrap">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; $totalKeluar = 0; ?>
                            <?php foreach ($laporan as $row) : ?>
                                <?php $totalKeluar += (int) $row['jumlah']; ?>
                                <tr>
                                    <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                                    <td class="px-2 text-nowrap fw-medium"><?= esc($row['nomor_pesanan']); ?></td>
                                    <td class="px-2 text-nowrap"><?= date('d/m/Y', strtotime($row['tanggal_keluar'])); ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['nama_saluran'] ?? '-'); ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['no_resi'] ?: '-'); ?></td>
                                    <td class="px-2"><?= esc($row['nama_produk']); ?> (<?= esc($row['ukuran']); ?>)</td>
                                    <td class="px-2 text-center text-nowrap"><?= (int) $row['jumlah']; ?> pcs</td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($laporan)) : ?>
                                <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data pada periode yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="6" class="px-2 text-end">TOTAL BARANG KELUAR</td>
                                <td class="px-2 text-center text-nowrap"><?= number_format($totalKeluar, 0, ',', '.'); ?> pcs</td>
                            </tr>
                        </tfoot>
                    </table>

                <?php elseif ($jenis === 'retur') : ?>
                    <!-- 3. TABEL RETUR BARANG -->
                    <table class="table table-bordered align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-2 text-center text-nowrap" width="5%">No</th>
                                <th class="px-2 text-nowrap">Kode Transaksi</th>
                                <th class="px-2 text-nowrap">Tanggal</th>
                                <th class="px-2 text-nowrap">Asal Retur</th>
                                <th class="px-2">Produk &amp; Ukuran</th>
                                <th class="px-2 text-center text-nowrap">Jumlah</th>
                                <th class="px-2">Alasan Retur</th>
                                <th class="px-2 text-nowrap">Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; $totalRetur = 0; $layakJual = 0; $perbaikan = 0; $rusak = 0; ?>
                            <?php foreach ($laporan as $row) : ?>
                                <?php
                                $qty = (int) $row['jumlah_retur'];
                                $totalRetur += $qty;
                                if ($row['tindak_lanjut'] === 'Layak Jual Kembali') {
                                    $layakJual += $qty;
                                } elseif ($row['tindak_lanjut'] === 'Perbaikan Penjahit') {
                                    $perbaikan += $qty;
                                } else {
                                    $rusak += $qty;
                                }
                                ?>
                                <tr>
                                    <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                                    <td class="px-2 text-nowrap fw-medium"><?= esc($row['nomor_retur']); ?></td>
                                    <td class="px-2 text-nowrap"><?= date('d/m/Y', strtotime($row['tanggal_retur'])); ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['nama_saluran'] ?? '-'); ?></td>
                                    <td class="px-2"><?= esc($row['nama_produk']); ?> (<?= esc($row['ukuran']); ?>)</td>
                                    <td class="px-2 text-center text-nowrap"><?= $qty; ?> pcs</td>
                                    <td class="px-2"><?= esc($row['kategori_retur']); ?><?= $row['alasan'] ? ' — ' . esc($row['alasan']) : ''; ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['tindak_lanjut']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($laporan)) : ?>
                                <tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data pada periode yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="5" class="px-2 text-end">TOTAL BARANG RETUR</td>
                                <td class="px-2 text-center text-nowrap"><?= number_format($totalRetur, 0, ',', '.'); ?> pcs</td>
                                <td colspan="2" class="px-2">
                                    Layak Jual: <?= $layakJual; ?> pcs | Perbaikan: <?= $perbaikan; ?> pcs | Rusak: <?= $rusak; ?> pcs
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                <?php elseif ($jenis === 'stok') : ?>
                    <!-- 4. TABEL STOK AKHIR PERSEDIAAN -->
                    <table class="table table-bordered align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-2 text-center text-nowrap" width="5%">No</th>
                                <th class="px-2 text-nowrap">Kode SKU</th>
                                <th class="px-2 text-nowrap">Kategori</th>
                                <th class="px-2">Nama Produk &amp; Warna</th>
                                <th class="px-2 text-center text-nowrap">Ukuran</th>
                                <th class="px-2 text-center text-nowrap">Batas Min.</th>
                                <th class="px-2 text-center text-nowrap">Sisa Stok</th>
                                <th class="px-2 text-center text-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; $totalFisik = 0; ?>
                            <?php foreach ($laporan as $row) : ?>
                                <?php $totalFisik += max(0, (int) $row['sisa_stok']); ?>
                                <tr>
                                    <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                                    <td class="px-2 text-nowrap fw-medium"><?= esc($row['kode_sku']); ?></td>
                                    <td class="px-2 text-nowrap"><?= esc($row['nama_kategori']); ?></td>
                                    <td class="px-2"><?= esc($row['nama_produk']); ?><?= $row['warna'] ? ' — ' . esc($row['warna']) : ''; ?></td>
                                    <td class="px-2 text-center text-nowrap"><?= esc($row['ukuran']); ?></td>
                                    <td class="px-2 text-center text-nowrap"><?= (int) $row['stok_minimum']; ?> pcs</td>
                                    <td class="px-2 text-center text-nowrap fw-bold"><?= number_format((int) $row['sisa_stok'], 0, ',', '.'); ?> pcs</td>
                                    <td class="px-2 text-center text-nowrap">
                                        <?php if ($row['status_stok'] === 'Habis') : ?>
                                            <span class="badge bg-danger-subtle text-danger fw-semibold">Habis</span>
                                        <?php elseif ($row['status_stok'] === 'Menipis') : ?>
                                            <span class="badge bg-warning-subtle text-warning fw-semibold">Menipis</span>
                                        <?php else : ?>
                                            <span class="badge bg-success-subtle text-success fw-semibold">Aman</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($laporan)) : ?>
                                <tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data pada periode yang dipilih.</td></tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="6" class="px-2 text-end">TOTAL KESELURUHAN FISIK PERSEDIAAN (<?= date('d/m/Y'); ?>)</td>
                                <td class="px-2 text-center text-nowrap"><?= number_format($totalFisik, 0, ',', '.'); ?> pcs</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>

            </div>

            <!-- Blok Pengesahan / Tanda Tangan (Hanya Muncul Saat Dicetak / PDF) -->
            <div class="d-none d-print-block mt-5">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6 text-end mb-3">
                        <p class="mb-0">Pekalongan, <?= date('d/m/Y'); ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6">
                        <p class="mb-5 pb-3">Dibuat Oleh,<br><strong>Admin Gudang</strong></p>
                        <p class="mb-0 fw-semibold">( ______________________ )</p>
                    </div>
                    <div class="col-6">
                        <p class="mb-5 pb-3">Mengetahui,<br><strong>Owner ALZA.STORE</strong></p>
                        <p class="mb-0 fw-semibold">( ______________________ )</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>