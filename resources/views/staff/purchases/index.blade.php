<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pembelian | Inventory Sales</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        /* SIDEBAR STAFF */
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

        .brand h2 {
            font-size: 16px;
            margin: 0;
        }

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

        .logout-button:hover {
            background: #78404a;
        }

        /* KONTEN KANAN */
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
            margin-bottom: 25px;
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
            flex-shrink: 0;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
        }

        .user-role {
            font-size: 11px;
            color: #8a7d79;
            margin-top: 3px;
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
            white-space: nowrap;
        }

        .button:hover {
            background: #54232b;
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

        /* PESAN */
        .notice,
        .error-notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            font-size: 13px;
        }

        .notice {
            background: #e8f4e8;
            color: #286338;
        }

        .error-notice {
            background: #f9e6e3;
            color: #a13f38;
        }

        /* RINGKASAN */
        .summary {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card,
        .table-panel,
        .filter-panel {
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
            margin: 12px 0;
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

        /* FILTER TANGGAL */
        .filter-panel {
            margin-bottom: 20px;
        }

        .filter-heading {
            margin: 0 0 16px;
            font-family: Georgia, serif;
            font-size: 19px;
            font-weight: normal;
            color: #54232b;
        }

        .filter-form {
            display: flex;
            align-items: end;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex: 1;
            flex-direction: column;
            min-width: 170px;
            gap: 7px;
        }

        .form-group label {
            color: #6d5552;
            font-size: 12px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            min-width: 0;
            padding: 11px 12px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            font-family: inherit;
            font-size: 12px;
        }

        .form-group input:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        /* TABEL */
        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
        }

        .table-heading h3 {
            margin: 0;
            font-size: 15px;
        }

        .result-info {
            margin: 0 0 14px;
            color: #8a7d79;
            font-size: 12px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 700px;
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
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcf8f2;
        }

        .invoice,
        .amount {
            color: #54232b;
            font-weight: 600;
        }

        .supplier-name {
            color: #6d5552;
        }

        .empty {
            padding: 35px;
            color: #8a7d79;
            text-align: center;
            white-space: normal;
        }

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

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .summary {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 20px;
            }

            .brand {
                margin-bottom: 15px;
            }

            .sidebar-bottom {
                margin-top: 15px;
                padding-top: 10px;
            }

            .main {
                margin-left: 0;
                padding: 22px 20px;
            }
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 {
                font-size: 25px;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group {
                width: 100%;
            }

            .filter-panel,
            .table-panel {
                padding: 13px;
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
                <p>Management System</p>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('staff.dashboard') }}">
            <span class="nav-icon">⌂</span>
            Dashboard
        </a>

        <a href="{{ route('staff.products.index') }}">
            <span class="nav-icon">▦</span>
            Data Produk
        </a>

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}" class="active">
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
                <button type="submit" class="logout-button">
                    ↪ Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Inventory Sales</div>
                <h1>Transaksi Pembelian</h1>
                <div class="muted">
                    Kelola transaksi pembelian barang dari pemasok.
                </div>
            </div>

            <div class="user-badge">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="user-role">Staff</div>
                </div>
            </div>

            <a href="{{ route('purchases.create') }}" class="button">
                + Tambah Pembelian
            </a>
        </header>

        @if(session('success'))
            <div class="notice">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-notice">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-notice">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="summary">
            <div class="summary-card">
                <small>Total Transaksi Pembelian</small>
                <div class="summary-number">
                    {{ $purchases->total() }}
                </div>
                <small>Jumlah transaksi tercatat</small>
            </div>

            <div class="summary-info">
                <div class="table-panel" style="height: 100%;">
                    <h3>Kelola Transaksi Pembelian</h3>
                    <p>
                        Halaman ini digunakan untuk melihat transaksi pembelian
                        barang dari pemasok. Gunakan filter tanggal untuk mencari
                        transaksi pada periode tertentu. Kamu juga bisa menambahkan
                        transaksi pembelian melalui tombol di atas.
                    </p>
                </div>
            </div>
        </section>

        <section class="filter-panel">
            <h2 class="filter-heading">Filter Tanggal Pembelian</h2>

            <form
                method="GET"
                action="{{ route('purchases.index') }}"
                class="filter-form"
            >
                <div class="form-group">
                    <label for="start_date">Dari Tanggal</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="end_date">Sampai Tanggal</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                    >
                </div>

                <button type="submit" class="button">
                    Terapkan Filter
                </button>

                <a href="{{ route('purchases.index') }}" class="button-light">
                    Reset
                </a>
            </form>
        </section>

        <section class="table-panel">
            <div class="table-heading">
                <h3>Daftar Transaksi Pembelian</h3>
                <span class="muted">Riwayat pembelian barang</span>
            </div>

            <p class="result-info">
                Menampilkan {{ $purchases->firstItem() ?? 0 }}
                sampai {{ $purchases->lastItem() ?? 0 }}
                dari {{ $purchases->total() }} transaksi pembelian.
            </p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Faktur</th>
                            <th>Tanggal</th>
                            <th>Pemasok</th>
                            <th>Petugas</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($purchases as $purchase)
                            <tr>
                                <td>
                                    {{ $purchases->firstItem() + $loop->index }}
                                </td>

                                <td class="invoice">
                                    {{ $purchase->invoice_number }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}
                                </td>

                                <td class="supplier-name">
                                    {{ $purchase->supplier->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $purchase->user->name ?? '-' }}
                                </td>

                                <td class="amount">
                                    Rp {{ number_format((float) $purchase->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    Tidak ada transaksi pembelian pada tanggal tersebut.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $purchases->links() }}
            </div>
        </section>

    </main>
</body>
</html>