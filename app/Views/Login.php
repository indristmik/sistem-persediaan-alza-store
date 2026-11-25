<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="shortcut icon" type="image/png"
        href="<?= base_url('assets/images/logos/seodashlogo.png') ?>" />

    <link rel="stylesheet"
        href="<?= base_url('assets/css/styles.min.css') ?>" />

    <style>
        body {
            min-height: 100vh;
            background: #f5f7fa;
            font-family: inherit;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-width: 170px;
            max-height: 65px;
            object-fit: contain;
        }

        .login-title {
            text-align: center;
            margin-bottom: 8px;
            font-size: 24px;
            font-weight: 700;
            color: #2a3547;
        }

        .login-subtitle {
            text-align: center;
            color: #7c8fac;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #2a3547;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 7px;
            border-color: #dfe5ef;
        }

        .form-control:focus {
            border-color: #5d87ff;
            box-shadow: 0 0 0 0.15rem rgba(93, 135, 255, 0.12);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #7c8fac;
            cursor: pointer;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 7px;
            font-weight: 600;
            margin-top: 12px;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #7c8fac;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Logo -->
            <!-- <div class="login-logo">
                <img src="<= base_url('assets/images/logos/logo-light.svg') ?>"
                    alt="Logo">
            </div> -->

            <!-- Heading -->
            <h4 class="login-title">Selamat Datang Alza Store</h4>

            <p class="login-subtitle">
                Silakan login untuk mengakses halaman Owner
            </p>

            <!-- Pesan Error -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= site_url('Login') ?>" method="POST">

                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="username" class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        value="<?= old('username') ?>"
                        required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="password-wrapper">
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required>

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword()">

                            <i class="ti ti-eye fs-5" id="eyeIcon"></i>

                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="remember"
                            name="remember">

                        <label class="form-check-label text-muted"
                            for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    Login
                </button>

            </form>

            <div class="login-footer">
                &copy; <?= date('Y') ?> Alza Store.
                All rights reserved.
            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('ti-eye');
                icon.classList.add('ti-eye-off');
            } else {
                password.type = 'password';
                icon.classList.remove('ti-eye-off');
                icon.classList.add('ti-eye');
            }
        }
    </script>

</body>

</html>