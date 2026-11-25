<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var array $barang_keluar */
/** @var array $saluran */
/** @var array $varian */
?>

<?= $this->section('content'); ?>
<div class="container-fluid" style="padding-top: 85px;">

    <!-- Notifikasi Sukses -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Notifikasi Error (misal stok tidak cukup) -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">Transaksi Barang Keluar</h5>
                            <p class="text-muted small mb-0">Catat pengeluaran barang dari penjualan online maupun toko offline ALZA.STORE.</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKeluarModal">
                            + Tambah Barang Keluar
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="tabelBarangKeluar" class="table align-middle mb-0 w-100">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col" class="px-2 text-nowrap">Kode Transaksi</th>
                                    <th scope="col" class="px-2 text-nowrap">Tanggal</th>
                                    <th scope="col" class="px-2 text-nowrap">Saluran Penjualan</th>
                                    <th scope="col" class="px-2">Produk &amp; Ukuran</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Jumlah</th>
                                    <th scope="col" class="px-2 text-nowrap">No. Resi</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($barang_keluar as $bk) : ?>
                                <?php
                                    $namaSaluran  = trim($bk['nama_saluran'] ?? '-');
                                    $saluranLower = strtolower($namaSaluran);

                                    // Warna identitas tiap platform
                                    if (str_contains($saluranLower, 'shopee')) {
                                        $badgeClass = 'rounded-pill px-3 py-2 fw-semibold';
                                        $badgeStyle = 'background-color: #ffefe8; color: #ee4d2d;';
                                    } elseif (str_contains($saluranLower, 'tiktok')) {
                                        $badgeClass = 'bg-dark-subtle text-dark rounded-pill px-3 py-2 fw-semibold';
                                        $badgeStyle = '';
                                    } elseif (str_contains($saluranLower, 'lazada')) {
                                        $badgeClass = 'bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold';
                                        $badgeStyle = '';
                                    } elseif (str_contains($saluranLower, 'offline') || str_contains($saluranLower, 'toko')) {
                                        $badgeClass = 'bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold';
                                        $badgeStyle = '';
                                    } else {
                                        $badgeClass = 'bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fw-semibold';
                                        $badgeStyle = '';
                                    }
                                ?>
                                <tr>
                                    <td class="px-2 text-nowrap">
                                        <span class="badge bg-primary-subtle text-primary fw-semibold">
                                            <?= esc($bk['nomor_pesanan']); ?>
                                        </span>
                                    </td>
                                    <td class="px-2 text-nowrap" data-order="<?= esc($bk['tanggal_keluar']); ?>">
                                        <?= date('d/m/Y', strtotime($bk['tanggal_keluar'])); ?>
                                    </td>
                                    <td class="px-2 text-nowrap">
                                        <span class="badge <?= $badgeClass; ?>" <?= $badgeStyle ? 'style="' . $badgeStyle . '"' : ''; ?>><?= esc($namaSaluran); ?></span>
                                    </td>
                                    <td class="px-2">
                                        <span class="text-dark fw-semibold d-block"><?= esc($bk['nama_produk']); ?></span>
                                        <small class="text-muted">
                                            Ukuran: <strong><?= esc($bk['ukuran']); ?></strong>
                                            <?= $bk['warna'] ? ' • ' . esc($bk['warna']) : ''; ?>
                                        </small>
                                    </td>
                                    <td class="px-2 text-center text-nowrap" data-order="<?= (int) $bk['jumlah']; ?>">
                                        <span class="badge bg-danger rounded-3 fw-semibold">
                                            -<?= (int) $bk['jumlah']; ?> pcs
                                        </span>
                                    </td>
                                    <td class="px-2 text-nowrap">
                                        <?php if (!empty($bk['no_resi'])) : ?>
                                            <span class="text-dark fw-medium"><?= esc($bk['no_resi']); ?></span>
                                        <?php else : ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <form action="/Admin/BarangKeluar/hapus/<?= $bk['id_transaksi_keluar']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus transaksi ini? Stok akan otomatis dikembalikan.');">
                                                Hapus
                                            </button>
                                        </form>
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

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="tambahKeluarModal" tabindex="-1" aria-labelledby="tambahKeluarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="tambahKeluarModalLabel">Tambah Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/BarangKeluar/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_keluar" class="form-label fw-medium">Tanggal Keluar</label>
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_saluran" class="form-label fw-medium">Saluran Penjualan</label>
                        <select class="form-select" id="id_saluran" name="id_saluran" required>
                            <option value="">-- Pilih Saluran --</option>
                            <?php foreach ($saluran as $s) : ?>
                                <option value="<?= $s['id_saluran']; ?>"><?= esc($s['nama_saluran']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_varian" class="form-label fw-medium">Produk &amp; Ukuran</label>
                        <select class="form-select" id="id_varian" name="id_varian" required>
                            <option value="">-- Pilih Produk & Ukuran --</option>
                            <?php foreach ($varian as $v) : ?>
                                <option value="<?= $v['id_varian']; ?>">
                                    <?= esc($v['nama_produk']); ?> — Ukuran <?= esc($v['ukuran']); ?> <?= $v['warna'] ? '(' . esc($v['warna']) . ')' : ''; ?> [Stok: <?= $v['stok']; ?>]
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="jumlah" class="form-label fw-medium">Jumlah (pcs)</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" placeholder="Contoh: 5" required>
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="no_resi" class="form-label fw-medium">No. Resi</label>
                            <input type="text" class="form-control" id="no_resi" name="no_resi" placeholder="Kosongkan jika offline">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-medium">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Opsional..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        // 1. Inisialisasi DataTables
        const table = $('#tabelBarangKeluar').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[1, 'desc'], [0, 'desc']], // Default urutkan dari tanggal & kode terbaru
            columnDefs: [
                { orderable: false, searchable: false, targets: [6] } // Matikan sorting & search di kolom Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Belum ada data barang keluar",
                zeroRecords: "Data barang keluar tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari total _MAX_ data)",
                search: "Cari:",
                searchPlaceholder: "Kode, produk, atau no. resi...",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            }
        });

        // 2. Sisipkan dropdown Filter Saluran Penjualan sejajar di sebelah kiri kotak Search
        const filterSaluranHtml = `
            <label class="d-inline-flex align-items-center gap-2 mb-0 text-nowrap">
                <span>Saluran:</span>
                <select id="filterSaluran" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua</option>
                    <?php foreach ($saluran as $s) : ?>
                        <option value="<?= esc(trim($s['nama_saluran'])); ?>"><?= esc(trim($s['nama_saluran'])); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        `;

        const $filterWrapper = $('#tabelBarangKeluar_filter');
        $filterWrapper.addClass('d-flex align-items-center justify-content-md-end gap-3 flex-wrap');
        $filterWrapper.find('label').addClass('d-inline-flex align-items-center gap-2 mb-0 text-nowrap');
        $filterWrapper.prepend(filterSaluranHtml);
        $filterWrapper.find('input[type="search"]').css('min-width', '220px');

        // Lebarkan kolom kanan DataTables agar filter & search muat 1 baris
        $('#tabelBarangKeluar_length').parent().removeClass('col-md-6').addClass('col-md-5');
        $filterWrapper.parent().removeClass('col-md-6').addClass('col-md-7');

        $('#filterSaluran').on('change', function () {
            const val = $.fn.dataTable.util.escapeRegex($(this).val().trim());
            table.column(2).search(val ? '^\\s*' + val + '\\s*$' : '', true, false).draw();
        });
    });
</script>
<?= $this->endSection(); ?>