<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

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
            --green: #346441;
            --red: #a33333;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input { font: inherit; }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            padding: 28px 18px;
            background: var(--maroon);
            color: white;
            z-index: 10;
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
            background: var(--gold);
            color: var(--maroon);
            font-size: 20px;
            font-weight: bold;
        }

        .brand h2 { margin: 0; font-size: 17px; }

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
            align-items: center;
            gap: 12px;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 9px;
            color: #f2e8e5;
            font-size: 13px;
            transition: background .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: var(--maroon-light);
        }

        .nav-icon {
            width: 20px;
            flex-shrink: 0;
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
            transition: background .2s;
        }

        .logout button:hover { background: var(--maroon-light); }

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
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 13px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
        }

        .avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--gold-light);
            color: var(--maroon);
            font-weight: bold;
        }

        .user-chip strong {
            display: block;
            font-size: 12px;
        }

        .user-chip small {
            color: var(--muted);
            font-size: 11px;
        }

        /* SAMBUTAN */
        .welcome {
            position: relative;
            overflow: hidden;
            padding: 28px;
            margin-bottom: 27px;
            border-radius: 16px;
            background: linear-gradient(120deg, var(--maroon-dark), #783b45);
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

        /* STATISTIK */
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
            color: var(--muted);
            font-size: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(84, 35, 43, .07);
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 12px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 22px;
        }

        .stat-label {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-value {
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 26px;
        }

        .stat-footer {
            margin-top: 5px;
            color: #9a8d86;
            font-size: 11px;
        }

        /* NOTIFIKASI */
        .alert {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 10px;
            font-size: 13px;
        }

        .alert-success {
            border: 1px solid #c8dfcb;
            background: #edf7ee;
            color: var(--green);
        }

        .alert-error {
            border: 1px solid #e8caca;
            background: #fff0f0;
            color: var(--red);
        }

        .alert ul {
            margin: 7px 0 0;
            padding-left: 20px;
        }

        /* PENCARIAN PRODUK */
        .search-panel {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
        }

        .search-form {
            display: flex;
            flex: 1;
            gap: 10px;
        }

        .search-form input {
            width: 100%;
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            background: #fff;
            font-size: 13px;
        }

        .search-form input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(185, 149, 86, .12);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s;
        }

        .btn-primary {
            background: var(--maroon);
            color: white;
        }

        .btn-primary:hover { background: var(--maroon-light); }

        .btn-gold {
            background: var(--gold-light);
            color: var(--maroon);
        }

        .btn-gold:hover { background: #e9d7bc; }

        .btn:disabled {
            background: #d9d2cb;
            color: #827a74;
            cursor: not-allowed;
        }

        /* KATALOG PRODUK */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            transition: transform .2s, box-shadow .2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(84, 35, 43, .07);
        }

        .product-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .product-icon {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            border-radius: 12px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 22px;
        }

        .stock-badge {
            padding: 6px 9px;
            border-radius: 20px;
            background: #edf7ee;
            color: var(--green);
            font-size: 10px;
        }

        .stock-badge.low {
            background: #fff4df;
            color: #8b6a37;
        }

        .stock-badge.empty {
            background: #fff0f0;
            color: var(--red);
        }

        .product-sku {
            margin-bottom: 7px;
            color: #9b7a48;
            font-size: 10px;
            letter-spacing: .6px;
        }

        .product-name {
            margin: 0 0 10px;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 19px;
            font-weight: normal;
            overflow-wrap: anywhere;
        }

        .product-price {
            margin-bottom: 12px;
            color: var(--maroon);
            font-size: 19px;
            font-weight: 700;
        }

        .product-info {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 11px 0;
            margin-top: auto;
            border-top: 1px solid #f0e8df;
            color: var(--muted);
            font-size: 11px;
        }

        .product-info strong { color: var(--text); }

        .cart-form {
            display: flex;
            gap: 9px;
            margin-top: 14px;
        }

        .quantity {
            width: 70px;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            text-align: center;
        }

        .quantity:focus { border-color: var(--gold); }

        .cart-form .btn { flex: 1; }

        .empty-state {
            padding: 45px 20px;
            border: 1px dashed #d9c8b4;
            border-radius: 13px;
            background: var(--white);
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 12px;
            color: var(--gold);
            font-size: 38px;
        }

        .empty-state h3 {
            margin: 0 0 8px;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
        }

        .empty-state p {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 12px;
        }

        /* PAGINATION */
        .pagination {
            margin-top: 18px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 10px;
            color: #8a7d79;
            font-size: 12px;
        }

        .pagination nav > div:last-child {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #e4d8cc;
            border-radius: 6px;
            color: #54232b;
            text-decoration: none;
            font-size: 12px;
        }

        .pagination [aria-current="page"] span {
            background: #6b3039;
            color: white;
            border-color: #6b3039;
        }

        /* FOOTER */
        .footer {
            padding: 25px 0 5px;
            color: #9a8d86;
            text-align: center;
            font-size: 11px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 550px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid,
            .product-grid {
                grid-template-columns: 1fr;
            }

            .welcome { padding: 22px; }

            .welcome h2 { font-size: 23px; }

            h1 { font-size: 26px; }

            .search-form { flex-direction: column; }

            .search-form .btn { width: 100%; }

            .search-panel { padding: 12px; }
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

        <a href="{{ route('user.dashboard') }}" class="active">
            <span class="nav-icon">⌂</span>
            Beranda
        </a>

        <a href="{{ route('cart.index') }}">
            <span class="nav-icon">🛒</span>
            Keranjang
        </a>

        <a href="{{ route('user.orders') }}">
            <span class="nav-icon">▤</span>
            Pesanan Saya
        </a>

        <div class="nav-title">AKUN</div>

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Beranda</h1>
                <div class="muted">
                    Temukan produk skincare yang kamu butuhkan dengan mudah.
                </div>
            </div>

            <div class="user-chip">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <strong>{{ auth()->user()->name ?? 'Pelanggan' }}</strong>
                    <small>Pelanggan</small>
                </div>
            </div>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Ada yang perlu diperbaiki:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="welcome">
            <div class="welcome-content">
                <div class="welcome-label">Selamat datang kembali</div>
                <h2>Halo, {{ auth()->user()->name ?? 'Pelanggan' }}!</h2>
                <p>
                    Selamat berbelanja di Ranitha Stuff. Temukan berbagai
                    produk skincare pilihan, periksa harga dan stoknya, lalu
                    masukkan produk favoritmu ke keranjang.
                </p>
            </div>
        </section>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon">▦</div>
                <div>
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-value">
                        {{ number_format($totalProducts ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="stat-footer">Produk dalam katalog</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <div>
                    <div class="stat-label">Produk Tersedia</div>
                    <div class="stat-value">
                        {{ number_format($availableProducts ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="stat-footer">Produk dengan stok tersedia</div>
                </div>
            </div>

        </section>

        <div class="section-heading">
            <div>
                <h2>Temukan Produk</h2>
                <p>Cari berdasarkan nama produk atau kode SKU.</p>
            </div>
        </div>

        <section class="search-panel">
            <form class="search-form" method="GET"
                  action="{{ route('user.dashboard') }}">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk atau SKU..."
                    aria-label="Cari produk"
                >

                <button type="submit" class="btn btn-primary">
                    Cari Produk
                </button>

                @if (request('search'))
                    <a href="{{ route('user.dashboard') }}"
                       class="btn btn-gold">
                        Reset
                    </a>
                @endif
            </form>
        </section>

        <div class="section-heading">
            <div>
                <h2>Daftar Produk</h2>
                <p>Pilih produk dan masukkan jumlah yang ingin dibeli.</p>
            </div>
        </div>

        @if (isset($products) && $products->count() > 0)

            <section class="product-grid">

                @foreach ($products as $product)
                    <article class="product-card">

                        <div class="product-top">
                            <div class="product-icon">▦</div>

                            @if ($product->stock <= 0)
                                <span class="stock-badge empty">
                                    Stok Habis
                                </span>
                            @elseif ($product->stock <= ($product->minimum_stock ?? 0))
                                <span class="stock-badge low">
                                    Stok Menipis
                                </span>
                            @else
                                <span class="stock-badge">
                                    Tersedia
                                </span>
                            @endif
                        </div>

                        <div class="product-sku">
                            SKU: {{ $product->sku }}
                        </div>

                        <h3 class="product-name">
                            {{ $product->name }}
                        </h3>

                        <div class="product-price">
                            Rp {{ number_format((float) $product->selling_price, 0, ',', '.') }}
                        </div>

                        <div class="product-info">
                            <span>Stok tersedia</span>
                            <strong>
                                {{ number_format($product->stock, 0, ',', '.') }}
                            </strong>
                        </div>

                        <form
                            class="cart-form"
                            method="POST"
                            action="{{ route('cart.add') }}"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="product_id"
                                value="{{ $product->id }}"
                            >

                            <input
                                class="quantity"
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $product->stock }}"
                                required
                                aria-label="Jumlah produk"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}
                            >

                            <button
                                type="submit"
                                class="btn btn-primary"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}
                            >
                                🛒 Tambah
                            </button>
                        </form>

                    </article>
                @endforeach

            </section>

            <div class="pagination">
                {{ $products->withQueryString()->links() }}
            </div>

        @else

            <section class="empty-state">
                <div class="empty-icon">⌕</div>
                <h3>Produk tidak ditemukan</h3>
                <p>
                    @if (request('search'))
                        Coba gunakan nama atau kode SKU yang berbeda.
                    @else
                        Belum ada produk yang tersedia saat ini.
                    @endif
                </p>

                @if (request('search'))
                    <a href="{{ route('user.dashboard') }}"
                       class="btn btn-primary">
                        Lihat Semua Produk
                    </a>
                @endif
            </section>

        @endif

        <footer class="footer">
            Ranitha Stuff &copy; {{ date('Y') }}
        </footer>

    </main>

</body>
</html>