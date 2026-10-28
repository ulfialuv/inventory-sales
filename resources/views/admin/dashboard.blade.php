<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        :root {
            --maroon: #54232b;
            --maroon-light: #78404a;
            --maroon-dark: #3d1820;
            --gold: #b99556;
            --gold-light: #f1e6d7;
            --background: #f7f3ed;
            --white: #fffdf9;
            --text: #302526;
            --muted: #8a7d79;
            --border: #ece2d7;
        }

        /* SIDEBAR - SAMA DENGAN DATA KATEGORI */

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
            flex-shrink: 0;
        }

        .brand h2 {
            margin: 0;
            font-size: 17px;
        }

        .brand small {
            color: #d9c5c1;
            font-size: 11px;
        }

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
            flex-shrink: 0;
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
        }

        /* KONTEN UTAMA */

        .main {
            max-width: 1600px;
            margin-left: 225px;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .eyebrow {
            color: #9b7a48;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 7px 0;
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: normal;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.7;
        }

        .admin-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 13px;
            border: 1px solid #ece2d7;
            border-radius: 12px;
            background: #fffdf9;
        }

        .avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #f1e6d7;
            color: #54232b;
            font-weight: bold;
        }

        .admin-chip strong {
            display: block;
            font-size: 12px;
        }

        .admin-chip small {
            color: #8a7d79;
            font-size: 11px;
        }

        /* SAMBUTAN */

        .welcome {
            position: relative;
            overflow: hidden;
            padding: 28px;
            margin-bottom: 27px;
            border-radius: 16px;
            background: linear-gradient(
                120deg,
                #3d1820,
                #783b45
            );
            color: white;
        }

        .welcome::after {
            position: absolute;
            top: -60px;
            right: -25px;
            width: 230px;
            height: 230px;
            border: 35px solid rgba(185, 149, 86, .15);
            border-radius: 50%;
            content: "";
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
        }

        .welcome-label {
            margin-bottom: 10px;
            color: #d9bd86;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .welcome h2 {
            margin: 0 0 10px;
            font-family: Georgia, serif;
            font-size: 27px;
            font-weight: normal;
        }

        .welcome p {
            max-width: 560px;
            margin: 0;
            color: #ead9d5;
            font-size: 13px;
            line-height: 1.8;
        }

        /* JUDUL BAGIAN */

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 28px 0 15px;
        }

        .section-heading h2 {
            margin: 0;
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
        }

        .section-heading p {
            margin: 5px 0 0;
            color: #8a7d79;
            font-size: 12px;
        }

        /* KARTU STATISTIK */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            display: block;
            min-width: 0;
            padding: 20px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(84, 35, 43, .07);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 19px;
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 12px;
            background: #f1e6d7;
            color: #54232b;
            font-size: 20px;
        }

        .stat-tag {
            padding: 6px 9px;
            border-radius: 20px;
            background: #f6eee3;
            color: #8b6a37;
            font-size: 10px;
        }

        .stat-label {
            margin-bottom: 8px;
            color: #8a7d79;
            font-size: 12px;
        }

        .stat-value {
            overflow-wrap: anywhere;
            color: #54232b;
            font-family: Georgia, serif;
            font-size: 29px;
            font-weight: normal;
        }

        .stat-footer {
            margin-top: 10px;
            color: #9a8d86;
            font-size: 11px;
        }

        /* RINGKASAN */

        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            margin-top: 24px;
        }

        .panel {
            min-width: 0;
            padding: 22px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-heading h3 {
            margin: 0;
            font-size: 15px;
        }

        .panel-icon {
            color: #b99556;
            font-size: 20px;
        }

        .amount-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 0;
            border-bottom: 1px solid #f0e8df;
        }

        .amount-row:last-child {
            border-bottom: none;
        }

        .amount-label {
            color: #756765;
            font-size: 12px;
        }

        .amount-value {
            color: #54232b;
            font-size: 13px;
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        /* PERINGATAN STOK */

        .stock-warning {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 16px;
            border: 1px solid #f0dfbb;
            border-radius: 10px;
            background: #fff8e9;
        }

        .warning-icon {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #f3e2b9;
            color: #795b2d;
            font-size: 18px;
        }

        .stock-warning strong {
            display: block;
            margin-bottom: 5px;
            color: #795b2d;
            font-size: 13px;
        }

        .stock-warning p {
            margin: 0;
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.7;
        }

        .stock-link {
            display: inline-block;
            margin-top: 16px;
            color: #795b2d;
            font-size: 12px;
            font-weight: 600;
        }

        /* AKSES CEPAT */

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-top: 17px;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            padding: 16px;
            border: 1px solid #ece2d7;
            border-radius: 11px;
            background: #fffdf9;
            color: #302526;
            transition: .2s;
        }

        .quick-link:hover {
            border-color: #b99556;
            background: #fffaf2;
        }

        .quick-icon {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #f1e6d7;
            color: #54232b;
            font-size: 18px;
        }

        .quick-link strong {
            display: block;
            margin-bottom: 4px;
            color: #54232b;
            font-size: 12px;
        }

        .quick-link small {
            color: #8a7d79;
            font-size: 10px;
        }

        .footer {
            padding: 25px 0 5px;
            color: #9a8d86;
            text-align: center;
            font-size: 11px;
        }

        /* RESPONSIVE - MENGIKUTI DATA KATEGORI */

        @media (max-width: 1150px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar .nav-title {
                margin-top: 15px;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-value {
                font-size: 23px;
            }

            .stat-tag {
                display: none;
            }

            .quick-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .quick-link {
                align-items: flex-start;
                flex-direction: column;
                padding: 13px;
            }

            .welcome {
                padding: 22px;
            }

            .welcome h2 {
                font-size: 23px;
            }

            h1 {
                font-size: 26px;
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

        <a href="{{ route('admin.dashboard') }}" class="active">
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

        <header class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Dashboard</h1>
                <div class="muted">
                    Ringkasan aktivitas toko dan kondisi persediaan produk.
                </div>
            </div>

            <div class="admin-chip">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                    <small>Administrator · {{ now()->format('d M Y') }}</small>
                </div>
            </div>
        </header>

        <section class="welcome">
            <div class="welcome-content">
                <div class="welcome-label">Selamat datang kembali</div>
                <h2>Halo, {{ auth()->user()->name ?? 'Admin' }}!</h2>
                <p>
                    Selamat datang di Ranitha Stuff. Pantau data produk
                    skincare dan kecantikan, kategori, pemasok, pembelian,
                    serta penjualan melalui satu halaman dashboard.
                </p>
            </div>
        </section>

        <div class="section-heading">
            <div>
                <h2>Ringkasan Data</h2>
                <p>Informasi terbaru dari sistem persediaan toko.</p>
            </div>
        </div>

        <section class="stats-grid">

            <a href="{{ route('products.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">▦</div>
                    <span class="stat-tag">Inventaris</span>
                </div>
                <div class="stat-label">Total Produk</div>
                <div class="stat-value">
                    {{ number_format($totalProducts ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Lihat data produk →</div>
            </a>

            <a href="{{ route('categories.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">▤</div>
                    <span class="stat-tag">Klasifikasi</span>
                </div>
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value">
                    {{ number_format($totalCategories ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Lihat kategori →</div>
            </a>

            <a href="{{ route('suppliers.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">♙</div>
                    <span class="stat-tag">Mitra</span>
                </div>
                <div class="stat-label">Total Pemasok</div>
                <div class="stat-value">
                    {{ number_format($totalSuppliers ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Lihat pemasok →</div>
            </a>

            <a href="{{ route('purchases.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">↓</div>
                    <span class="stat-tag">Stok Masuk</span>
                </div>
                <div class="stat-label">Transaksi Pembelian</div>
                <div class="stat-value">
                    {{ number_format($totalPurchases ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Lihat pembelian →</div>
            </a>

            <a href="{{ route('sales.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">↑</div>
                    <span class="stat-tag">Stok Keluar</span>
                </div>
                <div class="stat-label">Transaksi Penjualan</div>
                <div class="stat-value">
                    {{ number_format($totalSales ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Lihat penjualan →</div>
            </a>

            <a href="{{ route('users.index') }}" class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon">♧</div>
                    <span class="stat-tag">Akun</span>
                </div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-value">
                    {{ number_format(isset($users) ? (is_object($users) && method_exists($users, 'total') ? $users->total() : (is_countable($users) ? count($users) : 0)) : 0, 0, ',', '.') }}
                </div>
                <div class="stat-footer">Kelola pengguna →</div>
            </a>

        </section>

        <div class="section-heading">
            <div>
                <h2>Ringkasan Keuangan</h2>
                <p>Total nominal transaksi yang tercatat dalam sistem.</p>
            </div>
        </div>

        <section class="summary-grid">

            <div class="panel">
                <div class="panel-heading">
                    <h3>Ringkasan Pembelian dan Penjualan</h3>
                    <span class="panel-icon">◈</span>
                </div>

                <div class="amount-row">
                    <div class="amount-label">Total Nominal Pembelian</div>
                    <div class="amount-value">
                        Rp {{ number_format($totalPurchaseAmount ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <div class="amount-row">
                    <div class="amount-label">Total Nominal Penjualan</div>
                    <div class="amount-value">
                        Rp {{ number_format($totalSalesAmount ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h3>Peringatan Persediaan</h3>
                    <span class="panel-icon">!</span>
                </div>

                <div class="stock-warning">
                    <div class="warning-icon">⚠</div>
                    <div>
                        <strong>
                            {{ number_format($lowStockProducts ?? 0, 0, ',', '.') }}
                            produk perlu diperiksa
                        </strong>
                        <p>
                            Jumlah produk yang stoknya kurang dari atau sama
                            dengan batas stok minimum. Periksa data produk
                            untuk menentukan kebutuhan pengadaan.
                        </p>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="stock-link">
                    Periksa data produk →
                </a>
            </div>

        </section>

        <div class="section-heading">
            <div>
                <h2>Akses Cepat</h2>
                <p>Pilih menu untuk mengelola data toko.</p>
            </div>
        </div>

        <section class="quick-grid">

            <a href="{{ route('products.index') }}" class="quick-link">
                <div class="quick-icon">▦</div>
                <div>
                    <strong>Data Produk</strong>
                    <small>Kelola persediaan</small>
                </div>
            </a>

            <a href="{{ route('categories.index') }}" class="quick-link">
                <div class="quick-icon">▤</div>
                <div>
                    <strong>Kategori</strong>
                    <small>Kelola kategori</small>
                </div>
            </a>

            <a href="{{ route('suppliers.index') }}" class="quick-link">
                <div class="quick-icon">♙</div>
                <div>
                    <strong>Pemasok</strong>
                    <small>Kelola pemasok</small>
                </div>
            </a>

            <a href="{{ route('reports.index') }}" class="quick-link">
                <div class="quick-icon">▥</div>
                <div>
                    <strong>Laporan</strong>
                    <small>Lihat laporan</small>
                </div>
            </a>

        </section>

        <footer class="footer">
            Ranitha Stuff &copy; {{ date('Y') }}
        </footer>

    </main>

</body>
</html>