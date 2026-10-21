<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventory Sales</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 950px;
            min-height: 560px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(65, 35, 35, 0.08);
        }

        .login-brand {
            background: #54232b;
            color: white;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            background: #b99556;
            color: #54232b;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .brand-subtitle {
            color: #e3d1ca;
            font-size: 12px;
            margin-top: 4px;
        }

        .brand-content {
            margin: 45px 0;
        }

        .brand-label {
            color: #d9b978;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .brand-content h2 {
            font-family: Georgia, serif;
            font-size: 34px;
            line-height: 1.3;
            font-weight: normal;
            margin: 0 0 18px;
        }

        .brand-content p {
            color: #e3d1ca;
            font-size: 14px;
            line-height: 1.8;
            margin: 0;
        }

        .brand-footer {
            color: #d9c2bb;
            font-size: 12px;
        }

        .login-form-section {
            padding: 48px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 30px;
        }

        .eyebrow {
            color: #a17b40;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .form-heading h1 {
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: normal;
            margin: 0 0 10px;
            color: #302526;
        }

        .form-heading p {
            color: #8a7d79;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .alert-error {
            color: #842029;
            background: #f8d7da;
            border: 1px solid #f1bfc4;
        }

        .alert-success {
            color: #245b36;
            background: #dff2e4;
            border: 1px solid #b9e1c4;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
            color: #49383a;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #e3d8ce;
            border-radius: 8px;
            background: #fffefa;
            color: #302526;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            border-color: #9b6d45;
            box-shadow: 0 0 0 3px rgba(185, 149, 86, 0.15);
        }

        .form-group input::placeholder {
            color: #b0a49d;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 24px;
            font-size: 12px;
            color: #766966;
        }

        .remember-row input {
            accent-color: #6b3039;
            width: 15px;
            height: 15px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #6b3039;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #54232b;
        }

        .form-note {
            text-align: center;
            font-size: 11px;
            color: #9a8b84;
            margin-top: 24px;
            line-height: 1.6;
        }

        .field-error {
            color: #b42332;
            font-size: 12px;
            margin-top: 7px;
        }

        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .login-wrapper {
                max-width: 430px;
                min-height: auto;
                grid-template-columns: 1fr;
            }

            .login-brand {
                padding: 25px;
            }

            .brand-content {
                margin: 28px 0 18px;
            }

            .brand-content h2 {
                font-size: 27px;
            }

            .brand-content p {
                font-size: 13px;
            }

            .brand-footer {
                display: none;
            }

            .login-form-section {
                padding: 30px 25px;
            }

            .form-heading h1 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        <div class="login-brand">
            <div class="brand-header">
                <div class="brand-icon">I</div>

                <div>
                    <h2 class="brand-name">Inventory Sales</h2>
                    <div class="brand-subtitle">Management System</div>
                </div>
            </div>

            <div class="brand-content">
                <div class="brand-label">Sistem Informasi</div>

                <h2>Kelola Persediaan dan Penjualan dengan Lebih Mudah.</h2>

                <p>
                    Satu tempat untuk mengelola produk, kategori, pemasok,
                    serta transaksi penjualan secara lebih teratur.
                </p>
            </div>

            <div class="brand-footer">
                Inventory Sales Management System
            </div>
        </div>

        <div class="login-form-section">
            <div class="form-heading">
                <div class="eyebrow">Selamat Datang</div>
                <h1>Login Akun</h1>
                <p>Masukkan email dan kata sandi untuk melanjutkan.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    Email atau kata sandi tidak sesuai. Silakan periksa kembali.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                        autofocus
                        autocomplete="username"
                    >

                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan kata sandi"
                        required
                        autocomplete="current-password"
                    >

                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                    >
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="form-note">
                Pastikan email dan kata sandi yang dimasukkan sudah benar.
            </div>
        </div>

    </div>
</body>
</html>