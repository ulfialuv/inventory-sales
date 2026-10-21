<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Inventory Sales</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green: #244b3b;
            --sage: #e8f0e8;
            --cream: #f8f8f1;
            --text: #29382f;
            --muted: #7b867d;
            --border: #e7ece5;
            --red: #c95656;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        a { text-decoration: none; }
        button, input { font: inherit; }

        .navbar {
            background: var(--green);
            color: white;
            padding: 17px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            box-shadow: 0 4px 15px #244b3b18;
        }

        .brand { color: white; font-size: 21px; font-weight: 900; }
        .nav-links { display: flex; gap: 22px; flex-wrap: wrap; }
        .nav-links a { color: #e5eee7; font-size: 14px; font-weight: 700; }
        .nav-links a:hover, .nav-links .active { color: #c5dfc7; }

        .container { width: min(1100px, 92%); margin: 32px auto 45px; }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        h1 { color: var(--green); font-size: 27px; font-weight: 900; }
        .subtitle { color: var(--muted); font-size: 14px; margin-top: 6px; }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 11px 15px;
            border: 0;
            border-radius: 11px;
            background: var(--green);
            color: white;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .btn:hover { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-light { background: white; color: var(--green); border: 1px solid var(--border); }
        .btn-sage { background: var(--sage); color: var(--green); }
        .btn-red { background: #fff0ee; color: var(--red); }
        .btn-small { padding: 8px 10px; font-size: 12px; }

        .message { padding: 14px 16px; margin-bottom: 16px; border-radius: 12px; font-size: 14px; line-height: 1.7; }
        .success { background: #e6f5e8; color: #28663c; border: 1px solid #cce9d1; }
        .error { background: #fff0ee; color: #a43d3d; border: 1px solid #f5d5d1; }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 19px;
            overflow: hidden;
            box-shadow: 0 5px 20px #294b3510;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 21px;
            align-items: start;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        h2 { color: var(--green); font-size: 18px; font-weight: 900; }
        .hint { color: var(--muted); font-size: 12px; margin-top: 5px; }

        .count {
            padding: 7px 11px;
            border-radius: 20px;
            background: var(--sage);
            color: var(--green);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px 12px; border-bottom: 1px solid #edf0eb; text-align: left; vertical-align: middle; }
        th { background: #f7faf5; color: var(--muted); font-size: 10px; text-transform: uppercase; letter-spacing: .4px; white-space: nowrap; }
        td { font-size: 13px; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fbfcf9; }

        .product { min-width: 110px; color: var(--text); font-weight: 900; line-height: 1.5; }
        .sku { display: block; color: var(--muted); font-size: 11px; margin-top: 5px; }
        .price, .subtotal { font-weight: 900; white-space: nowrap; }
        .subtotal { color: var(--green); }

        .quantity { display: flex; align-items: center; gap: 6px; }
        input[type="number"] {
            width: 58px;
            padding: 8px 5px;
            border: 1px solid #dce5db;
            border-radius: 9px;
            outline: none;
            font-size: 13px;
        }

        input[type="number"]:focus { border-color: var(--green); }
        .summary { position: sticky; top: 20px; }
        .summary-body { padding: 22px; }
        .summary-body h2 { margin-bottom: 22px; }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 13px;
        }

        .summary-row strong { color: var(--text); text-align: right; }
        .divider { border: 0; border-top: 1px dashed #dce5db; margin: 20px 0; }

        .total {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 22px;
            font-weight: 900;
        }

        .total strong { color: var(--green); font-size: 20px; text-align: right; overflow-wrap: anywhere; }
        .checkout { width: 100%; padding: 14px; font-size: 14px; }
        .note { margin-top: 13px; color: var(--muted); font-size: 11px; line-height: 1.7; text-align: center; }
        .back { display: flex; margin-top: 12px; }

        .empty { padding: 50px 22px; text-align: center; }
        .empty-icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            border-radius: 25px;
            background: var(--sage);
            display: grid;
            place-items: center;
            font-size: 36px;
        }

        .empty h2 { font-size: 21px; margin-bottom: 10px; }
        .empty p { color: var(--muted); font-size: 14px; line-height: 1.7; margin-bottom: 22px; }
        footer { padding: 25px 15px; color: var(--muted); font-size: 12px; text-align: center; }

        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; }
            .summary { position: static; }
        }

        @media (max-width: 600px) {
            .navbar { padding: 17px 5%; }
            .brand { font-size: 19px; }
            .nav-links { gap: 14px; }
            .nav-links a { font-size: 12px; }
            .container { margin-top: 24px; }
            h1 { font-size: 23px; }
            .heading > .btn { width: 100%; }
            .card-header { padding: 16px; }
            th, td { padding: 12px 10px; }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <a href="{{ route('user.dashboard') }}" class="brand">🌿 Inventory Sales</a>

        <nav class="nav-links">
            <a href="{{ route('user.dashboard') }}">Beranda</a>
            <a href="{{ route('cart.index') }}" class="active">🛒 Keranjang</a>
            <a href="{{ route('user.orders') }}">Pesanan Saya</a>
        </nav>
    </header>

    <main class="container">
        <div class="heading">
            <div>
                <h1>🛒 Keranjang Belanja</h1>
                <p class="subtitle">Periksa kembali produk pilihanmu sebelum checkout.</p>
            </div>

            <a href="{{ route('user.dashboard') }}" class="btn btn-light">
                ← Kembali Belanja
            </a>
        </div>

        @if (session('success'))
            <div class="message success">✓ {{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="message error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if ($items->isEmpty())
            <section class="card empty">
                <div class="empty-icon">🛍️</div>
                <h2>Keranjangmu masih kosong</h2>
                <p>Belum ada produk yang dipilih.<br>Yuk, cari produk yang kamu butuhkan!</p>
                <a href="{{ route('user.dashboard') }}" class="btn">Lihat Produk →</a>
            </section>
        @else
            <div class="layout">
                <section class="card">
                    <div class="card-header">
                        <div>
                            <h2>Produk Pilihanmu</h2>
                            <p class="hint">Pastikan jumlah barang sudah sesuai.</p>
                        </div>
                        <span class="count">{{ $items->count() }} jenis produk</span>
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
                                            <div class="product">{{ $item['product']->name }}</div>
                                            <span class="sku">SKU: {{ $item['product']->sku ?? '-' }}</span>
                                        </td>

                                        <td class="price">
                                            Rp{{ number_format((float) $item['product']->selling_price, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            <form class="quantity" action="{{ route('cart.update', $item['product']->id) }}" method="POST">
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

                                                <button type="submit" class="btn btn-sage btn-small">
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

                                                <button type="submit" class="btn btn-red btn-small">
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

                <aside class="card summary">
                    <div class="summary-body">
                        <h2>📋 Ringkasan Belanja</h2>

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
                            <strong>Rp{{ number_format((float) $total, 0, ',', '.') }}</strong>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="btn checkout">
                            Lanjut Checkout →
                        </a>

                        <p class="note">
                            Periksa kembali produk dan jumlahnya sebelum melanjutkan pesanan.
                        </p>

                        <a href="{{ route('user.dashboard') }}" class="btn btn-light back">
                            + Tambah Produk
                        </a>
                    </div>
                </aside>
            </div>
        @endif
    </main>

    <footer>
        Inventory Sales &copy; {{ date('Y') }}. Semua hak dilindungi.
    </footer>
</body>
</html>