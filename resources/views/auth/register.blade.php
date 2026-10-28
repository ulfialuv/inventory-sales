<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Ranitha Stuff</title>

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

        .register-wrapper {
            width: 100%;
            max-width: 950px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(65, 35, 35, 0.08);
        }

        .register-brand {
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
            font-family: Georgia, serif;
            font-size: 25px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 22px;
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

        .register-form-section {
            padding: 40px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 25px;
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

        .alert-error {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            line-height: 1.5;
            color: #842029;
            background: #f8d7da;
            border: 1px solid #f1bfc4;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #49383a;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
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

        .field-error {
            color: #b42332;
            font-size: 12px;
            margin-top: 7px;
        }

        .btn-register {
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
            margin-top: 4px;
        }

        .btn-register:hover {
            background: #54232b;
        }

        .login-note {
            text-align: center;
            font-size: 13px;
            color: #766966;
            margin-top: 20px;
        }

        .login-note a {
            color: #6b3039;
            font-weight: 700;
            text-decoration: none;
        }

        .login-note a:hover {
            color: #a17b40;
            text-decoration: underline;
        }

        .form-note {
            text-align: center;
            font-size: 11px;
            color: #9a8b84;
            margin-top: 18px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .register-wrapper {
                max-width: 430px;
                grid-template-columns: 1fr;
            }

            .register-brand {
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

            .register-form-section {
                padding: 30px 25px;
            }

            .form-heading h1 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>
    <div class="register-wrapper">

        <div class="register-brand">
            <div class="brand-header">
                <div class="brand-icon">R</div>

                <div>
                    <h2 class="brand-name">Ranitha Stuff</h2>
                    <div class="brand-subtitle">Skincare & Beauty Store</div>
                </div>
            </div>

            <div class="brand-content">
                <div class="brand-label">Join Ranitha Stuff</div>

                <h2>Mulai Perjalanan Cantikmu.</h2>

                <p>
                    Buat akun Ranitha Stuff untuk melanjutkan perjalanan
                    perawatan kulitmu. Daftar dengan data yang benar agar
                    kamu bisa masuk dan menggunakan akunmu.
                </p>
            </div>

            <div class="brand-footer">
                Ranitha Stuff &copy; {{ date('Y') }} · Skincare & Beauty Store
            </div>
        </div>

        <div class="register-form-section">
            <div class="form-heading">
                <div class="eyebrow">Bergabung Bersama Kami</div>
                <h1>Daftar Akun</h1>
                <p>Isi data berikut untuk membuat akun baru.</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Pendaftaran belum berhasil.</strong>
                    <div>Periksa kembali data yang kamu masukkan.</div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        maxlength="255"
                        required
                        autofocus
                        autocomplete="name"
                    >

                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email"
                        maxlength="255"
                        required
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
                        placeholder="Buat kata sandi"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Masukkan ulang kata sandi"
                        required
                        autocomplete="new-password"
                    >

                    @error('password_confirmation')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-register">
                    Daftar Sekarang
                </button>
            </form>

            <div class="login-note">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </div>

            <div class="form-note">
                Pastikan data yang dimasukkan sudah benar sebelum mendaftar.
            </div>
        </div>

    </div>
</body>
</html>