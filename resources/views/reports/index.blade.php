<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi | Inventory Sales</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        /* SIDEBAR - DISAMAKAN DENGAN TRANSAKSI PENJUALAN */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            padding: 28px 18px;
            background: #54232b;
            color: white;
            overflow-y: auto;
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
            background: #b99556;
            color: #54232b;
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
            text-decoration: none;
            font-size: 13px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #78404a;
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
            font-size: 12px;
        }

        .logout button:hover {
            background: #78404a;
        }

        /* KONTEN UTAMA */
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
            line-height: 1.6;
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
            white-space: nowrap;
        }

        .button-light:hover {
            background: #eee2d3;
        }

        .notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #e8f4e8;
            color: #286338;
            font-size: 13px;
        }

        .error {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #f9e6e3;
            color: #a13f38;
            font-size: 13px;
            line-height: 1.7;
        }

        /* FILTER PERIODE */
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
            margin: 0;
            font-size: 15px;
        }

        .filter-panel h3 {
            margin-bottom: 17px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr auto auto;
            align-items: end;
            gap: 12px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #746664;
            font-size: 12px;
        }

        input {
            width: 100%;
            min-width: 0;
            padding: 11px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font-family: inherit;
            font-size: 12px;
        }

        input:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        /* RINGKASAN */
        .summary {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .summary-card {
            position: relative;
            padding: 21px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
            overflow: hidden;
        }

        .summary-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            background: #b99556;
        }

        .summary-card.purchase::before {
            background: #6b3039;
        }

        .summary-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .summary-title {
            margin: 0;
            color: #746664;
            font-size: 12px;
            font-weight: 600;
        }

        .summary-icon {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f3e8d4;
            color: #6b3039;
            font-size: 18px;
            flex-shrink: 0;
        }

        .purchase .summary-icon {
            background: #f1e3e1;
        }

        .amount {
            margin: 14px 0 8px;
            color: #54232b;
            font-size: clamp(21px, 2.3vw, 28px);
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .section {
            margin-top: 20px;
        }

        .table-panel {
            margin-bottom: 20px;
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 17px;
        }

        .table-heading h3 {
            color: #302526;
        }

        /* TABEL */
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
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcf8f2;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .invoice {
            color: #54232b;
            font-weight: 600;
        }

        .money {
            color: #54232b;
            font-weight: 600;
        }

        .empty {
            padding: 30px;
            color: #8a7d79;
            text-align: center;
            white-space: normal;
        }

        /* PAGINATION */
        .pagination {
            padding-top: 18px;
            overflow-x: auto;
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

        .footer {
            padding: 20px 0 5px;
            color: #8a7d79;
            text-align: center;
            font-size: 11px;
        }

        /* RESPONSIVE - SIDEBAR SAMA DENGAN HALAMAN PENJUALAN */
        @media (max-width: 1100px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 24px 20px;
            }

            .filters {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 20px 18px;
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

            .summary {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                padding: 20px 18px;
            }

            .main {
                margin-left: 0;
                padding: 20px 14px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .filters {
                grid-template-columns: 1fr;
            }

            .filters .button,
            .filters .button-light {
                width: 100%;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .filter-panel,
            .table-panel {
                padding: 15px;
            }

            h1 {
                font-size: 26px;
            }

            .table-heading {
                align-items: flex-start;
                flex-direction: column;
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

        <a href="{{ route('reports.index') }}" class="active">
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
                <h1>Laporan Transaksi</h1>
                <div class="muted">
                    Ringkasan dan riwayat pembelian serta penjualan.
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="filter-panel">
            <h3>Filter Periode Transaksi</h3>

            <form method="GET" action="{{ route('reports.index') }}">
                <div class="filters">
                    <div>
                        <label for="start_date">Tanggal Mulai</label>
                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ $startDate }}"
                        >
                    </div>

                    <div>
                        <label for="end_date">Tanggal Akhir</label>
                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ $endDate }}"
                        >
                    </div>

                    <button type="submit" class="button">
                        Terapkan Filter
                    </button>

                    <a href="{{ route('reports.index') }}" class="button-light">
                        Reset
                    </a>
                </div>
            </form>
        </section>

        <section class="summary">
            <div class="summary-card">
                <div class="summary-top">
                    <h3 class="summary-title">Total Penjualan</h3>
                    <div class="summary-icon">↗</div>
                </div>

                <div class="amount">
                    Rp {{ number_format((float) $totalSalesAmount, 0, ',', '.') }}
                </div>

                <div class="muted">
                    {{ number_format($totalSales, 0, ',', '.') }} transaksi penjualan
                </div>
            </div>

            <div class="summary-card purchase">
                <div class="summary-top">
                    <h3 class="summary-title">Total Pembelian</h3>
                    <div class="summary-icon">↙</div>
                </div>

                <div class="amount">
                    Rp {{ number_format((float) $totalPurchaseAmount, 0, ',', '.') }}
                </div>

                <div class="muted">
                    {{ number_format($totalPurchases, 0, ',', '.') }} transaksi pembelian
                </div>
            </div>
        </section>

        <section class="table-panel section">
            <div class="table-heading">
                <h3>Riwayat Penjualan</h3>
                <span class="muted">
                    {{ $sales->total() }} transaksi
                </span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Tanggal</th>
                            <th>Pengguna</th>
                            <th>Total</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sales as $sale)
                            <tr>
                                <td>{{ $sales->firstItem() + $loop->index }}</td>
                                <td class="invoice">{{ $sale->invoice_number }}</td>
                                <td>{{ $sale->sale_date?->format('d-m-Y') }}</td>
                                <td>{{ $sale->user?->name ?? '-' }}</td>
                                <td class="money">
                                    Rp {{ number_format((float) $sale->total, 0, ',', '.') }}
                                </td>
                                <td>{{ $sale->notes ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    Belum ada transaksi penjualan pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $sales->withQueryString()->links() }}
            </div>
        </section>

        <section class="table-panel section">
            <div class="table-heading">
                <h3>Riwayat Pembelian</h3>
                <span class="muted">
                    {{ $purchases->total() }} transaksi
                </span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Tanggal</th>
                            <th>Pemasok</th>
                            <th>Pengguna</th>
                            <th>Total</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchases->firstItem() + $loop->index }}</td>
                                <td class="invoice">{{ $purchase->invoice_number }}</td>
                                <td>{{ $purchase->purchase_date?->format('d-m-Y') }}</td>
                                <td>{{ $purchase->supplier?->name ?? '-' }}</td>
                                <td>{{ $purchase->user?->name ?? '-' }}</td>
                                <td class="money">
                                    Rp {{ number_format((float) $purchase->total, 0, ',', '.') }}
                                </td>
                                <td>{{ $purchase->notes ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    Belum ada transaksi pembelian pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $purchases->withQueryString()->links() }}
            </div>
        </section>

        <div class="footer">
            Inventory Sales &copy; {{ date('Y') }} — Management System
        </div>
    </main>
</body>
</html>