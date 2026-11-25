<?= $this->extend('TemplateAdmin'); ?>
<?php /** @var array $penjahit */ ?>

<?= $this->section('content'); ?>
<div class="container-fluid" style="padding-top: 85px;">

    <!-- Flash Message Notifikasi -->
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

    <div class="card mb-0">
        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h5 class="card-title fw-semibold mb-1">Data Mitra Penjahit</h5>
                    <p class="text-muted small mb-0">Kelola daftar mitra konveksi/penjahit, kontak, dan status kerja sama ALZA.STORE.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPenjahit">
                    + Tambah Penjahit
                </button>
            </div>

            <div class="table-responsive">
                <table id="tabelPenjahit" class="table align-middle mb-0 w-100">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th scope="col" class="px-2 text-center text-nowrap" width="6%">No</th>
                            <th scope="col" class="px-2 text-start">Nama Penjahit</th>
                            <th scope="col" class="px-2 text-start text-nowrap">No. Telepon / WA</th>
                            <th scope="col" class="px-2 text-start" style="min-width: 220px;">Alamat</th>
                            <th scope="col" class="px-2 text-center text-nowrap" width="12%">Status</th>
                            <th scope="col" class="px-2 text-center text-nowrap" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; foreach ($penjahit as $p) : ?>
                        <?php $status = $p['status_aktif'] ?? 'Aktif'; ?>
                        <tr>
                            <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                            <td class="px-2 text-start fw-semibold text-dark text-nowrap">
                                <?= esc($p['nama_penjahit']); ?>
                            </td>
                            <td class="px-2 text-start text-nowrap">
                                <?php if (!empty($p['no_telepon'])) : ?>
                                    <span class="text-dark"><?= esc($p['no_telepon']); ?></span>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-start text-wrap">
                                <?php if (!empty($p['alamat'])) : ?>
                                    <span class="text-dark"><?= esc($p['alamat']); ?></span>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap">
                                <?php if (strtolower($status) === 'aktif') : ?>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-secondary-subtle text-danger rounded-pill px-3 py-2">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button"
                                        class="btn btn-sm btn-warning text-dark btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPenjahit"
                                        data-id="<?= $p['id_penjahit']; ?>"
                                        data-nama="<?= esc($p['nama_penjahit']); ?>"
                                        data-telepon="<?= esc($p['no_telepon'] ?? ''); ?>"
                                        data-alamat="<?= esc($p['alamat'] ?? ''); ?>"
                                        data-status="<?= esc($status); ?>">
                                        Edit
                                    </button>

                                    <form action="/Admin/Penjahit/hapus/<?= $p['id_penjahit']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data penjahit <?= esc($p['nama_penjahit']); ?>?');">
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

<!-- Modal Tambah Penjahit -->
<div class="modal fade" id="modalTambahPenjahit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Tambah Mitra Penjahit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/Penjahit/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Penjahit</label>
                        <input type="text" name="nama_penjahit" class="form-control" placeholder="Contoh: Konveksi Maju Jaya" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">No. Telepon / WA</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="Contoh: 081234567890" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Jl. Raya ..., Desa ..., Kecamatan ..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" selected>Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Penjahit -->
<div class="modal fade" id="modalEditPenjahit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Edit Mitra Penjahit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPenjahit" action="" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Penjahit</label>
                        <input type="text" id="edit_nama" name="nama_penjahit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">No. Telepon / WA</label>
                        <input type="text" id="edit_telepon" name="no_telepon" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Alamat Lengkap</label>
                        <textarea id="edit_alamat" name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Status</label>
                        <select id="edit_status" name="status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        const table = $('#tabelPenjahit').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 2, 5] } // Matikan sorting di kolom No, No. Telepon / WA, & Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Belum ada data mitra penjahit",
                zeroRecords: "Data penjahit tidak ditemukan",
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

        // Sisipkan dropdown Filter Status sejajar di sebelah kiri kotak Search
        const filterStatusHtml = `
            <label class="d-inline-flex align-items-center gap-2 mb-0 text-nowrap">
                <span>Status:</span>
                <select id="filterStatusPenjahit" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </label>
        `;

        const $filterWrapper = $('#tabelPenjahit_filter');
        $filterWrapper.addClass('d-flex align-items-center justify-content-md-end gap-3 flex-wrap');
        $filterWrapper.find('label').addClass('d-inline-flex align-items-center gap-2 mb-0 text-nowrap');
        $filterWrapper.prepend(filterStatusHtml);

        // Lebarkan kolom kanan DataTables agar filter & search muat 1 baris
        $('#tabelPenjahit_length').parent().removeClass('col-md-6').addClass('col-md-5');
        $filterWrapper.parent().removeClass('col-md-6').addClass('col-md-7');

        // Logika Filter Status (exact match agar "Aktif" tidak ikut memunculkan "Nonaktif")
        $('#filterStatusPenjahit').on('change', function () {
            const val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(4).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Isi otomatis Modal Edit saat tombol Edit diklik
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#formEditPenjahit').attr('action', '/Admin/Penjahit/update/' + id);
            $('#edit_nama').val($(this).data('nama'));
            $('#edit_telepon').val($(this).data('telepon'));
            $('#edit_alamat').val($(this).data('alamat'));
            $('#edit_status').val($(this).data('status'));
        });
    });
</script>
<?= $this->endSection(); ?>