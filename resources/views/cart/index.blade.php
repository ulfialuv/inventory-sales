<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | Inventory Sales</title>

    <style>
        * {
            box-sizing: border-box;
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

        button, input {
            font: inherit;
        }

        /* SIDEBAR SAMA DENGAN DASHBOARD USER */

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

        .logout button:hover {
            background: var(--maroon-light);
        }

        /* KONTEN KANAN */

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

        /* NOTIFIKASI */

        .alert {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.7;
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

        /* JUDUL DAN TOMBOL */

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .page-heading h2 {
            margin: 0;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 22px;
            font-weight: normal;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 15px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s, transform .2s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--maroon);
            color: white;
        }

        .btn-primary:hover {
            background: var(--maroon-light);
        }

        .btn-gold {
            background: var(--gold-light);
            color: var(--maroon);
        }

        .btn-gold:hover {
            background: #e9d7bc;
        }

        .btn-danger {
            background: #fff0f0;
            color: var(--red);
        }

        .btn-danger:hover {
            background: #f9dede;
        }

        .btn-small {
            padding: 8px 10px;
            font-size: 11px;
        }

        /* RINGKASAN JUMLAH */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0;
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            border-radius: 12px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 21px;
        }

        .stat-label {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-value {
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 23px;
            overflow-wrap: anywhere;
        }

        /* DAFTAR KERANJANG */

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            gap: 18px;
            align-items: start;
        }

        .card {
            min-width: 0;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(84, 35, 43, .035);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding: 19px 20px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2,
        .summary-body h2 {
            margin: 0;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 19px;
            font-weight: normal;
        }

        .card-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .count {
            padding: 7px 11px;
            border-radius: 20px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 12px;
            border-bottom: 1px solid #f0e8df;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #faf6f0;
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            font-size: 12px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fdfaf5;
        }

        .product-name {
            min-width: 115px;
            color: var(--maroon);
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .sku {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
        }

        .price,
        .subtotal {
            font-weight: 700;
            white-space: nowrap;
        }

        .subtotal {
            color: var(--maroon);
        }

        .quantity-form {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        input[type="number"] {
            width: 58px;
            min-width: 48px;
            padding: 9px 5px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
            background: white;
            font-size: 12px;
        }

        input[type="number"]:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(185, 149, 86, .12);
        }

        /* RINGKASAN BELANJA */

        .summary {
            position: sticky;
            top: 20px;
        }

        .summary-body {
            padding: 21px;
        }

        .summary-body h2 {
            margin-bottom: 23px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 12px;
        }

        .summary-row strong {
            color: var(--text);
            text-align: right;
        }

        .divider {
            margin: 20px 0;
            border: 0;
            border-top: 1px dashed #ddcdbb;
        }

        .total {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 22px;
            font-size: 13px;
            font-weight: 700;
        }

        .total strong {
            color: var(--maroon);
            font-size: 19px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .checkout {
            width: 100%;
            padding: 13px;
            font-size: 13px;
        }

        .note {
            margin-top: 13px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            text-align: center;
        }

        .add-product {
            display: flex;
            width: 100%;
            margin-top: 12px;
        }

        /* KERANJANG KOSONG */

        .empty-state {
            padding: 55px 22px;
            border: 1px dashed #d9c8b4;
            border-radius: 13px;
            background: var(--white);
            text-align: center;
        }

        .empty-icon {
            display: grid;
            place-items: center;
            width: 76px;
            height: 76px;
            margin: 0 auto 17px;
            border-radius: 20px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 34px;
        }

        .empty-state h2 {
            margin: 0 0 10px;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 23px;
            font-weight: normal;
        }

        .empty-state p {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .footer {
            padding: 28px 0 5px;
            color: #9a8d86;
            text-align: center;
            font-size: 11px;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .cart-layout {
                grid-template-columns: minmax(0, 1fr) 260px;
            }

            .main {
                padding: 25px 22px;
            }
        }

        @media (max-width: 1000px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .sidebar .nav-title {
                margin-top: 17px;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 22px 20px;
            }

            .cart-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-heading .btn {
                width: 100%;
            }

            .main {
                padding: 20px 14px;
            }

            h1 {
                font-size: 26px;
            }

            .card-header {
                padding: 16px;
            }

            th, td {
                padding: 12px 10px;
            }

            .total strong {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR SAMA DENGAN DASHBOARD USER -->

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <h2>Inventory Sales</h2>
                <small>Customer Portal</small>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('user.dashboard') }}">
            <span class="nav-icon">⌂</span>
            Beranda
        </a>

        <a href="{{ route('cart.index') }}" class="active">
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

    <!-- KONTEN KANAN KHUSUS KERANJANG -->

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Inventory Sales</div>
                <h1>Keranjang Belanja</h1>
                <div class="muted">
                    Periksa produk pilihanmu sebelum melanjutkan ke checkout.
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
                ✓ {{ session('success') }}
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

        <section class="page-heading">
            <div>
                <h2>Produk Pilihanmu</h2>
                <p>
                    Atur jumlah barang atau hapus produk yang tidak jadi dibeli.
                </p>
            </div>

            <a href="{{ route('user.dashboard') }}" class="btn btn-gold">
                ← Kembali Belanja
            </a>
        </section>

        @if ($items->isEmpty())

            <section class="empty-state">
                <div class="empty-icon">🛍️</div>
                <h2>Keranjangmu Masih Kosong</h2>
                <p>
                    Kamu belum menambahkan produk ke keranjang.<br>
                    Yuk, cari produk yang kamu butuhkan!
                </p>

                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                    Lihat Produk →
                </a>
            </section>

        @else

            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">▦</div>
                    <div>
                        <div class="stat-label">Jenis Produk</div>
                        <div class="stat-value">
                            {{ number_format($items->count(), 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🛒</div>
                    <div>
                        <div class="stat-label">Total Barang</div>
                        <div class="stat-value">
                            {{ number_format($items->sum('quantity'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </section>

            <div class="cart-layout">

                <!-- TABEL PRODUK -->

                <section class="card">
                    <div class="card-header">
                        <div>
                            <h2>Daftar Belanja</h2>
                            <p>Pastikan jumlah dan produk sudah sesuai.</p>
                        </div>

                        <span class="count">
                            {{ $items->count() }} jenis produk
                        </span>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="product-name">
                                                {{ $item['product']->name }}
                                            </div>
                                            <span class="sku">
                                                SKU: {{ $item['product']->sku ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="price">
                                            Rp{{ number_format((float) $item['product']->selling_price, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            <form
                                                class="quantity-form"
                                                action="{{ route('cart.update', $item['product']->id) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    min="1"
                                                    max="{{ $item['product']->stock }}"
                                                    value="{{ $item['quantity'] }}"
                                                    required
                                                    aria-label="Jumlah {{ $item['product']->name }}"
                                                >

                                                <button type="submit" class="btn btn-gold btn-small">
                                                    Ubah
                                                </button>
                                            </form>
                                        </td>

                                        <td class="subtotal">
                                            Rp{{ number_format((float) $item['subtotal'], 0, ',', '.') }}
                                        </td>

                                        <td>
                                            <form
                                                action="{{ route('cart.remove', $item['product']->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus produk ini dari keranjang?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-small">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- RINGKASAN BELANJA -->

                <aside class="card summary">
                    <div class="summary-body">
                        <h2>Ringkasan Belanja</h2>

                        <div class="summary-row">
                            <span>Jenis produk</span>
                            <strong>{{ $items->count() }} produk</strong>
                        </div>

                        <div class="summary-row">
                            <span>Total barang</span>
                            <strong>{{ $items->sum('quantity') }} barang</strong>
                        </div>

                        <hr class="divider">

                        <div class="total">
                            <span>Total Belanja</span>
                            <strong>
                                Rp{{ number_format((float) $total, 0, ',', '.') }}
                            </strong>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary checkout">
                            Lanjut Checkout →
                        </a>

                        <p class="note">
                            Periksa kembali produk dan jumlahnya sebelum melanjutkan pesanan.
                        </p>

                        <a href="{{ route('user.dashboard') }}" class="btn btn-gold add-product">
                            + Tambah Produk
                        </a>
                    </div>
                </aside>

            </div>

        @endif

        <footer class="footer">
            Inventory Sales &copy; {{ date('Y') }}. Semua hak dilindungi.
        </footer>

    </main>

</body>
</html>