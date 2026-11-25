<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var array $barang_retur */
/** @var array $saluran */
/** @var array $varian */
/** @var array $transaksi_keluar */
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
                            <h5 class="card-title fw-semibold mb-1">Data Barang Retur</h5>
                            <p class="text-muted small mb-0">Catat pengembalian barang dari pelanggan, alasan retur, dan status tindak lanjutnya.</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahReturModal">
                            + Tambah Barang Retur
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="tabelBarangRetur" class="table align-middle mb-0 w-100">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col" class="px-2 text-nowrap">Kode &amp; Tanggal</th>
                                    <th scope="col" class="px-2 text-nowrap">Asal Retur / Resi</th>
                                    <th scope="col" class="px-2">Produk &amp; Ukuran</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Jumlah</th>
                                    <th scope="col" class="px-2">Alasan</th>
                                    <th scope="col" class="px-2 text-nowrap">Tindak Lanjut</th>
                                    <th scope="col" class="px-2 text-center text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($barang_retur as $br) : ?>
                                <tr>
                                    <td class="px-2 text-nowrap" data-order="<?= esc($br['tanggal_retur'] . ' ' . $br['nomor_retur']); ?>">
                                        <span class="badge bg-warning-subtle text-warning fw-semibold d-inline-block mb-1">
                                            <?= esc($br['nomor_retur']); ?>
                                        </span>
                                        <small class="d-block text-muted">
                                            <?= date('d/m/Y', strtotime($br['tanggal_retur'])); ?>
                                        </small>
                                    </td>
                                    <td class="px-2 text-nowrap">
                                        <span class="badge bg-info-subtle text-info fw-semibold d-inline-block mb-1">
                                            <?= esc($br['nama_saluran'] ?? '-'); ?>
                                        </span>
                                        <?php if (!empty($br['nomor_pesanan'])) : ?>
                                            <small class="d-block text-muted">
                                                Ref: <?= esc($br['no_resi'] && $br['no_resi'] !== '-' ? $br['no_resi'] : $br['nomor_pesanan']); ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2">
                                        <span class="text-dark fw-semibold d-block"><?= esc($br['nama_produk']); ?></span>
                                        <small class="text-muted">
                                            Ukuran: <strong><?= esc($br['ukuran']); ?></strong>
                                            <?= $br['warna'] ? ' • ' . esc($br['warna']) : ''; ?>
                                        </small>
                                    </td>
                                    <td class="px-2 text-center text-nowrap" data-order="<?= (int) $br['jumlah_retur']; ?>">
                                        <span class="fw-semibold text-dark"><?= (int) $br['jumlah_retur']; ?> pcs</span>
                                    </td>
                                    <td class="px-2 text-wrap">
                                        <?php if (!empty($br['kategori_retur']) || !empty($br['alasan'])) : ?>
                                            <?php if (!empty($br['kategori_retur'])) : ?>
                                                <span class="text-dark fw-medium d-block"><?= esc($br['kategori_retur']); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($br['alasan'])) : ?>
                                                <small class="text-muted"><?= esc($br['alasan']); ?></small>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 text-nowrap">
                                        <?php if ($br['tindak_lanjut'] === 'Layak Jual Kembali') : ?>
                                            <span class="badge bg-success rounded-3 fw-semibold d-inline-block mb-1">
                                                Layak Jual Kembali
                                            </span>
                                            <small class="d-block text-success fw-medium">
                                                +<?= (int) $br['jumlah_retur']; ?> pcs (Menambah stok)
                                            </small>
                                        <?php elseif ($br['tindak_lanjut'] === 'Perbaikan Penjahit') : ?>
                                            <span class="badge bg-warning text-dark rounded-3 fw-semibold d-inline-block mb-1">
                                                Perbaikan Penjahit
                                            </span>
                                            <small class="d-block text-muted">
                                                Tidak menambah stok
                                            </small>
                                        <?php else : ?>
                                            <span class="badge bg-danger rounded-3 fw-semibold d-inline-block mb-1">
                                                Rusak / Afkir
                                            </span>
                                            <small class="d-block text-muted">
                                                Tidak menambah stok
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-2 text-center text-nowrap">
                                        <form action="/Admin/BarangRetur/hapus/<?= $br['id_retur']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-sm btn-danger text-nowrap"
                                                onclick="return confirm('Hapus data retur ini? Jika sebelumnya menambah stok, stok akan disesuaikan kembali.');">
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

<!-- Modal Tambah Barang Retur -->
<div class="modal fade" id="tambahReturModal" tabindex="-1" aria-labelledby="tambahReturModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="tambahReturModalLabel">Tambah Barang Retur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/BarangRetur/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_transaksi_keluar" class="form-label fw-medium">Referensi Transaksi / No. Resi (Opsional)</label>
                        <select class="form-select" id="id_transaksi_keluar" name="id_transaksi_keluar">
                            <option value="">-- Tanpa Resi / Retur Manual (Offline / Internal) --</option>
                            <?php foreach ($transaksi_keluar as $tk) :
                                $sisaRetur = (int) $tk['jumlah_keluar'] - (int) $tk['sudah_diretur'];
                                if ($sisaRetur <= 0) continue;
                            ?>
                                <option value="<?= $tk['id_transaksi_keluar']; ?>"
                                    data-saluran="<?= $tk['id_saluran']; ?>"
                                    data-varian="<?= $tk['id_varian']; ?>"
                                    data-sisa="<?= $sisaRetur; ?>">
                                    <?= esc($tk['no_resi'] && $tk['no_resi'] !== '-' ? $tk['no_resi'] : $tk['nomor_pesanan']); ?>
                                    — <?= esc($tk['nama_saluran']); ?> (<?= esc($tk['nama_produk']); ?> <?= esc($tk['ukuran']); ?> | Sisa: <?= $sisaRetur; ?> pcs)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Pilih jika retur berasal dari pesanan online agar data terisi otomatis.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_retur" class="form-label fw-medium">Tanggal Retur</label>
                            <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_saluran" class="form-label fw-medium">Asal Retur</label>
                            <select class="form-select" id="id_saluran" name="id_saluran" required>
                                <option value="">-- Pilih Saluran --</option>
                                <?php foreach ($saluran as $s) : ?>
                                    <option value="<?= $s['id_saluran']; ?>"><?= esc($s['nama_saluran']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_varian" class="form-label fw-medium">Produk &amp; Ukuran</label>
                        <select class="form-select" id="id_varian" name="id_varian" required>
                            <option value="">-- Pilih Produk & Ukuran --</option>
                            <?php foreach ($varian as $v) : ?>
                                <option value="<?= $v['id_varian']; ?>">
                                    <?= esc($v['nama_produk']); ?> — Ukuran <?= esc($v['ukuran']); ?> <?= $v['warna'] ? '(' . esc($v['warna']) . ')' : ''; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="jumlah_retur" class="form-label fw-medium">Jumlah (pcs)</label>
                            <input type="number" class="form-control" id="jumlah_retur" name="jumlah_retur" min="1" value="1" required>
                            <small class="text-primary fw-medium d-none" id="infoSisaRetur"></small>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="kategori_retur" class="form-label fw-medium">Kategori Alasan</label>
                            <select class="form-select" id="kategori_retur" name="kategori_retur" required>
                                <option value="Tukar Ukuran">Tukar Ukuran</option>
                                <option value="Cacat Jahitan">Cacat Jahitan</option>
                                <option value="Noda Kain">Noda Kain</option>
                                <option value="Salah Kirim">Salah Kirim</option>
                                <option value="Gagal COD">Gagal COD</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tindak_lanjut" class="form-label fw-medium">Tindak Lanjut</label>
                        <select class="form-select" id="tindak_lanjut" name="tindak_lanjut" required>
                            <option value="Layak Jual Kembali">Layak Jual Kembali (Stok Bertambah)</option>
                            <option value="Perbaikan Penjahit">Perbaikan Penjahit (Tidak Menambah Stok)</option>
                            <option value="Rusak / Afkir">Rusak / Afkir (Tidak Menambah Stok)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alasan" class="form-label fw-medium">Catatan Alasan</label>
                        <textarea class="form-control" id="alasan" name="alasan" rows="2" placeholder="Opsional..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Retur</button>
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
        const table = $('#tabelBarangRetur').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[0, 'desc']], // Default urutkan dari tanggal & kode terbaru
            columnDefs: [
                { orderable: false, searchable: false, targets: [6] } // Matikan sorting & search di kolom Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Belum ada data barang retur",
                zeroRecords: "Data barang retur tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari total _MAX_ data)",
                search: "Cari:",
                searchPlaceholder: "Kode, resi, atau produk...",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            }
        });

        // 2. Sisipkan dropdown Filter Tindak Lanjut sejajar di sebelah kiri kotak Search
        const filterTindakLanjutHtml = `
            <label class="d-inline-flex align-items-center gap-2 mb-0 text-nowrap">
                <span>Tindak Lanjut:</span>
                <select id="filterTindakLanjut" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua</option>
                    <option value="Layak Jual Kembali">Layak Jual Kembali</option>
                    <option value="Perbaikan Penjahit">Perbaikan Penjahit</option>
                    <option value="Rusak / Afkir">Rusak / Afkir</option>
                </select>
            </label>
        `;

        const $filterWrapper = $('#tabelBarangRetur_filter');
        $filterWrapper.addClass('d-flex align-items-center justify-content-md-end gap-3 flex-wrap');
        $filterWrapper.find('label').addClass('d-inline-flex align-items-center gap-2 mb-0 text-nowrap');
        $filterWrapper.prepend(filterTindakLanjutHtml);
        $filterWrapper.find('input[type="search"]').css('min-width', '220px');

        // Lebarkan kolom kanan DataTables agar filter & search muat 1 baris
        $('#tabelBarangRetur_length').parent().removeClass('col-md-6').addClass('col-md-5');
        $filterWrapper.parent().removeClass('col-md-6').addClass('col-md-7');

        $('#filterTindakLanjut').on('change', function () {
            table.column(5).search($(this).val()).draw();
        });
    });

    // 3. Auto-fill form saat referensi resi/transaksi keluar dipilih
    const selectRef     = document.getElementById('id_transaksi_keluar');
    const selectSaluran = document.getElementById('id_saluran');
    const selectVarian  = document.getElementById('id_varian');
    const inputJumlah   = document.getElementById('jumlah_retur');
    const infoSisa      = document.getElementById('infoSisaRetur');

    selectRef.addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        if (this.value) {
            selectSaluran.value = opt.getAttribute('data-saluran');
            selectVarian.value  = opt.getAttribute('data-varian');
            const sisa = opt.getAttribute('data-sisa');
            inputJumlah.max = sisa;
            inputJumlah.value = 1;
            infoSisa.textContent = 'Maksimal ' + sisa + ' pcs';
            infoSisa.classList.remove('d-none');
        } else {
            inputJumlah.removeAttribute('max');
            infoSisa.classList.add('d-none');
        }
    });
</script>
<?= $this->endSection(); ?>