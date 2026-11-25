<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var array $barang_masuk */
/** @var array $penjahit */
/** @var array $varian */
?>

<?= $this->section('content'); ?>
<div class="container-fluid" style="padding-top: 85px;">

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

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
                            <h5 class="card-title fw-semibold mb-1">Transaksi Barang Masuk (Setoran Penjahit)</h5>
                            <p class="text-muted small mb-0">Catat setoran hasil jahitan dari mitra penjahit, ongkos maklun, dan penambahan stok.</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMasukModal">
                            + Tambah Barang Masuk
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="tabelBarangMasuk" class="table align-middle mb-0 w-100">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col" class="px-2 text-nowrap">Kode Transaksi</th>
                                    <th scope="col" class="px-2 text-nowrap">Tanggal</th>
                                    <th scope="col" class="px-2 text-nowrap">Mitra Penjahit</th>
                                    <th scope="col" class="px-2">Produk & Ukuran</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Jumlah</th>
                                    <th scope="col" class="px-2 text-nowrap">Biaya</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($barang_masuk as $bm) : ?>
                                <tr>
                                    <td class="px-2 text-nowrap">
                                        <span class="badge bg-primary-subtle text-primary fw-semibold">
                                            <?= esc($bm['nomor_referensi']); ?>
                                        </span>
                                    </td>
                                    <td class="px-2 text-nowrap" data-order="<?= esc($bm['tanggal_masuk']); ?>">
                                        <?= date('d/m/Y', strtotime($bm['tanggal_masuk'])); ?>
                                    </td>
                                    <td class="px-2 text-nowrap">
                                        <span class="text-dark fw-medium"><?= esc(trim($bm['nama_penjahit'] ?? '-')); ?></span>
                                    </td>
                                    <td class="px-2">
                                        <span class="text-dark fw-semibold d-block"><?= esc($bm['nama_produk']); ?></span>
                                        <small class="text-muted">
                                            Ukuran: <strong><?= esc($bm['ukuran']); ?></strong>
                                            <?= $bm['warna'] ? ' • ' . esc($bm['warna']) : ''; ?>
                                        </small>
                                    </td>
                                    <td class="px-2 text-center text-nowrap" data-order="<?= (int) $bm['jumlah']; ?>">
                                        <span class="badge bg-success rounded-3 fw-semibold">
                                            +<?= (int) $bm['jumlah']; ?> pcs
                                        </span>
                                    </td>
                                    <td class="px-2 text-nowrap" data-order="<?= (int) $bm['total_biaya']; ?>">
                                        <span class="text-dark fw-semibold d-block">
                                            Rp <?= number_format($bm['total_biaya'], 0, ',', '.'); ?>
                                        </span>
                                        <small class="text-muted">
                                            @Rp <?= number_format($bm['biaya_produksi'], 0, ',', '.'); ?>/pcs
                                        </small>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="/Admin/BarangMasuk/nota/<?= $bm['id_transaksi_masuk']; ?>"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Nota
                                            </a>
                                            <form action="/Admin/BarangMasuk/hapus/<?= $bm['id_detail_masuk']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus item ini? Stok ukuran ini akan otomatis berkurang kembali.');">
                                                    Hapus
                                                </button>
                                            </form>
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

<!-- Modal Tambah Barang Masuk (Multi-Item) -->
<div class="modal fade" id="tambahMasukModal" tabindex="-1" aria-labelledby="tambahMasukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="tambahMasukModalLabel">Tambah Barang Masuk (Multi-Item)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/BarangMasuk/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="tanggal_masuk" class="form-label fw-medium">Tanggal Setor</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="id_penjahit" class="form-label fw-medium">Mitra Penjahit</label>
                            <select class="form-select" id="id_penjahit" name="id_penjahit" required>
                                <option value="">-- Pilih Penjahit Aktif --</option>
                                <?php foreach ($penjahit as $pj) : ?>
                                    <option value="<?= $pj['id_penjahit']; ?>"><?= esc($pj['nama_penjahit']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-semibold mb-0">Daftar Barang Disetor</label>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahBaris">
                            + Tambah Baris
                        </button>
                    </div>

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="42%">Produk & Ukuran</th>
                                    <th width="16%">Jumlah (pcs)</th>
                                    <th width="20%">Tarif / pcs (Rp)</th>
                                    <th width="16%">Subtotal</th>
                                    <th width="6%" class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyBarangMasuk">
                                <tr class="baris-item">
                                    <td>
                                        <select class="form-select form-select-sm" name="id_varian[]" required>
                                            <option value="">-- Pilih Produk & Ukuran --</option>
                                            <?php foreach ($varian as $v) : ?>
                                                <option value="<?= $v['id_varian']; ?>">
                                                    <?= esc($v['nama_produk']); ?> — <?= esc($v['ukuran']); ?> <?= $v['warna'] ? '(' . esc($v['warna']) . ')' : ''; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm input-jumlah" name="jumlah[]" min="1" placeholder="25" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm input-tarif" name="biaya_produksi[]" value="6000" min="0" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-light fw-semibold input-subtotal" value="Rp 0" readonly>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-baris" title="Hapus baris">&times;</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label fw-medium">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Opsional..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Grand Total Ongkos Maklun</label>
                            <input type="text" class="form-control form-control-lg bg-light fw-bold text-primary" id="grand_total_tampil" value="Rp 0" readonly>
                        </div>
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
        const table = $('#tabelBarangMasuk').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[1, 'desc'], [0, 'desc']], // Default urutkan dari tanggal & kode terbaru
            columnDefs: [
                { orderable: false, targets: [6] } // Matikan sorting di kolom Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Belum ada data barang masuk",
                zeroRecords: "Data barang masuk tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari total _MAX_ data)",
                search: "Cari:",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            }
        });

        // 2. Sisipkan dropdown Filter Mitra Penjahit sejajar di sebelah kiri kotak Search
        const filterPenjahitHtml = `
            <label class="d-inline-flex align-items-center gap-2 mb-0 text-nowrap">
                <span>Penjahit:</span>
                <select id="filterPenjahit" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua</option>
                    <?php foreach ($penjahit as $pj) : ?>
                        <option value="<?= esc(trim($pj['nama_penjahit'])); ?>"><?= esc(trim($pj['nama_penjahit'])); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        `;

        const $filterWrapper = $('#tabelBarangMasuk_filter');
        $filterWrapper.addClass('d-flex align-items-center justify-content-md-end gap-3 flex-wrap');
        $filterWrapper.find('label').addClass('d-inline-flex align-items-center gap-2 mb-0 text-nowrap');
        $filterWrapper.prepend(filterPenjahitHtml);

        // Lebarkan kolom kanan DataTables agar filter & search muat 1 baris
        $('#tabelBarangMasuk_length').parent().removeClass('col-md-6').addClass('col-md-5');
        $filterWrapper.parent().removeClass('col-md-6').addClass('col-md-7');

        $('#filterPenjahit').on('change', function () {
            const val = $.fn.dataTable.util.escapeRegex($(this).val().trim());
            table.column(2).search(val ? '^\\s*' + val + '\\s*$' : '', true, false).draw();
        });
    });

    // 3. Logika Multi-Item & Hitung Grand Total di Modal Tambah
    const tbody = document.getElementById('tbodyBarangMasuk');
    const btnTambahBaris = document.getElementById('btnTambahBaris');
    const grandTotalEl = document.getElementById('grand_total_tampil');

    function hitungSemua() {
        let grandTotal = 0;
        tbody.querySelectorAll('.baris-item').forEach(row => {
            const qty   = parseFloat(row.querySelector('.input-jumlah').value) || 0;
            const tarif = parseFloat(row.querySelector('.input-tarif').value) || 0;
            const sub   = (qty > 0 && tarif >= 0) ? (qty * tarif) : 0;
            row.querySelector('.input-subtotal').value = 'Rp ' + sub.toLocaleString('id-ID');
            grandTotal += sub;
        });
        grandTotalEl.value = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    btnTambahBaris.addEventListener('click', () => {
        const barisPertama = tbody.querySelector('.baris-item');
        const barisBaru = barisPertama.cloneNode(true);
        barisBaru.querySelector('select').value = '';
        barisBaru.querySelector('.input-jumlah').value = '';
        barisBaru.querySelector('.input-tarif').value = '6000';
        barisBaru.querySelector('.input-subtotal').value = 'Rp 0';
        tbody.appendChild(barisBaru);
    });

    tbody.addEventListener('input', (e) => {
        if (e.target.classList.contains('input-jumlah') || e.target.classList.contains('input-tarif')) {
            hitungSemua();
        }
    });

    tbody.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-hapus-baris')) {
            const totalBaris = tbody.querySelectorAll('.baris-item').length;
            if (totalBaris > 1) {
                e.target.closest('.baris-item').remove();
                hitungSemua();
            }
        }
    });
</script>
<?= $this->endSection(); ?>