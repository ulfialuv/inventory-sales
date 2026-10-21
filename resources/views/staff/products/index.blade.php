<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Staff | Inventory Sales</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        .sidebar {
            width: 225px;
            position: fixed;
            inset: 0 auto 0 0;
            padding: 28px 18px;
            background: #54232b;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 35px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #b99556;
            color: #54232b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .brand h2 { font-size: 16px; margin: 0; }

        .brand p {
            font-size: 10px;
            color: #e3d1ca;
            margin: 4px 0 0;
        }

        .nav-title {
            font-size: 10px;
            letter-spacing: 1.5px;
            color: #cdb5ae;
            margin: 20px 0 10px 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 11px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: #f5e9e5;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #78404a;
            color: white;
        }

        .nav-icon {
            width: 19px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .logout-button {
            width: 100%;
            padding: 11px;
            background: transparent;
            border: 1px solid #91616a;
            border-radius: 8px;
            color: white;
            font-size: 13px;
            cursor: pointer;
        }

        .logout-button:hover { background: #78404a; }

        .main {
            margin-left: 225px;
            padding: 30px 34px;
            max-width: 1600px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .eyebrow {
            color: #a17b40;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .topbar h1 {
            font-family: Georgia, serif;
            font-size: 29px;
            font-weight: normal;
            margin: 0 0 8px;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.6;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .avatar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #efe2cd;
            color: #6b3039;
            border-radius: 50%;
            font-weight: 700;
        }

        .user-name { font-size: 12px; font-weight: 700; }

        .user-role {
            font-size: 11px;
            color: #8a7d79;
            margin-top: 3px;
        }

        .summary-panel {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: #54232b;
            color: white;
            border-radius: 14px;
            padding: 24px 28px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .summary-panel::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            border: 1px solid rgba(217, 185, 120, 0.25);
            border-radius: 50%;
            right: -30px;
            top: -60px;
            pointer-events: none;
        }

        .summary-label {
            color: #d9b978;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .summary-panel h2 {
            font-family: Georgia, serif;
            font-size: 24px;
            font-weight: normal;
            margin: 0 0 8px;
        }

        .summary-panel p {
            color: #e3d1ca;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        .summary-icon {
            font-size: 40px;
            color: #d9b978;
            padding-right: 12px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 28px 0 15px;
        }

        .section-heading h2 {
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
            margin: 0;
        }

        .section-heading p { margin: 5px 0 0; }

        .panel {
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            padding: 22px;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        input, select {
            padding: 11px 12px;
            border: 1px solid #ded5cf;
            border-radius: 8px;
            background: white;
            color: #302526;
            font: inherit;
            font-size: 12px;
        }

        input {
            min-width: 200px;
            flex: 1;
        }

        .btn {
            display: inline-block;
            padding: 11px 15px;
            background: #54232b;
            color: white;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-gold {
            background: #b99556;
            color: white;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #eee7e1;
            font-size: 12px;
        }

        th {
            background: #f8f3ec;
            color: #6d5555;
            font-weight: 700;
            white-space: nowrap;
        }

        td { color: #514345; }

        tbody tr:hover { background: #fcf8f2; }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            background: #e5f4e7;
            color: #276b37;
            font-size: 11px;
            white-space: nowrap;
        }

        .low {
            background: #fbe5e5;
            color: #a33b3b;
        }

        .pagination {
            margin-top: 20px;
            font-size: 12px;
        }

        .pagination nav {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .alert-success {
            padding: 12px 15px;
            margin-bottom: 18px;
            background: #e5f4e7;
            color: #276b37;
            border-radius: 8px;
            font-size: 13px;
        }

        @media (max-width: 1000px) {
            .main { padding: 25px 20px; }
            .topbar h1 { font-size: 25px; }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 20px;
            }

            .brand { margin-bottom: 15px; }

            .sidebar-bottom {
                margin-top: 15px;
                padding-top: 10px;
            }

            .main {
                margin-left: 0;
                padding: 22px 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 500px) {
            .topbar h1 { font-size: 24px; }
            .summary-panel { padding: 22px; }
            .summary-panel h2 { font-size: 21px; }
            .summary-icon { display: none; }
            .panel { padding: 15px; }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <h2>Inventory Sales</h2>
                <p>Management System</p>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('staff.dashboard') }}">
            <span class="nav-icon">⌂</span>
            Dashboard
        </a>

        <a href="{{ route('staff.products.index') }}" class="active">
            <span class="nav-icon">▦</span>
            Data Produk
        </a>

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}">
            <span class="nav-icon">⇩</span>
            Pembelian
        </a>

        <a href="{{ route('sales.index') }}">
            <span class="nav-icon">⇧</span>
            Penjualan
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">↪ Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <div class="eyebrow">Inventory Sales</div>
                <h1>Data Produk</h1>
                <div class="muted">
                    Informasi produk, harga jual, dan ketersediaan stok.
                </div>
            </div>

            <div class="user-badge">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Staff</div>
                </div>
            </div>
        </header>

        <section class="summary-panel">
            <div>
                <div class="summary-label">INFORMASI PERSEDIAAN</div>
                <h2>Daftar Produk</h2>
                <p>
                    Periksa informasi produk dan stok barang yang tersedia.
                    Gunakan pencarian serta filter untuk menemukan produk.
                </p>
            </div>
            <div class="summary-icon">▦</div>
        </section>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="section-heading">
            <div>
                <h2>Semua Produk</h2>
                <p class="muted">Data produk yang tersedia di sistem.</p>
            </div>
        </div>

        <section class="panel">
            <form method="GET"
                  action="{{ route('staff.products.index') }}"
                  class="filters">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama produk atau SKU..."
                    value="{{ request('search') }}"
                >

                <select name="category_id">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected((string) request('category_id') === (string) $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="stock_filter">
                    <option value="">Semua Stok</option>
                    <option value="available" @selected(request('stock_filter') === 'available')>
                        Stok tersedia
                    </option>
                    <option value="low" @selected(request('stock_filter') === 'low')>
                        Stok menipis
                    </option>
                    <option value="empty" @selected(request('stock_filter') === 'empty')>
                        Stok habis
                    </option>
                </select>

                <button class="btn" type="submit">Cari Produk</button>
                <a href="{{ route('staff.products.index') }}" class="btn btn-gold">
                    Reset
                </a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>SKU</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $products->firstItem() + $loop->index }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if ($product->stock <= 0)
                                        <span class="status low">Habis</span>
                                    @elseif (isset($product->min_stock) && $product->stock <= $product->min_stock)
                                        <span class="status low">Menipis</span>
                                    @else
                                        <span class="status">Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;padding:30px">
                                    Data produk belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $products->links() }}
            </div>
        </section>
    </main>
</body>
</html>