<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff | Inventory Sales</title>

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
            margin-bottom: 30px;
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
        }

        .user-name { font-size: 12px; font-weight: 700; }

        .user-role {
            font-size: 11px;
            color: #8a7d79;
            margin-top: 3px;
        }

        .welcome-panel {
            background: #54232b;
            color: white;
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .welcome-panel::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            border: 1px solid rgba(217, 185, 120, 0.25);
            border-radius: 50%;
            right: -40px;
            top: -65px;
            pointer-events: none;
        }

        .welcome-label {
            color: #d9b978;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .welcome-panel h2 {
            font-family: Georgia, serif;
            font-size: 27px;
            font-weight: normal;
            margin: 0 0 12px;
        }

        .welcome-panel p {
            color: #e3d1ca;
            font-size: 13px;
            line-height: 1.7;
            max-width: 580px;
            margin: 0;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 28px 0 16px;
        }

        .section-heading h2 {
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
            margin: 0;
        }

        .section-heading p { margin: 5px 0 0; }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            display: block;
            padding: 22px;
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            color: inherit;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(65, 35, 35, 0.07);
        }

        .card-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0e5d4;
            border-radius: 11px;
            font-size: 21px;
            margin-bottom: 17px;
        }

        .card h3 { font-size: 15px; margin: 0 0 8px; }

        .card p {
            font-size: 12px;
            color: #8a7d79;
            line-height: 1.7;
            margin: 0 0 16px;
        }

        .card-link {
            color: #78404a;
            font-size: 12px;
            font-weight: 700;
        }

        .info-panel {
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            padding: 22px;
            margin-top: 25px;
        }

        .info-panel h3 {
            font-family: Georgia, serif;
            font-weight: normal;
            font-size: 19px;
            margin: 0 0 10px;
        }

        .info-panel p {
            color: #8a7d79;
            font-size: 13px;
            line-height: 1.8;
            margin: 0;
        }

        @media (max-width: 1000px) {
            .cards { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 { font-size: 25px; }

            .cards { grid-template-columns: 1fr; }

            .welcome-panel { padding: 24px; }

            .welcome-panel h2 { font-size: 23px; }
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

        <a href="{{ route('staff.dashboard') }}" class="active">
            <span class="nav-icon">⌂</span>
            Dashboard
        </a>

        <a href="{{ route('staff.products.index') }}">
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
                <h1>Dashboard Staff</h1>
                <div class="muted">
                    Ringkasan aktivitas dan pengelolaan persediaan.
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

        <section class="welcome-panel">
            <div class="welcome-label">Selamat Datang</div>
            <h2>Halo, {{ auth()->user()->name }}!</h2>
            <p>
                Selamat bekerja. Gunakan dashboard ini untuk melihat data
                produk serta membantu proses pembelian dan penjualan.
                Pastikan setiap transaksi dicatat dengan benar.
            </p>
        </section>

        <div class="section-heading">
            <div>
                <h2>Menu Staff</h2>
                <p class="muted">Pilih menu untuk mulai bekerja.</p>
            </div>
        </div>

        <section class="cards">
            <a href="{{ route('staff.products.index') }}" class="card">
                <div class="card-icon">▦</div>
                <h3>Data Produk</h3>
                <p>
                    Lihat informasi produk, kode SKU, harga, dan stok barang
                    yang tersedia.
                </p>
                <span class="card-link">Lihat Produk →</span>
            </a>

            <a href="{{ route('purchases.index') }}" class="card">
                <div class="card-icon">⇩</div>
                <h3>Pembelian</h3>
                <p>
                    Buka menu pembelian untuk membantu pencatatan barang masuk.
                </p>
                <span class="card-link">Kelola Pembelian →</span>
            </a>

            <a href="{{ route('sales.index') }}" class="card">
                <div class="card-icon">⇧</div>
                <h3>Penjualan</h3>
                <p>
                    Buka menu penjualan untuk membantu pencatatan transaksi
                    barang keluar.
                </p>
                <span class="card-link">Kelola Penjualan →</span>
            </a>
        </section>

        <section class="info-panel">
            <h3>Informasi Staff</h3>
            <p>
                Gunakan akun sesuai hak akses yang diberikan. Periksa kembali
                jumlah barang dan data transaksi sebelum menyimpan perubahan
                agar informasi persediaan tetap akurat.
            </p>
        </section>
    </main>
</body>
</html>