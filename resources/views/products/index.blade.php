<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk | Inventory Sales</title>

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

        .button:hover {
            background: #54232b;
        }

        .notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #e8f4e8;
            color: #286338;
            font-size: 13px;
        }

        .notice-error {
            background: #f9e6e3;
            color: #a13f38;
        }

        .filter-panel,
        .table-panel {
            padding: 20px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .filter-panel {
            margin-bottom: 18px;
        }

        .filter-panel h3,
        .table-heading h3 {
            margin: 0 0 15px;
            font-size: 15px;
        }

        .filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto auto;
            align-items: end;
            gap: 12px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #746664;
            font-size: 12px;
        }

        input,
        select {
            width: 100%;
            min-width: 0;
            padding: 11px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font: inherit;
            font-size: 12px;
        }

        input:focus,
        select:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

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

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .table-heading h3 {
            margin: 0;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            padding: 13px 12px;
            background: #f5eee5;
            color: #6d5552;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #f0e8df;
            font-size: 12px;
        }

        tbody tr:hover {
            background: #fcf8f2;
        }

        .product-name {
            color: #54232b;
            font-weight: 600;
        }

        .sku {
            color: #8a7d79;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #e7f3e7;
            color: #347044;
            font-size: 11px;
        }

        .badge-low {
            background: #fff0d6;
            color: #8a5b15;
        }

        .badge-empty {
            background: #f9e6e3;
            color: #a13f38;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-edit,
        .action-delete {
            padding: 7px 9px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            font-size: 11px;
            cursor: pointer;
        }

        .action-edit {
            background: #f1e6d7;
            color: #6b3039;
        }

        .action-delete {
            background: #f9e6e3;
            color: #a13f38;
        }

        .empty {
            padding: 30px;
            color: #8a7d79;
            text-align: center;
        }

        .pagination {
            padding-top: 18px;
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

        @media (max-width: 1100px) {
            .filters {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 950px) {
            .sidebar {
                width: 190px;
            }

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

            .sidebar .nav-title {
                margin-top: 15px;
            }

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

            .filters {
                grid-template-columns: 1fr;
            }

            .filter-panel,
            .table-panel {
                padding: 14px;
            }
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

        <a href="{{ route('products.index') }}" class="active">
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
        <div class="topbar">
            <div>
                <div class="eyebrow">Manajemen Inventory</div>
                <h1>Data Produk</h1>
                <div class="muted">
                    Kelola produk, kategori, harga, dan persediaan barang.
                </div>
            </div>

            <a class="button" href="{{ route('products.create') }}">
                + Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="notice">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="notice notice-error">
                {{ session('error') }}
            </div>
        @endif

        <section class="filter-panel">
            <h3>Temukan Produk</h3>

            <form method="GET" action="{{ route('products.index') }}">
                <div class="filters">
                    <div>
                        <label for="search">Nama produk atau SKU</label>
                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau SKU..."
                        >
                    </div>

                    <div>
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id">
                            <option value="">Semua kategori</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="stock_filter">Kondisi Stok</label>
                        <select name="stock_filter" id="stock_filter">
                            <option value="">Semua kondisi</option>

                            <option
                                value="available"
                                {{ request('stock_filter') === 'available' ? 'selected' : '' }}
                            >
                                Stok Tersedia
                            </option>

                            <option
                                value="low"
                                {{ request('stock_filter') === 'low' ? 'selected' : '' }}
                            >
                                Stok Menipis
                            </option>

                            <option
                                value="empty"
                                {{ request('stock_filter') === 'empty' ? 'selected' : '' }}
                            >
                                Stok Habis
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="button">
                        Cari Produk
                    </button>

                    <a href="{{ route('products.index') }}" class="button-light">
                        Reset
                    </a>
                </div>
            </form>
        </section>

        <section class="table-panel">
            <div class="table-heading">
                <h3>Daftar Produk</h3>

                <span class="muted">
                    {{ $products->total() }} produk ditemukan
                </span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>

                                    <div class="sku">
                                        SKU: {{ $product->sku }}
                                    </div>
                                </td>

                                <td>
                                    {{ $product->category->name ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </td>

                                <td>{{ $product->stock }}</td>

                                <td>
                                    @if($product->stock <= 0)
                                        <span class="badge badge-empty">
                                            Stok habis
                                        </span>
                                    @elseif($product->stock <= $product->minimum_stock)
                                        <span class="badge badge-low">
                                            Stok menipis
                                        </span>
                                    @else
                                        <span class="badge">
                                            Tersedia
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            class="action-edit"
                                            href="{{ route('products.edit', $product) }}"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('products.destroy', $product) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="action-delete"
                                                type="submit"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">
                                    Produk tidak ditemukan. Coba kata kunci,
                                    kategori, atau kondisi stok lain.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $products->withQueryString()->links() }}
            </div>
        </section>
    </main>
</body>
</html>