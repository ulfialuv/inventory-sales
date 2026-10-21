<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff') | Inventory Sales</title>

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
            font-size: 12px;
        }

        .logout button:hover {
            background: #78404a;
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

        .error-notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #f9e6e3;
            color: #a13f38;
            font-size: 12px;
        }

        .filter-panel,
        .table-panel {
            padding: 20px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .filter-panel { margin-bottom: 18px; }

        .filter-panel h3,
        .table-heading h3 {
            margin: 0 0 15px;
            font-size: 15px;
        }

        .filters {
            display: grid;
            grid-template-columns: 2fr 1fr auto auto;
            align-items: end;
            gap: 12px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #746664;
            font-size: 12px;
        }

        input, select {
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

        input:focus, select:focus {
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

        .table-heading h3 { margin: 0; }

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
            padding: 14px 12px;
            border-bottom: 1px solid #f0e8df;
            font-size: 12px;
        }

        tbody tr:hover { background: #fcf8f2; }

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

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-edit, .action-delete {
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

        .pagination { padding-top: 18px; }

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

        .pagination a, .pagination span {
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

        .summary {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card {
            padding: 21px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
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

        .result-info {
            margin: 0 0 14px;
            color: #8a7d79;
            font-size: 12px;
        }

        .invoice, .amount {
            color: #54232b;
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-paid, .status-completed {
            background: #e5f4e8;
            color: #276738;
        }

        .status-pending {
            background: #fff2d6;
            color: #8a5a12;
        }

        .status-cancelled {
            background: #fde8e7;
            color: #a12b2b;
        }

        .proof-link {
            color: #75414a;
            font-weight: bold;
            text-decoration: none;
        }

        .action-form { margin-bottom: 7px; }

        .action-form .button {
            width: 100%;
            white-space: normal;
            line-height: 1.5;
        }

        .success-btn { background: #34764b; }
        .success-btn:hover { background: #28613c; }
        .danger-btn { background: #b64242; }
        .danger-btn:hover { background: #963434; }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .search-form input { flex: 1; }

        @media (max-width: 950px) {
            .sidebar { width: 190px; }
            .main { margin-left: 190px; padding: 22px; }
            .filters { grid-template-columns: 1fr 1fr; }
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
            .summary { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .filters { grid-template-columns: 1fr; }
            .filter-panel, .table-panel { padding: 14px; }
            .filter-form { flex-direction: column; align-items: stretch; }
            .form-group { width: 100%; }
            .search-form input { flex-basis: 100%; }
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

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}"
           class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <span class="nav-icon">▦</span> Data Produk
        </a>

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}"
           class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}">
            <span class="nav-icon">↓</span> Pembelian
        </a>

        <a href="{{ route('sales.index') }}"
           class="{{ request()->routeIs('sales.*') ? 'active' : '' }}">
            <span class="nav-icon">↑</span> Penjualan
        </a>

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </aside>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>