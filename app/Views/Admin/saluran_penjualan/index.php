<?= $this->extend('TemplateAdmin'); ?>
<?php /** @var array $saluran */ ?>

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
                    <h5 class="card-title fw-semibold mb-1">Data Saluran Penjualan</h5>
                    <p class="text-muted small mb-0">Kelola daftar platform penjualan online maupun toko offline ALZA.STORE.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSaluran">
                    + Tambah Saluran
                </button>
            </div>

            <div class="table-responsive">
                <table id="tabelSaluran" class="table align-middle mb-0 w-100">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th scope="col" class="px-2 text-center text-nowrap" style="width: 60px;">No</th>
                            <th scope="col" class="px-2 text-start">Nama Saluran</th>
                            <th scope="col" class="px-2 text-center text-nowrap" style="width: 160px;">Total Transaksi</th>
                            <th scope="col" class="px-2 text-center text-nowrap" style="width: 120px;">Status</th>
                            <th scope="col" class="px-2 text-center text-nowrap" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; foreach ($saluran as $s) : ?>
                        <?php
                            $status = $s['status_aktif'] ?? ($s['status'] ?? 'Aktif');
                            $total  = (int) ($s['total_transaksi'] ?? 0);
                        ?>
                        <tr>
                            <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                            <td class="px-2 text-start fw-semibold text-dark">
                                <?= esc($s['nama_saluran']); ?>
                            </td>
                            <td class="px-2 text-center text-nowrap" data-order="<?= $total; ?>">
                                <?php if ($total > 0) : ?>
                                    <span class="badge bg-info-subtle text-info fw-semibold">
                                        <?= $total; ?> Transaksi
                                    </span>
                                <?php else : ?>
                                    <span class="badge bg-light text-muted fw-normal">
                                        0 Transaksi
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap">
                                <?php if (strtolower($status) === 'aktif') : ?>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button"
                                        class="btn btn-sm btn-warning text-dark btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditSaluran"
                                        data-id="<?= $s['id_saluran']; ?>"
                                        data-nama="<?= esc($s['nama_saluran']); ?>"
                                        data-status="<?= esc($status); ?>">
                                        Edit
                                    </button>

                                    <form action="/Admin/SaluranPenjualan/hapus/<?= $s['id_saluran']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus saluran penjualan <?= esc($s['nama_saluran']); ?>?');">
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

<!-- Modal Tambah Saluran -->
<div class="modal fade" id="modalTambahSaluran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Tambah Saluran Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/SaluranPenjualan/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Saluran</label>
                        <input type="text" name="nama_saluran" class="form-control" placeholder="Contoh: Shopee, TikTok Shop, Toko Offline" required>
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

<!-- Modal Edit Saluran -->
<div class="modal fade" id="modalEditSaluran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Edit Saluran Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditSaluran" action="" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Saluran</label>
                        <input type="text" id="edit_nama" name="nama_saluran" class="form-control" required>
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
        $('#tabelSaluran').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 4] } // Matikan sorting di kolom No & Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                emptyTable: "Belum ada data saluran penjualan",
                zeroRecords: "Data saluran penjualan tidak ditemukan",
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

        // Isi otomatis Modal Edit saat tombol Edit diklik
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#formEditSaluran').attr('action', '/Admin/SaluranPenjualan/update/' + id);
            $('#edit_nama').val($(this).data('nama'));
            $('#edit_status').val($(this).data('status'));
        });
    });
</script>
<?= $this->endSection(); ?>