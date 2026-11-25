<?= $this->extend('TemplateOwner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- ================= HEADER ================= -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Manajemen User</h4>
            <p class="text-muted mb-0">
                Kelola akun Owner dan Admin Alza Store.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light-primary text-primary fs-3 px-3 py-2">
                <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                    class="me-1"></iconify-icon>
                Data Pengguna
            </span>
        </div>
    </div>

    <!-- ================= STATISTIK ================= -->
    <div class="row">

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total User</p>
                            <h4 class="fw-semibold mb-0" id="totalUser">8</h4>
                            <small class="text-muted">Seluruh akun</small>
                        </div>
                        <div class="bg-light-primary rounded-3 p-3">
                            <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                                class="fs-8 text-primary"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">User Owner</p>
                            <h4 class="fw-semibold mb-0" id="totalOwner">1</h4>
                            <small class="text-muted">Pemilik sistem</small>
                        </div>
                        <div class="bg-light-warning rounded-3 p-3">
                            <iconify-icon icon="solar:shield-user-bold-duotone"
                                class="fs-8 text-warning"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">User Admin</p>
                            <h4 class="fw-semibold mb-0" id="totalAdmin">7</h4>
                            <small class="text-muted">Pengelola transaksi</small>
                        </div>
                        <div class="bg-light-success rounded-3 p-3">
                            <iconify-icon icon="solar:user-bold-duotone"
                                class="fs-8 text-success"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">User Aktif</p>
                            <h4 class="fw-semibold mb-0" id="totalAktif">7</h4>
                            <small class="text-muted">Akun aktif</small>
                        </div>
                        <div class="bg-light-info rounded-3 p-3">
                            <iconify-icon icon="solar:user-check-bold-duotone"
                                class="fs-8 text-info"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTER ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mb-3">
                        Filter Pengguna
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Cari User</label>
                            <input type="text" class="form-control"
                                id="searchUser"
                                placeholder="Nama, username, email...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" id="filterRole">
                                <option value="">Semua Role</option>
                                <option value="Owner">Owner</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-primary w-100"
                                onclick="resetFilterUser()">
                                <iconify-icon icon="solar:restart-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Reset
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= TABEL USER ================= -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Daftar Pengguna
                            </h5>
                            <p class="text-muted mb-0 fs-3">
                                Informasi akun yang terdaftar pada sistem
                            </p>
                        </div>

                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-primary"
                                onclick="bukaTambahUser()">
                                <iconify-icon icon="solar:user-plus-bold-duotone"
                                    class="me-1"></iconify-icon>
                                Tambah User
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-nowrap mb-0"
                            id="tableUser">

                            <thead>
                                <tr>
                                    <th class="ps-0">No</th>
                                    <th>Pengguna</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Terdaftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr data-role="Owner" data-status="Aktif">
                                    <td class="ps-0">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center me-3"
                                                style="width:40px;height:40px;">
                                                <iconify-icon icon="solar:shield-user-bold-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">Owner Alza</h6>
                                                <small class="text-muted">Pemilik</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>owner</td>
                                    <td>owner@alzastore.com</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">Owner</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Aktif</span>
                                    </td>
                                    <td>01 Nov 2026</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-light-primary"
                                                title="Detail"
                                                onclick="detailUser(this)"
                                                data-nama="Owner Alza"
                                                data-username="owner"
                                                data-email="owner@alzastore.com"
                                                data-role="Owner"
                                                data-status="Aktif"
                                                data-tanggal="01 November 2026">
                                                <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-warning"
                                                title="Edit"
                                                onclick="editUser(this)"
                                                data-nama="Owner Alza"
                                                data-username="owner"
                                                data-email="owner@alzastore.com"
                                                data-role="Owner"
                                                data-status="Aktif">
                                                <iconify-icon icon="solar:pen-bold-duotone"></iconify-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr data-role="Admin" data-status="Aktif">
                                    <td class="ps-0">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light-success text-success d-flex align-items-center justify-content-center me-3"
                                                style="width:40px;height:40px;">
                                                <iconify-icon icon="solar:user-bold-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">Admin 01</h6>
                                                <small class="text-muted">Administrator</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>admin01</td>
                                    <td>admin01@alzastore.com</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Admin</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Aktif</span>
                                    </td>
                                    <td>03 Nov 2026</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-light-primary"
                                                title="Detail"
                                                onclick="detailUser(this)"
                                                data-nama="Admin 01"
                                                data-username="admin01"
                                                data-email="admin01@alzastore.com"
                                                data-role="Admin"
                                                data-status="Aktif"
                                                data-tanggal="03 November 2026">
                                                <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-warning"
                                                title="Edit"
                                                onclick="editUser(this)"
                                                data-nama="Admin 01"
                                                data-username="admin01"
                                                data-email="admin01@alzastore.com"
                                                data-role="Admin"
                                                data-status="Aktif">
                                                <iconify-icon icon="solar:pen-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-danger"
                                                title="Hapus"
                                                onclick="hapusUser(this)">
                                                <iconify-icon icon="solar:trash-bin-trash-bold-duotone"></iconify-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr data-role="Admin" data-status="Aktif">
                                    <td class="ps-0">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light-info text-info d-flex align-items-center justify-content-center me-3"
                                                style="width:40px;height:40px;">
                                                <iconify-icon icon="solar:user-bold-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">Admin 02</h6>
                                                <small class="text-muted">Administrator</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>admin02</td>
                                    <td>admin02@alzastore.com</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Admin</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Aktif</span>
                                    </td>
                                    <td>05 Nov 2026</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-light-primary"
                                                title="Detail"
                                                onclick="detailUser(this)"
                                                data-nama="Admin 02"
                                                data-username="admin02"
                                                data-email="admin02@alzastore.com"
                                                data-role="Admin"
                                                data-status="Aktif"
                                                data-tanggal="05 November 2026">
                                                <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-warning"
                                                title="Edit"
                                                onclick="editUser(this)"
                                                data-nama="Admin 02"
                                                data-username="admin02"
                                                data-email="admin02@alzastore.com"
                                                data-role="Admin"
                                                data-status="Aktif">
                                                <iconify-icon icon="solar:pen-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-danger"
                                                title="Hapus"
                                                onclick="hapusUser(this)">
                                                <iconify-icon icon="solar:trash-bin-trash-bold-duotone"></iconify-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr data-role="Admin" data-status="Nonaktif">
                                    <td class="ps-0">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light-secondary text-secondary d-flex align-items-center justify-content-center me-3"
                                                style="width:40px;height:40px;">
                                                <iconify-icon icon="solar:user-bold-duotone"
                                                    class="fs-6"></iconify-icon>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">Admin 03</h6>
                                                <small class="text-muted">Administrator</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>admin03</td>
                                    <td>admin03@alzastore.com</td>
                                    <td>
                                        <span class="badge bg-light-success text-success">Admin</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-secondary text-secondary">Nonaktif</span>
                                    </td>
                                    <td>08 Nov 2026</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-light-primary"
                                                title="Detail"
                                                onclick="detailUser(this)"
                                                data-nama="Admin 03"
                                                data-username="admin03"
                                                data-email="admin03@alzastore.com"
                                                data-role="Admin"
                                                data-status="Nonaktif"
                                                data-tanggal="08 November 2026">
                                                <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-warning"
                                                title="Edit"
                                                onclick="editUser(this)"
                                                data-nama="Admin 03"
                                                data-username="admin03"
                                                data-email="admin03@alzastore.com"
                                                data-role="Admin"
                                                data-status="Nonaktif">
                                                <iconify-icon icon="solar:pen-bold-duotone"></iconify-icon>
                                            </button>
                                            <button class="btn btn-sm btn-light-danger"
                                                title="Hapus"
                                                onclick="hapusUser(this)">
                                                <iconify-icon icon="solar:trash-bin-trash-bold-duotone"></iconify-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- DATA KOSONG -->
                        <div id="dataKosongUser" class="text-center py-5 d-none">
                            <iconify-icon icon="solar:magnifer-bold-duotone"
                                class="fs-8 text-muted"></iconify-icon>
                            <h6 class="mt-2">Data pengguna tidak ditemukan</h6>
                            <p class="text-muted mb-0">
                                Coba ubah kata kunci atau filter pencarian.
                            </p>
                        </div>

                    </div>

                    <!-- ================= PAGINATION ================= -->
                    <div class="d-md-flex align-items-center justify-content-between mt-4">
                        <p class="text-muted mb-2 mb-md-0 fs-3">
                            Menampilkan data pengguna
                        </p>

                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Sebelumnya</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Selanjutnya</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <div class="py-4 text-center">
        <p class="mb-0 fs-3 text-muted">
            Alza Store &copy; <?= date('Y'); ?> - Manajemen User
        </p>
    </div>

</div>

<!-- ================= MODAL TAMBAH / EDIT ================= -->
<div class="modal fade" id="modalUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formUser">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-semibold" id="judulModalUser">
                            Tambah User
                        </h5>
                        <small class="text-muted">
                            Form akun pengguna Alza Store
                        </small>
                    </div>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="userIndex">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control"
                            id="inputNamaUser" required
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control"
                            id="inputUsernameUser" required
                            placeholder="Masukkan username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control"
                            id="inputEmailUser" required
                            placeholder="nama@alzastore.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" id="inputRoleUser" required>
                            <option value="Admin">Admin</option>
                            <option value="Owner">Owner</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="inputStatusUser" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="alert alert-light-primary mb-0">
                        <iconify-icon icon="solar:info-circle-bold-duotone"
                            class="me-1"></iconify-icon>
                        Data ini masih contoh dan belum disimpan ke database.
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <iconify-icon icon="solar:diskette-bold-duotone"
                            class="me-1"></iconify-icon>
                        Simpan Tampilan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="modalDetailUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold">Detail Pengguna</h5>
                    <small class="text-muted" id="detailUsernameUser"></small>
                </div>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Nama Lengkap</span>
                    <span class="fw-semibold" id="detailNamaUser"></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Email</span>
                    <span class="fw-semibold" id="detailEmailUser"></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Role</span>
                    <span id="detailRoleUser"></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Status</span>
                    <span id="detailStatusUser"></span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted">Tanggal Terdaftar</span>
                    <span class="fw-semibold" id="detailTanggalUser"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<script>
    // ================= SEARCH & FILTER =================
    const searchUser = document.getElementById('searchUser');
    const filterRole = document.getElementById('filterRole');
    const filterStatus = document.getElementById('filterStatus');
    const tableUser = document.getElementById('tableUser');
    const dataKosongUser = document.getElementById('dataKosongUser');

    function filterUser() {
        const keyword = searchUser.value.toLowerCase();
        const role = filterRole.value;
        const status = filterStatus.value;

        const rows = tableUser.querySelectorAll('tbody tr');
        let jumlahTampil = 0;

        rows.forEach(row => {
            const cocokKeyword = row.innerText.toLowerCase().includes(keyword);
            const cocokRole = !role || row.dataset.role === role;
            const cocokStatus = !status || row.dataset.status === status;

            const tampil = cocokKeyword && cocokRole && cocokStatus;
            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;
        });

        dataKosongUser.classList.toggle('d-none', jumlahTampil > 0);
    }

    searchUser.addEventListener('input', filterUser);
    filterRole.addEventListener('change', filterUser);
    filterStatus.addEventListener('change', filterUser);

    function resetFilterUser() {
        searchUser.value = '';
        filterRole.value = '';
        filterStatus.value = '';
        filterUser();
    }

    // ================= MODAL USER =================
    const modalUser = new bootstrap.Modal(
        document.getElementById('modalUser')
    );

    function bukaTambahUser() {
        document.getElementById('formUser').reset();
        document.getElementById('userIndex').value = '';
        document.getElementById('judulModalUser').innerText = 'Tambah User';
        modalUser.show();
    }

    function editUser(button) {
        document.getElementById('formUser').reset();
        document.getElementById('userIndex').value = '';
        document.getElementById('judulModalUser').innerText = 'Edit User';

        document.getElementById('inputNamaUser').value = button.dataset.nama;
        document.getElementById('inputUsernameUser').value = button.dataset.username;
        document.getElementById('inputEmailUser').value = button.dataset.email;
        document.getElementById('inputRoleUser').value = button.dataset.role;
        document.getElementById('inputStatusUser').value = button.dataset.status;

        modalUser.show();
    }

    document.getElementById('formUser').addEventListener('submit', function(e) {
        e.preventDefault();

        alert('Tampilan form berhasil disimulasikan. Data belum disimpan ke database.');
        modalUser.hide();
    });

    // ================= DETAIL USER =================
    function detailUser(button) {
        document.getElementById('detailUsernameUser').innerText = button.dataset.username;
        document.getElementById('detailNamaUser').innerText = button.dataset.nama;
        document.getElementById('detailEmailUser').innerText = button.dataset.email;
        document.getElementById('detailRoleUser').innerText = button.dataset.role;
        document.getElementById('detailStatusUser').innerText = button.dataset.status;
        document.getElementById('detailTanggalUser').innerText = button.dataset.tanggal;

        const modal = new bootstrap.Modal(
            document.getElementById('modalDetailUser')
        );
        modal.show();
    }

    // ================= HAPUS USER =================
    function hapusUser(button) {
        const konfirmasi = confirm('Apakah Anda yakin ingin menghapus user ini?');

        if (konfirmasi) {
            alert('Simulasi hapus user. Data belum dihapus dari database.');
        }
    }
</script>

<?= $this->endSection(); ?>