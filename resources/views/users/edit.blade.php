<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            padding: 28px 18px;
            background: #54232b;
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 36px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #b99556;
            color: #54232b;
            font-weight: bold;
            font-size: 20px;
        }

        .brand h2 { margin: 0; font-size: 17px; }
        .brand small { color: #d9c5c1; font-size: 11px; }

        .nav-title {
            margin: 24px 10px 10px;
            color: #c6a9a7;
            font-size: 10px;
            letter-spacing: 1.5px;
        }

        .sidebar a {
            display: flex;
            gap: 12px;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 9px;
            color: #f2e8e5;
            text-decoration: none;
            font-size: 13px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #78404a;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .logout {
            position: absolute;
            right: 18px;
            bottom: 22px;
            left: 18px;
        }

        .logout button {
            width: 100%;
            padding: 11px;
            border: 1px solid #80525a;
            border-radius: 9px;
            background: transparent;
            color: white;
            cursor: pointer;
            font-size: 12px;
        }

        .main {
            max-width: 1600px;
            margin-left: 225px;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: #9b7a48;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 6px 0;
            font-family: Georgia, serif;
            font-size: 29px;
            font-weight: normal;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 11px 15px;
            border: 0;
            border-radius: 8px;
            background: #6b3039;
            color: white;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
        }

        .button:hover { background: #54232b; }

        .button-light {
            display: inline-block;
            padding: 11px 14px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: #f7f0e7;
            color: #54232b;
            text-decoration: none;
            text-align: center;
            font-size: 12px;
            cursor: pointer;
        }

        .form-panel {
            max-width: 850px;
            padding: 25px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .form-heading {
            margin: 0 0 7px;
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
            color: #54232b;
        }

        .form-description {
            margin: 0 0 24px;
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            min-width: 0;
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #6d5552;
            font-size: 12px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            min-width: 0;
            padding: 11px 12px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font-family: inherit;
            font-size: 12px;
        }

        input:focus,
        select:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        input:disabled {
            background: #f5eee5;
            color: #8a7d79;
            cursor: not-allowed;
        }

        .help-text {
            margin-top: 7px;
            color: #8a7d79;
            font-size: 11px;
            line-height: 1.6;
        }

        .field-error {
            margin-top: 6px;
            color: #a13f38;
            font-size: 11px;
        }

        .notice {
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 9px;
            background: #f9e6e3;
            color: #a13f38;
            font-size: 12px;
        }

        .notice ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid #f0e8df;
        }

        @media (max-width: 950px) {
            .sidebar { width: 190px; }

            .main {
                margin-left: 190px;
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar .nav-title { margin-top: 15px; }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-panel { padding: 20px; }

            .form-grid { grid-template-columns: 1fr; }

            .form-group.full { grid-column: auto; }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">R</div>
            <div>
                <h2>Ranitha Stuff</h2>
                <small>Skincare &amp; Beauty Store</small>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('admin.dashboard') }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}">
            <span class="nav-icon">▦</span> Data Produk
        </a>

        <a href="{{ route('categories.index') }}">
            <span class="nav-icon">▤</span> Kategori
        </a>

        <a href="{{ route('suppliers.index') }}">
            <span class="nav-icon">♙</span> Pemasok
        </a>

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}">
            <span class="nav-icon">↓</span> Pembelian
        </a>

        <a href="{{ route('sales.index') }}">
            <span class="nav-icon">↑</span> Penjualan
        </a>

        <div class="nav-title">LAINNYA</div>

        <a href="{{ route('users.index') }}" class="active">
            <span class="nav-icon">♧</span> Pengguna
        </a>

        <a href="{{ route('reports.index') }}">
            <span class="nav-icon">▥</span> Laporan
        </a>

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Edit Pengguna</h1>
                <div class="muted">
                    Perbarui informasi akun pengguna Ranitha Stuff.
                </div>
            </div>

            <a href="{{ route('users.index') }}" class="button-light">
                ← Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="notice">
                <strong>Data belum berhasil disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="form-panel">
            <h2 class="form-heading">Informasi Pengguna</h2>
            <p class="form-description">
                Ubah informasi pengguna yang diperlukan. Kosongkan bagian
                password jika kamu tidak ingin menggantinya.
            </p>

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Masukkan nama lengkap"
                            maxlength="255"
                            autocomplete="name"
                            required
                        >

                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="contoh@email.com"
                            maxlength="255"
                            autocomplete="email"
                            required
                        >

                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="role">Role Pengguna</label>

                        @if ($user->id === auth()->id())
                            <input
                                type="text"
                                value="{{ ucfirst($user->role) }}"
                                disabled
                            >

                            <input
                                type="hidden"
                                name="role"
                                value="{{ old('role', $user->role) }}"
                            >

                            <div class="help-text">
                                Role akun yang sedang kamu gunakan tidak dapat
                                diubah dari halaman ini.
                            </div>
                        @else
                            <select id="role" name="role" required>
                                <option value="">Pilih role pengguna</option>

                                <option
                                    value="admin"
                                    @selected(old('role', $user->role) === 'admin')
                                >
                                    Admin
                                </option>

                                <option
                                    value="staff"
                                    @selected(old('role', $user->role) === 'staff')
                                >
                                    Staff
                                </option>

                                <option
                                    value="user"
                                    @selected(old('role', $user->role) === 'user')
                                >
                                    User (Pembeli)
                                </option>
                            </select>

                            <div class="help-text">
                                Admin mengelola sistem, Staff menangani
                                operasional, dan User merupakan pengguna
                                atau pembeli.
                            </div>
                        @endif

                        @error('role')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Kosongkan jika tidak diganti"
                            minlength="8"
                            autocomplete="new-password"
                        >

                        <div class="help-text">
                            Isi jika ingin mengganti password. Minimal 8 karakter.
                        </div>

                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            Konfirmasi Password Baru
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            minlength="8"
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('users.index') }}" class="button-light">
                        Batal
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>