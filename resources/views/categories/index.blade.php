<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori | Ranitha Stuff</title>

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
        }

        .button:hover { background: #54232b; }

        .notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #e8f4e8;
            color: #286338;
            font-size: 13px;
        }

        .summary {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card,
        .table-panel {
            padding: 21px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .summary-card {
            background: #6b3039;
            color: white;
        }

        .summary-card small {
            color: #ead9d5;
            font-size: 12px;
        }

        .summary-number {
            margin-top: 12px;
            font-size: 30px;
            font-weight: bold;
        }

        .summary-info h3 {
            margin: 0 0 9px;
            font-family: Georgia, serif;
            font-size: 19px;
            font-weight: normal;
        }

        .summary-info p {
            margin: 0;
            color: #827573;
            font-size: 12px;
            line-height: 1.8;
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
        }

        .table-heading h3 { margin: 0; font-size: 15px; }

        .search-form {
            display: flex;
            gap: 8px;
            margin-bottom: 17px;
        }

        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            font: inherit;
            font-size: 12px;
        }

        input:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        .table-wrap { overflow-x: auto; }

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
            padding: 15px 12px;
            border-bottom: 1px solid #f0e8df;
            font-size: 12px;
        }

        tbody tr:hover { background: #fcf8f2; }

        .category-name {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #54232b;
            font-weight: 600;
        }

        .category-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #f1e6d7;
            color: #79404a;
            font-size: 16px;
        }

        .tag {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #f1e6d7;
            color: #79404a;
            font-size: 11px;
        }

        .actions { display: flex; gap: 7px; }

        .action-edit,
        .action-delete {
            padding: 7px 10px;
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
            padding: 35px;
            color: #8a7d79;
            text-align: center;
        }

        .pagination { margin-top: 18px; }

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

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar .nav-title { margin-top: 15px; }
            .logout { position: static; margin-top: 15px; }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .summary { grid-template-columns: 1fr; }
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .table-panel { padding: 13px; }
            .search-form { flex-direction: column; }
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
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Data Kategori</h1>
                <div class="muted">
                    Kelompokkan produk skincare dan kecantikan agar lebih teratur.
                </div>
            </div>

            <a href="{{ route('categories.create') }}" class="button">
                + Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        <div class="summary">
            <div class="summary-card">
                <small>Total Kategori</small>
                <div class="summary-number">{{ $categories->count() }}</div>
                <small>Kategori yang ditampilkan</small>
            </div>

            <div class="summary-info">
                <div class="table-panel" style="height:100%;">
                    <h3>Kelola Kategori Produk</h3>
                    <p>
                        Gunakan kategori untuk mempermudah pengelompokan dan
                        pencarian produk skincare. Kamu bisa menambah kategori
                        baru, memperbarui nama, atau menghapus kategori yang
                        tidak digunakan.
                    </p>
                </div>
            </div>
        </div>

        <section class="table-panel">
            <div class="table-heading">
                <h3>Daftar Kategori</h3>
                <span class="muted">Kategori produk Ranitha Stuff</span>
            </div>

            <form class="search-form" method="GET" action="{{ route('categories.index') }}">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama kategori..."
                >

                <button class="button" type="submit">Cari</button>

                <a
                    href="{{ route('categories.index') }}"
                    class="button-light"
                    style="display:inline-block;padding:11px 14px;border:1px solid #e4d8cc;border-radius:8px;background:#f7f0e7;color:#54232b;text-decoration:none;text-align:center;font-size:12px;"
                >
                    Reset
                </a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    {{ method_exists($categories, 'firstItem') ? $categories->firstItem() + $loop->index : $loop->iteration }}
                                </td>

                                <td>
                                    <div class="category-name">
                                        <span class="category-icon">▤</span>
                                        {{ $category->name }}
                                    </div>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            class="action-edit"
                                            href="{{ route('categories.edit', $category) }}"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('categories.destroy', $category) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button class="action-delete" type="submit">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">
                                    Belum ada kategori atau kategori tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($categories, 'links'))
                <div class="pagination">
                    {{ $categories->withQueryString()->links() }}
                </div>
            @endif
        </section>
    </main>
</body>
</html>