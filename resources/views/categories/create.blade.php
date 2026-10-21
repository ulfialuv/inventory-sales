<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori | Inventory Sales</title>

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
            font-size: 20px;
            font-weight: bold;
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
        .sidebar a.active { background: #78404a; }

        .nav-icon { width: 20px; text-align: center; }

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

        .topbar { margin-bottom: 25px; }

        .eyebrow {
            color: #9b7a48;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 6px 0;
            color: #302526;
            font-family: Georgia, serif;
            font-size: 29px;
            font-weight: normal;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.8;
        }

        .button {
            display: inline-block;
            padding: 11px 15px;
            border: 0;
            border-radius: 8px;
            background: #6b3039;
            color: white;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .button:hover { background: #54232b; }

        .button-light {
            display: inline-block;
            padding: 11px 15px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: #f7f0e7;
            color: #54232b;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            text-align: center;
            cursor: pointer;
        }

        .form-panel {
            max-width: 850px;
            padding: 25px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .panel-heading {
            margin-bottom: 22px;
            padding-bottom: 17px;
            border-bottom: 1px solid #f0e8df;
        }

        .panel-heading h3 {
            margin: 0 0 7px;
            color: #54232b;
            font-family: Georgia, serif;
            font-size: 20px;
            font-weight: normal;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
            margin-bottom: 22px;
        }

        label {
            color: #54232b;
            font-size: 12px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font-family: inherit;
            font-size: 13px;
        }

        input:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        .help-text {
            color: #8a7d79;
            font-size: 11px;
        }

        .error {
            color: #a13f38;
            font-size: 12px;
        }

        .alert {
            padding: 13px 16px;
            margin-bottom: 18px;
            border: 1px solid #f0d0cc;
            border-radius: 9px;
            background: #fff0ef;
            color: #a13f38;
            font-size: 13px;
        }

        .alert ul {
            margin: 8px 0 0 20px;
            line-height: 1.8;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 27px;
            padding-top: 20px;
            border-top: 1px solid #f0e8df;
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar .nav-title { margin-top: 15px; }
            .logout { position: static; margin-top: 15px; }
            .main { margin-left: 0; padding: 20px; }
        }

        @media (max-width: 500px) {
            .main { padding: 15px; }
            h1 { font-size: 25px; }
            .form-panel { padding: 17px; }
            .actions { flex-direction: column-reverse; }
            .actions .button,
            .actions .button-light { text-align: center; }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <h2>Inventory Sales</h2>
                <small>Management System</small>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('admin.dashboard') }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}">
            <span class="nav-icon">▦</span> Data Produk
        </a>

        <a href="{{ route('categories.index') }}" class="active">
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

        <a href="{{ route('users.index') }}">
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
            <div class="eyebrow">Manajemen Inventory</div>
            <h1>Tambah Kategori</h1>
            <div class="muted">
                Tambahkan kategori baru agar produk lebih mudah dikelompokkan.
            </div>
        </div>

        @if ($errors->any())
            <div class="alert">
                <strong>Kategori belum berhasil disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="form-panel">
            <div class="panel-heading">
                <h3>Informasi Kategori</h3>
                <div class="muted">
                    Isi nama kategori yang ingin ditambahkan ke inventory.
                </div>
            </div>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Kategori <span style="color:#a13f38;">*</span></label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Elektronik"
                        maxlength="255"
                        required
                        autofocus
                    >

                    <span class="help-text">
                        Gunakan nama yang singkat dan mudah dikenali.
                    </span>

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="actions">
                    <a href="{{ route('categories.index') }}" class="button-light">
                        Batal
                    </a>

                    <button type="submit" class="button">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>