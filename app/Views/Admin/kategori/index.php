<?= $this->extend('TemplateAdmin'); ?>
<?php /** @var array $kategori */ ?>

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
                    <h5 class="card-title fw-semibold mb-1">Data Kategori Produk</h5>
                    <p class="text-muted small mb-0">Kelola pengelompokan jenis dan kode kategori produk ALZA.STORE.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                    + Tambah Kategori
                </button>
            </div>

            <div class="table-responsive">
                <table id="tabelKategori" class="table align-middle mb-0 w-100">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0">
                            <th scope="col" class="px-2 text-center text-nowrap" width="6%">No</th>
                            <th scope="col" class="px-2 text-center text-nowrap" width="14%">Kode Kategori</th>
                            <th scope="col" class="px-2 text-start">Nama Kategori</th>
                            <th scope="col" class="px-2 text-start">Deskripsi</th>
                            <th scope="col" class="px-2 text-center text-nowrap" width="14%">Jumlah Produk</th>
                            <th scope="col" class="px-2 text-center text-nowrap" width="16%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; foreach ($kategori as $k) : ?>
                        <tr>
                            <td class="px-2 text-center text-muted text-nowrap"><?= $no++; ?></td>
                            <td class="px-2 text-center text-nowrap">
                                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2">
                                    <?= esc(strtoupper($k['kode_produk'])); ?>
                                </span>
                            </td>
                            <td class="px-2 text-start fw-semibold text-dark">
                                <?= esc($k['nama_kategori']); ?>
                            </td>
                            <td class="px-2 text-start text-wrap">
                                <?php if (!empty($k['deskripsi'])) : ?>
                                    <span class="text-dark"><?= esc($k['deskripsi']); ?></span>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap" data-order="<?= (int) $k['jumlah_produk']; ?>">
                                <?php if ((int) $k['jumlah_produk'] > 0) : ?>
                                    <span class="badge bg-info-subtle text-info fw-semibold">
                                        <?= (int) $k['jumlah_produk']; ?> Produk
                                    </span>
                                <?php else : ?>
                                    <span class="badge bg-light text-muted fw-normal">
                                        0 Produk
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-2 text-center text-nowrap">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button"
                                        class="btn btn-sm btn-warning text-dark btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditKategori"
                                        data-id="<?= $k['id_kategori']; ?>"
                                        data-kode="<?= esc(strtoupper($k['kode_produk'])); ?>"
                                        data-nama="<?= esc($k['nama_kategori']); ?>"
                                        data-deskripsi="<?= esc($k['deskripsi'] ?? ''); ?>">
                                        Edit
                                    </button>

                                    <form action="/Admin/Kategori/hapus/<?= $k['id_kategori']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus kategori <?= esc($k['nama_kategori']); ?>?');">
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Tambah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/Kategori/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Kode Kategori</label>
                        <input type="text" name="kode_kategori" class="form-control text-uppercase" placeholder="Contoh: K1" maxlength="10" required>
                        <small class="text-muted">Otomatis tersimpan dalam huruf kapital.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Kemeja Polos Lengan Pendek" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Deskripsi <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" class="form-control" rows="2" placeholder="Contoh: Bahan katun oxford, potongan regular fit..."></textarea>
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

<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Edit Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditKategori" action="" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Kode Kategori</label>
                        <input type="text" id="edit_kode" name="kode_kategori" class="form-control text-uppercase" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Kategori</label>
                        <input type="text" id="edit_nama" name="nama_kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Deskripsi <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="2"></textarea>
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
        $('#tabelKategori').DataTable({
            lengthMenu: [10, 25, 50],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 5] } // Matikan sorting di kolom No & Aksi
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ ",
                emptyTable: "Belum ada data kategori produk",
                zeroRecords: "Data kategori tidak ditemukan",
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
            $('#formEditKategori').attr('action', '/Admin/Kategori/update/' + id);
            $('#edit_kode').val($(this).data('kode'));
            $('#edit_nama').val($(this).data('nama'));
            $('#edit_deskripsi').val($(this).data('deskripsi'));
        });
    });
</script>
<?= $this->endSection(); ?>