<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemasok | Ranitha Stuff</title>

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
            overflow-y: auto;
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
            flex-shrink: 0;
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

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
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
            white-space: nowrap;
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
            text-align: center;
            font-family: inherit;
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

        .panel-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            padding-bottom: 19px;
            border-bottom: 1px solid #f0e8df;
        }

        .icon-box {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 11px;
            background: #f1e6d7;
            color: #79404a;
            font-size: 21px;
        }

        .panel-heading h3 {
            margin: 0 0 6px;
            color: #54232b;
            font-family: Georgia, serif;
            font-size: 20px;
            font-weight: normal;
        }

        .form-group { margin-bottom: 22px; }

        label {
            display: block;
            margin-bottom: 9px;
            color: #49373a;
            font-size: 12px;
            font-weight: 600;
        }

        .required { color: #a13f38; }

        input, textarea {
            display: block;
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font-family: inherit;
            font-size: 13px;
        }

        input:focus, textarea:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .hint {
            margin-top: 7px;
            color: #8a7d79;
            font-size: 11px;
        }

        .error {
            display: block;
            margin-top: 7px;
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
            font-size: 12px;
        }

        .alert ul {
            margin: 8px 0 0 18px;
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
                padding-bottom: 20px;
            }

            .sidebar .nav-title { margin-top: 15px; }
            .logout { position: static; margin-top: 15px; }
            .main { margin-left: 0; padding: 20px; }
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .main { padding: 15px; }
            h1 { font-size: 25px; }
            .form-panel { padding: 17px; }

            .actions { flex-direction: column-reverse; }

            .actions .button,
            .actions .button-light {
                width: 100%;
                text-align: center;
            }
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

        <a href="{{ route('suppliers.index') }}" class="active">
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
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Edit Pemasok</h1>
                <div class="muted">
                    Perbarui informasi pemasok produk skincare dan beauty.
                </div>
            </div>

            <a href="{{ route('suppliers.index') }}" class="button-light">
                ← Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert" style="background:#e8f4e8;color:#286338;border-color:#cfe5cf;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert">
                <strong>Data pemasok belum berhasil diperbarui.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="form-panel">
            <div class="panel-heading">
                <div class="icon-box">✎</div>
                <div>
                    <h3>Perbarui Informasi Pemasok</h3>
                    <div class="muted">
                        Pastikan informasi yang diubah sudah benar.
                    </div>
                </div>
            </div>

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">
                        Nama Pemasok <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $supplier->name) }}"
                        placeholder="Masukkan nama pemasok"
                        maxlength="255"
                        required
                        autofocus
                    >
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
                        placeholder="Contoh: 081234567890"
                    >
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
                        placeholder="Contoh: pemasok@email.com"
                    >
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea
                        id="address"
                        name="address"
                        placeholder="Masukkan alamat lengkap pemasok"
                    >{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="actions">
                    <a href="{{ route('suppliers.index') }}" class="button-light">
                        Batal
                    </a>

                    <button type="submit" class="button">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>