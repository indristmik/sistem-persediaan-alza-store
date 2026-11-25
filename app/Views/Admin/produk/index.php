<?= $this->extend('TemplateAdmin'); ?>
<?php
/** @var array $produk */
/** @var array $kategori */
?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<style>
    .bg-danger-subtle {
        background-color: #f8d7da !important;
    }
    .border-danger-subtle {
        border-color: #f1aeb5 !important;
    }
    .produk-thumb {
        width: 40px;
        height: 40px;
        object-fit: cover;
        flex-shrink: 0;
        cursor: zoom-in;
        transition: transform 0.15s ease;
    }
    .produk-thumb:hover {
        transform: scale(1.08);
    }
    .produk-thumb-placeholder {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
    }
    .preview-upload {
        width: 72px;
        height: 72px;
        object-fit: cover;
    }
    div.dataTables_wrapper div.dataTables_filter {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        align-items: center;
        gap: 0.5rem;
    }
    div.dataTables_wrapper div.dataTables_filter label {
        margin-bottom: 0;
    }
</style>

<div class="container-fluid" style="padding-top: 85px;">

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('pesan')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('error')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">Data Produk</h5>
                            <p class="text-muted small mb-0">Kelola katalog produk, foto, dan rincian varian ukuran/SKU ALZA.STORE.</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                            + Tambah Produk
                        </button>
                    </div>

                    <!-- Dropdown Filter Kategori -->
                    <div class="d-none">
                        <select id="filterKategori" class="form-select form-select-sm w-auto">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>">
                                    [<?= esc(strtoupper($k['kode_produk'])); ?>] <?= esc($k['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table id="tabelProduk" class="table align-middle mb-0 w-100">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col" class="px-2 text-center text-nowrap" width="5%">No</th>
                                    <th scope="col" class="px-2" width="18%">Kategori</th>
                                    <th scope="col" class="px-2" width="25%">Nama Produk</th>
                                    <th scope="col" class="px-2" width="32%">Varian &amp; Total Stok</th>
                                    <th scope="col" class="px-2 text-center text-nowrap" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                <?php $no = 1; foreach ($produk as $p) : ?>
                                <?php
                                $adaFoto = !empty($p['foto']) && is_file(FCPATH . 'uploads/produk/' . $p['foto']);
                                $urlFoto = $adaFoto ? base_url('uploads/produk/' . $p['foto']) : '';
                                ?>
                                <tr data-kategori-id="<?= $p['id_kategori']; ?>">
                                    <!-- Kolom 0: No -->
                                    <th scope="row" class="px-2 fw-medium text-muted text-center text-nowrap">
                                        <?= $no++; ?>
                                    </th>

                                    <!-- Kolom 1: Kategori -->
                                    <td class="px-2" data-order="<?= esc($p['nama_kategori']); ?>">
                                        <span class="badge bg-primary-subtle text-primary fw-semibold text-uppercase">
                                            <?= esc(strtoupper($p['kode_produk'])); ?>
                                        </span>
                                        <span class="d-block text-dark fw-medium mt-1">
                                            <?= esc($p['nama_kategori']); ?>
                                        </span>
                                    </td>

                                    <!-- Kolom 2: Thumbnail 40x40 + Nama Produk + Sub-Label Warna -->
                                    <td class="px-2" data-order="<?= esc($p['nama_produk']); ?>">
                                        <div class="d-flex align-items-center gap-2">
                                            <?php if ($adaFoto) : ?>
                                                <img src="<?= $urlFoto; ?>"
                                                     alt="<?= esc($p['nama_produk']); ?>"
                                                     class="rounded border produk-thumb btn-zoom-foto"
                                                     data-foto-url="<?= $urlFoto; ?>"
                                                     data-foto-judul="<?= esc($p['nama_produk']); ?>"
                                                     title="Klik untuk memperbesar foto">
                                            <?php else : ?>
                                                <div class="rounded border bg-light produk-thumb-placeholder" title="Belum ada foto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <span class="text-dark fw-semibold d-block">
                                                    <?= esc($p['nama_produk']); ?>
                                                </span>
                                                <?php if (!empty($p['daftar_warna'])) : ?>
                                                    <small class="text-muted d-block">
                                                        <?= esc($p['daftar_warna']); ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Kolom 3: Badge Varian & Total Stok -->
                                    <td class="px-2">
                                        <?php if (!empty($p['rincian_varian'])) : ?>
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <?php foreach ($p['rincian_varian'] as $v) : ?>
                                                    <?php
                                                    $stok       = (int) $v['stok'];
                                                    $kelasBadge = ($stok > 0)
                                                        ? 'bg-light text-dark border'
                                                        : 'bg-danger-subtle text-danger border border-danger-subtle';
                                                    ?>
                                                    <button type="button"
                                                        class="badge <?= $kelasBadge; ?> fw-medium px-2 py-1"
                                                        style="cursor: pointer;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editVarianModal<?= $v['id_varian']; ?>"
                                                        title="SKU: <?= esc($v['kode_sku']); ?> | Min: <?= (int) $v['stok_minimum']; ?> | Klik untuk Edit">
                                                        <?= esc($v['ukuran']); ?> (<?= $stok; ?>)
                                                    </button>
                                                <?php endforeach; ?>
                                                <span class="text-muted ms-1">—</span>
                                                <strong class="text-dark fw-bold">
                                                    <?= number_format((int) $p['total_stok'], 0, ',', '.'); ?> pcs
                                                </strong>
                                            </div>
                                        <?php else : ?>
                                            <span class="text-muted fst-italic small">Belum ada varian</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Kolom 4: Aksi -->
                                    <td class="px-2 text-center text-nowrap">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#tambahVarianModal<?= $p['id_produk']; ?>">
                                                + Ukuran
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#editProdukModal<?= $p['id_produk']; ?>">
                                                Edit
                                            </button>
                                            <form action="/Admin/Produk/hapus/<?= $p['id_produk']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk beserta semua variannya?');">
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

<!-- Modal Preview Zoom Foto Produk -->
<div class="modal fade" id="previewFotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title fw-semibold mb-0" id="previewFotoJudul">Foto Produk</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <img id="previewFotoImg" src="" alt="Preview Foto" class="img-fluid rounded border" style="max-height: 70vh;">
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk Baru -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Admin/Produk/simpan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label fw-medium">Kategori</label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>">
                                    [<?= esc(strtoupper($k['kode_produk'])); ?>] <?= esc($k['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-medium">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Contoh: Kemeja Oxford Basic" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_tambah" class="form-label fw-medium">Foto Produk <span class="text-muted fw-normal small">(Opsional)</span></label>
                        <div class="d-flex align-items-center gap-3">
                            <img id="previewTambahFoto" src="" alt="Preview" class="rounded border preview-upload d-none">
                            <div class="flex-grow-1">
                                <input type="file" class="form-control input-foto-preview" id="foto_tambah" name="foto" accept=".jpg,.jpeg,.png,.webp" data-preview-target="#previewTambahFoto">
                                <small class="text-muted">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-medium">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Opsional..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk, Kelola/Tambah Ukuran, & Edit Varian (Per Produk) -->
<?php foreach ($produk as $p) : ?>
    <?php
    $adaFoto = !empty($p['foto']) && is_file(FCPATH . 'uploads/produk/' . $p['foto']);
    $urlFoto = $adaFoto ? base_url('uploads/produk/' . $p['foto']) : '';
    ?>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editProdukModal<?= $p['id_produk']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/Admin/Produk/update/<?= $p['id_produk']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Kategori</label>
                            <select class="form-select" name="id_kategori" required>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id_kategori']; ?>" <?= ($p['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                                        [<?= esc(strtoupper($k['kode_produk'])); ?>] <?= esc($k['nama_kategori']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" value="<?= esc($p['nama_produk']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Foto Produk <span class="text-muted fw-normal small">(Opsional)</span></label>
                            <div class="d-flex align-items-start gap-3">
                                <img id="previewEditFoto<?= $p['id_produk']; ?>"
                                     src="<?= $adaFoto ? $urlFoto : ''; ?>"
                                     alt="Preview"
                                     class="rounded border preview-upload <?= $adaFoto ? '' : 'd-none'; ?>">
                                <div class="flex-grow-1">
                                    <input type="file"
                                           class="form-control input-foto-preview"
                                           name="foto"
                                           accept=".jpg,.jpeg,.png,.webp"
                                           data-preview-target="#previewEditFoto<?= $p['id_produk']; ?>">
                                    <small class="text-muted d-block">Kosongkan jika tidak ingin mengganti foto. Maks. 2 MB.</small>
                                    <?php if ($adaFoto) : ?>
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="hapusFoto<?= $p['id_produk']; ?>">
                                            <label class="form-check-label small text-danger" for="hapusFoto<?= $p['id_produk']; ?>">
                                                Hapus foto saat ini
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3"><?= esc($p['deskripsi'] ?? ''); ?></textarea>
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

    <!-- Modal Kelola & Tambah Ukuran/SKU -->
    <div class="modal fade" id="tambahVarianModal<?= $p['id_produk']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-semibold mb-0">Kelola Ukuran — <?= esc($p['nama_produk']); ?></h5>
                        <?php if (!empty($p['daftar_warna'])) : ?>
                            <small class="text-muted">Warna: <?= esc($p['daftar_warna']); ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h6 class="fw-semibold mb-2">Daftar Ukuran Saat Ini</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-sm table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="10%">Ukuran</th>
                                    <th width="20%">SKU</th>
                                    <th width="16%">Warna</th>
                                    <th class="text-center" width="12%">Stok</th>
                                    <th width="26%">Batas Minimum</th>
                                    <th class="text-center" width="16%">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($p['rincian_varian'])) : ?>
                                    <?php foreach ($p['rincian_varian'] as $v) : ?>
                                        <?php
                                        $stokVarian   = (int) $v['stok'];
                                        $punyaRiwayat = ((int) ($v['jumlah_transaksi'] ?? 0)) > 0;
                                        ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?= esc($v['ukuran']); ?></td>
                                            <td class="small"><?= esc($v['kode_sku']); ?></td>
                                            <td class="small"><?= esc($v['warna'] ?: '-'); ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= ($stokVarian > 0) ? 'bg-light text-dark border' : 'bg-danger-subtle text-danger border border-danger-subtle'; ?>">
                                                    <?= $stokVarian; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <form action="/Admin/Produk/updateStokMinimum/<?= $v['id_varian']; ?>" method="post" class="d-flex gap-1">
                                                    <?= csrf_field(); ?>
                                                    <input type="number" name="stok_minimum" class="form-control form-control-sm" value="<?= (int) ($v['stok_minimum'] ?? 10); ?>" min="0" required>
                                                    <button type="submit" class="btn btn-sm btn-outline-success text-nowrap">Simpan</button>
                                                </form>
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <?php if ($punyaRiwayat) : ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" disabled title="Tidak bisa dihapus karena sudah memiliki riwayat transaksi stok">
                                                        Terkunci
                                                    </button>
                                                <?php else : ?>
                                                    <form action="/Admin/Produk/hapusVarian/<?= $v['id_varian']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus ukuran <?= esc($v['ukuran']); ?> ini?');">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3 small">
                                            Belum ada ukuran terdaftar untuk produk ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h6 class="fw-semibold mb-3">Tambah Ukuran Baru</h6>
                    <form action="/Admin/Produk/simpanVarian" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_produk" value="<?= $p['id_produk']; ?>">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-medium">Kode SKU</label>
                                <input type="text" class="form-control" name="kode_sku" placeholder="Contoh: KPLP-001-M" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-medium">Ukuran</label>
                                <select class="form-select" name="ukuran" required>
                                    <option value="S">S</option>
                                    <option value="M" selected>M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-medium">Warna</label>
                                <input type="text" class="form-control" name="warna" value="<?= esc($p['rincian_varian'][0]['warna'] ?? ''); ?>" placeholder="Contoh: Hitam">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Batas Minimum (pcs)</label>
                                <input type="number" class="form-control" name="stok_minimum" value="10" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Harga Jual (Rp)</label>
                                <input type="number" class="form-control" name="harga_jual" value="<?= (int) ($p['rincian_varian'][0]['harga_jual'] ?? 0); ?>" min="0">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Varian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit & Hapus Varian -->
    <?php if (!empty($p['rincian_varian'])) : ?>
        <?php foreach ($p['rincian_varian'] as $v) : ?>
            <?php $punyaRiwayat = ((int) ($v['jumlah_transaksi'] ?? 0)) > 0; ?>
            <div class="modal fade" id="editVarianModal<?= $v['id_varian']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold">Edit Varian — <?= esc($p['nama_produk']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/Admin/Produk/updateVarian/<?= $v['id_varian']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_produk" value="<?= $p['id_produk']; ?>">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Kode SKU</label>
                                        <input type="text" class="form-control" name="kode_sku" value="<?= esc($v['kode_sku'] ?? ''); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Ukuran</label>
                                        <select class="form-select" name="ukuran" required>
                                            <?php foreach (['S', 'M', 'L', 'XL', 'XXL'] as $uk) : ?>
                                                <option value="<?= $uk; ?>" <?= ($v['ukuran'] === $uk) ? 'selected' : ''; ?>><?= $uk; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Warna</label>
                                        <input type="text" class="form-control" name="warna" value="<?= esc($v['warna'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Harga Jual (Rp)</label>
                                        <input type="number" class="form-control" name="harga_jual" value="<?= $v['harga_jual'] ?? 0; ?>" min="0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Batas Minimum (pcs)</label>
                                        <input type="number" class="form-control" name="stok_minimum" value="<?= $v['stok_minimum'] ?? 10; ?>" min="0" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Sisa Stok Saat Ini</label>
                                        <input type="text" class="form-control bg-light" value="<?= (int) $v['stok']; ?> pcs (Terkunci)" disabled readonly>
                                        <small class="text-muted">Stok hanya berubah lewat transaksi.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <?php if ($punyaRiwayat) : ?>
                                    <button type="button" class="btn btn-secondary" disabled title="Tidak dapat dihapus karena sudah ada riwayat transaksi stok">
                                        Hapus Terkunci
                                    </button>
                                <?php else : ?>
                                    <button type="submit" form="formHapusVarian<?= $v['id_varian']; ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus varian ukuran <?= esc($v['ukuran']); ?> ini?');">
                                        Hapus Varian
                                    </button>
                                <?php endif; ?>
                                <div>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                        <?php if (!$punyaRiwayat) : ?>
                            <form id="formHapusVarian<?= $v['id_varian']; ?>" action="/Admin/Produk/hapusVarian/<?= $v['id_varian']; ?>" method="post" class="d-none">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

<?php endforeach; ?>

<script>
window.addEventListener('load', function () {
    // 1. Live preview foto sebelum disubmit pada Modal Tambah & Edit
    document.querySelectorAll('.input-foto-preview').forEach(function (input) {
        input.addEventListener('change', function () {
            var targetSelector = this.getAttribute('data-preview-target');
            var imgEl = document.querySelector(targetSelector);
            if (!imgEl) return;

            if (this.files && this.files[0]) {
                var reader = new window.FileReader();
                reader.onload = function (e) {
                    imgEl.src = e.target.result;
                    imgEl.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // 2. Klik thumbnail di tabel untuk zoom foto (pakai event delegation agar tetap jalan lintas halaman DataTables)
    document.addEventListener('click', function (e) {
        var thumb = e.target.closest('.btn-zoom-foto');
        if (!thumb) return;
        document.getElementById('previewFotoImg').src = thumb.getAttribute('data-foto-url');
        document.getElementById('previewFotoJudul').textContent = thumb.getAttribute('data-foto-judul');
        var modal = new bootstrap.Modal(document.getElementById('previewFotoModal'));
        modal.show();
    });

    // 3. Inisialisasi DataTables + Filter Kategori
    function loadScript(src, callback) {
        var s = document.createElement('script');
        s.src = src;
        s.onload = callback;
        document.body.appendChild(s);
    }

    function initTabelProduk() {
        var $ = window.jQuery;
        if ($.fn.DataTable.isDataTable('#tabelProduk')) {
            return;
        }

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'tabelProduk') return true;
            var selectedKat = $('#filterKategori').val();
            if (!selectedKat) return true;
            var rowNode = settings.aoData[dataIndex].nTr;
            return String($(rowNode).attr('data-kategori-id')) === String(selectedKat);
        });

        var table = $('#tabelProduk').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50], [10, 25, 50]],
            order: [[2, 'asc']],
            columnDefs: [
                { targets: [0, 3, 4], orderable: false },
                { targets: [0, 4], searchable: false }
            ],
            language: {
                lengthMenu: 'Show _MENU_ entries',
                search: 'Search:',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ produk',
                infoEmpty: 'Menampilkan 0 dari 0 produk',
                infoFiltered: '(disaring dari _MAX_ total produk)',
                zeroRecords: 'Produk tidak ditemukan',
                emptyTable: 'Belum ada data produk.',
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Berikutnya'
                }
            }
        });

        var filterWrap   = $('#tabelProduk_filter, .dt-search').first();
        var filterSelect = $('#filterKategori');
        if (filterWrap.length && filterSelect.length) {
            filterWrap.prepend(filterSelect);
        }

        filterSelect.on('change', function () {
            table.draw();
        });

        table.on('order.dt search.dt draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'current' })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = info.start + i + 1;
                });
        }).draw();
    }

    function ensureDataTables() {
        if (window.jQuery && window.jQuery.fn && window.jQuery.fn.DataTable) {
            initTabelProduk();
        } else {
            loadScript('https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js', function () {
                loadScript('https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js', initTabelProduk);
            });
        }
    }

    if (typeof window.jQuery === 'undefined') {
        loadScript('https://code.jquery.com/jquery-3.7.1.min.js', ensureDataTables);
    } else {
        ensureDataTables();
    }
});
</script>

<?= $this->endSection(); ?>