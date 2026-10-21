<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembeli - Inventory Sales</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --green: #426B50;
            --dark: #2F503C;
            --deep: #274633;
            --soft: #E9F0E8;
            --sage: #D6E3D3;
            --cream: #F7F5ED;
            --white: #fff;
            --text: #303A32;
            --muted: #818980;
            --border: #E5EAE1;
            --pink: #F8ECE8;
            --yellow: #F7F0D9;
            --shadow: 0 8px 24px rgba(47,80,60,.055);
        }

        body {
            font: 14px/1.6 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a { text-decoration: none; }
        button, input { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }

        /* HEADER */
        header {
            background: var(--dark);
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            box-shadow: 0 4px 18px #27463320;
        }

        .brand { display: flex; align-items: center; gap: 11px; }
        .brand-icon {
            width: 43px; height: 43px; border-radius: 15px;
            background: #ffffff21; display: grid; place-items: center;
            font-size: 22px;
        }

        .brand h2 { font-size: 19px; font-weight: 900; line-height: 1.25; }
        .brand p { font-size: 11px; color: #DCE8DC; }

        nav { display: flex; align-items: center; gap: 7px; flex-wrap: wrap; }
        nav a {
            color: #F5F8F3; padding: 9px 13px; border-radius: 11px;
            font-size: 12px; font-weight: 800; transition: .2s;
        }

        nav a:hover, nav a.active { background: #ffffff24; }
        .logout-form { margin-left: 4px; }

        .logout-button {
            background: var(--cream); color: var(--dark); border: 0;
            border-radius: 11px; padding: 10px 15px;
            font-size: 12px; font-weight: 900; cursor: pointer;
        }

        .logout-button:hover { background: #E5ECDD; }

        /* PAGE AND WELCOME */
        .container { width: 92%; max-width: 1160px; margin: 30px auto 45px; }

        .welcome {
            position: relative; overflow: hidden; color: white;
            padding: 32px; border-radius: 24px; margin-bottom: 24px;
            background: linear-gradient(120deg, var(--dark), var(--green) 65%, #64866A);
            box-shadow: 0 12px 28px #2F503C24;
        }

        .welcome::before, .welcome::after {
            content: ""; position: absolute; border-radius: 50%;
            background: #ffffff12;
        }

        .welcome::before { width: 210px; height: 210px; right: 70px; top: -120px; }
        .welcome::after { width: 150px; height: 150px; right: -35px; bottom: -80px; }

        .welcome-content { position: relative; z-index: 1; max-width: 700px; }

        .welcome-label {
            display: inline-block; background: #ffffff21;
            border: 1px solid #ffffff2b; border-radius: 30px;
            padding: 6px 12px; font-size: 10px;
            font-weight: 900; letter-spacing: 1px; margin-bottom: 14px;
        }

        .welcome h1 { font-size: clamp(24px,3vw,32px); line-height: 1.3; font-weight: 900; margin-bottom: 8px; }
        .welcome p { font-size: 13px; color: #E5EEE3; }
        .welcome-decoration { position: absolute; right: 35px; bottom: 20px; font-size: 65px; transform: rotate(-8deg); }

        /* NOTIFICATIONS */
        .message, .error-message {
            padding: 13px 16px; border-radius: 13px;
            margin-bottom: 16px; font-size: 13px; font-weight: 700;
        }

        .message { background: #E5F2E6; color: #285E38; border: 1px solid #D1E6D2; }
        .error-message { background: #FDEAEA; color: #9B2525; border: 1px solid #F3D4D4; }
        .error-message p + p { margin-top: 5px; }

        /* STATISTICS */
        .stats { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 18px; margin-bottom: 32px; }

        .stat-card {
            display: flex; align-items: center; gap: 17px;
            background: white; border: 1px solid var(--border);
            border-radius: 20px; padding: 23px; box-shadow: var(--shadow);
            transition: .25s;
        }

        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px #2F503C17; }

        .stat-icon {
            width: 57px; height: 57px; border-radius: 19px;
            display: grid; place-items: center; font-size: 27px; flex-shrink: 0;
        }

        .products-icon { background: var(--soft); }
        .stock-icon { background: var(--yellow); }
        .stat-card p { color: var(--muted); font-size: 12px; font-weight: 700; }
        .stat-card h2 { color: var(--dark); font-size: 30px; font-weight: 900; line-height: 1.25; }

        /* SECTION */
        .section-heading {
            display: flex; justify-content: space-between;
            align-items: center; gap: 15px; margin-bottom: 18px;
        }

        .section-heading h2 { font-size: 23px; font-weight: 900; color: var(--dark); }
        .section-heading p { font-size: 12px; color: var(--muted); margin-top: 3px; }

        .product-count {
            background: var(--soft); color: var(--dark); border: 1px solid #DCE7D9;
            padding: 8px 14px; border-radius: 30px; font-size: 11px;
            font-weight: 900; white-space: nowrap;
        }

        /* SEARCH */
        .search-box {
            background: white; border: 1px solid var(--border);
            border-radius: 17px; padding: 13px; margin-bottom: 22px;
        }

        .search-form { display: flex; align-items: center; gap: 11px; }
        .search-input-wrap { position: relative; flex: 1; min-width: 0; }
        .search-symbol { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); font-size: 20px; color: var(--green); }

        .search-form input {
            width: 100%; padding: 13px 14px 13px 43px;
            border: 1px solid #E0E7DD; border-radius: 12px;
            outline: none; font-size: 12px; font-weight: 600;
            background: #FCFCF9; color: var(--text);
        }

        .search-form input:focus, .add-form input:focus {
            border-color: var(--green); box-shadow: 0 0 0 4px #426B5017;
        }

        .search-form input::placeholder { color: #A0A69D; }

        .search-button, .add-form button {
            background: var(--green); color: white; border: 0;
            border-radius: 12px; font-weight: 900; cursor: pointer; transition: .2s;
        }

        .search-button { padding: 13px 21px; font-size: 12px; white-space: nowrap; }
        .search-button:hover, .add-form button:hover { background: var(--dark); }

        /* PRODUCT CARDS */
        .products { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: 18px; }

        .product-card {
            background: white; border: 1px solid var(--border);
            border-radius: 20px; padding: 17px; display: flex;
            flex-direction: column; min-width: 0; box-shadow: 0 4px 14px #2F503C09;
            transition: .25s;
        }

        .product-card:hover {
            transform: translateY(-5px); border-color: #CBDCCB;
            box-shadow: 0 12px 26px #2F503C17;
        }

        .product-top { display: flex; justify-content: space-between; align-items: center; gap: 7px; margin-bottom: 16px; }

        .product-icon {
            width: 49px; height: 49px; background: var(--soft);
            border: 1px solid #DCE7D9; border-radius: 16px;
            display: grid; place-items: center; font-size: 25px;
        }

        .stock-badge {
            background: #E5F2E6; color: #28613A; border: 1px solid #D4E7D4;
            padding: 5px 9px; border-radius: 30px; font-size: 10px;
            font-weight: 900; white-space: nowrap;
        }

        .stock-badge.out { background: #FDE9E9; color: #A52C2C; border-color: #F3D4D4; }
        .product-card h3 { font-size: 15px; line-height: 1.5; font-weight: 900; margin-bottom: 4px; overflow-wrap: anywhere; }
        .sku { font-size: 10px; font-weight: 700; color: #969D94; margin-bottom: 14px; }
        .price-label { color: var(--muted); font-size: 11px; font-weight: 700; }
        .price { color: var(--dark); font-size: 18px; font-weight: 900; line-height: 1.5; overflow-wrap: anywhere; }
        .stock { font-size: 11px; color: #777F76; margin: 10px 0 14px; }
        .stock strong { color: var(--dark); font-weight: 900; }
        .product-divider { height: 1px; background: #E9EEE6; margin-bottom: 14px; }

        /* ADD TO CART */
        .add-form { margin-top: auto; }
        .add-form label { display: block; font-size: 11px; font-weight: 900; margin-bottom: 7px; }

        .add-form input {
            width: 100%; padding: 10px 11px; border: 1px solid #DCE4D9;
            border-radius: 10px; outline: none; margin-bottom: 10px;
            font-size: 12px; font-weight: 700; color: var(--text);
        }

        .add-form button { width: 100%; padding: 11px 8px; font-size: 11px; }
        .empty { background: white; border: 1px dashed #C8D8C6; padding: 40px 18px; border-radius: 20px; text-align: center; color: var(--muted); grid-column: 1 / -1; }
        .empty-icon { font-size: 39px; margin-bottom: 8px; }
        .empty h3 { color: var(--dark); font-size: 18px; font-weight: 900; margin-bottom: 5px; }
        .empty p { font-size: 12px; }
        .pagination { margin-top: 25px; overflow-x: auto; }
        .pagination nav { width: 100%; }
        .pagination nav a, .pagination nav span { color: var(--dark); }

        footer { margin-top: 45px; background: white; border-top: 1px solid var(--border); text-align: center; color: var(--muted); padding: 22px 15px; font-size: 11px; }
        footer span { color: var(--dark); font-weight: 900; }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .products { grid-template-columns: repeat(3,minmax(0,1fr)); }
            .container { width: 94%; }
            .welcome-decoration { right: 20px; font-size: 52px; }
        }

        @media (max-width: 760px) {
            header { padding: 14px 4%; }
            nav { width: 100%; gap: 5px; }
            nav a { padding: 8px 10px; font-size: 11px; }
            .container { width: 92%; margin: 22px auto; }
            .welcome { padding: 25px 22px; border-radius: 20px; }
            .welcome h1 { font-size: 25px; }
            .welcome-decoration { right: 13px; bottom: 8px; font-size: 42px; opacity: .6; }
            .products { grid-template-columns: repeat(2,minmax(0,1fr)); gap: 13px; }
            .product-card { padding: 14px; border-radius: 17px; }
            .product-card h3 { font-size: 14px; }
            .price { font-size: 16px; }
            .section-heading h2 { font-size: 20px; }
            .stat-card { padding: 18px; }
        }

        @media (max-width: 480px) {
            .brand h2 { font-size: 16px; }
            .brand-icon { width: 39px; height: 39px; }
            nav { gap: 4px; }
            nav a { padding: 7px 8px; font-size: 10px; }
            .logout-form { margin-left: 0; }
            .logout-button { padding: 8px 10px; font-size: 10px; }
            .container { margin-top: 17px; }
            .welcome { padding: 22px 18px; margin-bottom: 18px; }
            .welcome h1 { font-size: 22px; }
            .welcome p { font-size: 12px; max-width: 90%; }
            .welcome-decoration { font-size: 32px; right: 9px; bottom: 6px; }
            .stats { gap: 10px; margin-bottom: 26px; }
            .stat-card { padding: 13px 11px; gap: 9px; border-radius: 15px; align-items: flex-start; }
            .stat-icon { width: 34px; height: 34px; font-size: 17px; border-radius: 11px; }
            .stat-card p { font-size: 10px; }
            .stat-card h2 { font-size: 23px; }
            .section-heading h2 { font-size: 18px; }
            .section-heading p { font-size: 10px; }
            .product-count { font-size: 9px; padding: 6px 9px; }
            .search-form { flex-direction: column; align-items: stretch; }
            .search-form input { padding-top: 12px; padding-bottom: 12px; }
            .search-button { width: 100%; padding: 12px; }
            .products { gap: 10px; }
            .product-card { padding: 11px; border-radius: 15px; }
            .product-top { align-items: flex-start; flex-wrap: wrap; margin-bottom: 12px; }
            .product-icon { width: 38px; height: 38px; font-size: 20px; border-radius: 12px; }
            .stock-badge { font-size: 9px; padding: 4px 6px; }
            .product-card h3 { font-size: 12px; }
            .sku { font-size: 9px; }
            .price { font-size: 14px; }
            .stock { font-size: 10px; }
            .add-form label { font-size: 10px; }
            .add-form input { padding: 9px 7px; font-size: 11px; }
            .add-form button { padding: 10px 5px; font-size: 10px; }
        }
    </style>
</head>

<body>
<header>
    <div class="brand">
        <div class="brand-icon">📦</div>
        <div>
            <h2>Inventory Sales</h2>
            <p>Belanja lebih mudah ♡</p>
        </div>
    </div>

    <nav>
        <a href="{{ route('user.dashboard') }}" class="active">⌂ Beranda</a>
        <a href="{{ route('cart.index') }}">🛒 Keranjang</a>
        <a href="{{ route('user.orders') }}">📋 Pesanan Saya</a>
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-button" type="submit">Logout ↗</button>
        </form>
    </nav>
</header>

<main class="container">
    <section class="welcome">
        <div class="welcome-content">
            <span class="welcome-label">✦ DASHBOARD PEMBELI</span>
            <h1>Hai, {{ auth()->user()->name }}! 👋</h1>
            <p>Senang melihat kamu di sini.</p>
            <p>Yuk, temukan produk favoritmu dan belanja dengan mudah! ♡</p>
        </div>
        <div class="welcome-decoration">🌿</div>
    </section>

    @if (session('success'))
        <div class="message">✓ {{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="stats">
        <div class="stat-card">
            <div class="stat-icon products-icon">📦</div>
            <div><p>Total Produk</p><h2>{{ $totalProducts }}</h2></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stock-icon">🌱</div>
            <div><p>Produk Tersedia</p><h2>{{ $availableProducts }}</h2></div>
        </div>
    </section>

    <section>
        <div class="section-heading">
            <div>
                <h2>Jelajahi Produk ✨</h2>
                <p>Pilih produk yang kamu butuhkan untuk mulai berbelanja.</p>
            </div>
            <span class="product-count">♡ Katalog Produk</span>
        </div>

        <div class="search-box">
            <form class="search-form" action="{{ route('user.dashboard') }}" method="GET">
                <div class="search-input-wrap">
                    <span class="search-symbol">⌕</span>
                    <input type="text" name="search"
                        placeholder="Cari nama produk atau SKU..."
                        value="{{ request('search') }}">
                </div>
                <button class="search-button" type="submit">Cari Produk ✨</button>
            </form>
        </div>

        <div class="products">
            @forelse ($products as $product)
                <article class="product-card">
                    <div class="product-top">
                        <div class="product-icon">📦</div>
                        <span class="stock-badge {{ $product->stock > 0 ? '' : 'out' }}">
                            {{ $product->stock > 0 ? '✓ Tersedia' : 'Stok Habis' }}
                        </span>
                    </div>

                    <h3>{{ $product->name }}</h3>
                    <p class="sku">SKU: {{ $product->sku ?? '-' }}</p>
                    <p class="price-label">Harga produk</p>
                    <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="stock">Stok tersedia: <strong>{{ $product->stock }}</strong></p>
                    <div class="product-divider"></div>

                    @if ($product->stock > 0)
                        <form class="add-form" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="quantity-{{ $product->id }}">Jumlah pembelian</label>
                            <input id="quantity-{{ $product->id }}" type="number"
                                name="quantity" value="1" min="1"
                                max="{{ $product->stock }}" required>
                            <button type="submit">＋ Tambah ke Keranjang</button>
                        </form>
                    @else
                        <p class="stock">Yah, produk ini sedang habis ♡</p>
                    @endif
                </article>
            @empty
                <div class="empty">
                    <div class="empty-icon">🔎</div>
                    <h3>Produk belum ditemukan ♡</h3>
                    <p>Coba gunakan kata kunci pencarian yang lain, ya.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination">{{ $products->links() }}</div>
    </section>
</main>

<footer>Dibuat dengan ♡ oleh <span>Inventory Sales</span> · © {{ date('Y') }}</footer>
</body>
</html>