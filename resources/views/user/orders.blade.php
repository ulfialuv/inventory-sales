<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Inventory Sales</title>
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
            line-height: 1.6;
        }

        a { text-decoration: none; }
        button, input { font: inherit; }

        .navbar { background: var(--green); padding: 14px 5%; }

        .navbar-inner {
            max-width: 1050px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .brand { color: white; font-size: 20px; font-weight: 900; }
        .brand small { display: block; color: #d5e5d8; font-size: 11px; font-weight: 600; }
        .container { width: min(1050px, 92%); margin: 28px auto 40px; }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        h1 { color: var(--green); font-size: 26px; font-weight: 900; }
        .subtitle { color: var(--muted); font-size: 13px; margin-top: 3px; }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 9px 14px;
            border: 0;
            border-radius: 10px;
            background: var(--green);
            color: white;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn:hover { filter: brightness(1.1); }
        .btn-light { background: white; color: var(--green); border: 1px solid var(--border); }
        .btn-red { background: #fff0ee; color: var(--red); }

        .notice { padding: 12px 15px; border-radius: 10px; margin-bottom: 14px; font-size: 13px; }
        .success { background: #e6f5e8; color: #28663c; border: 1px solid #cce9d1; }
        .error { background: #fff0ee; color: #a43d3d; border: 1px solid #f5d5d1; }

        .order-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 17px;
            overflow: hidden;
            box-shadow: 0 4px 16px #294b350b;
        }

        .order-header {
            padding: 16px 19px;
            background: #f1f6ef;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .invoice { color: var(--green); font-size: 14px; font-weight: 900; overflow-wrap: anywhere; }
        .muted { color: var(--muted); font-size: 11px; margin-top: 3px; }
        .statuses { display: flex; flex-wrap: wrap; gap: 6px; }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: var(--sage);
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
        }

        .order-body { padding: 18px 19px; }
        h3 { color: var(--green); font-size: 14px; font-weight: 900; margin-bottom: 9px; }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid #edf0eb;
        }

        .item-name { font-size: 12px; font-weight: 800; }
        .item-price { color: var(--green); font-size: 12px; font-weight: 900; text-align: right; }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 13px;
            margin-top: 13px;
            border-radius: 10px;
            background: var(--sage);
        }

        .total span { font-size: 12px; font-weight: 800; }
        .total strong { color: var(--green); font-size: 17px; text-align: right; overflow-wrap: anywhere; }

        .details { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 12px; }

        .detail-box { padding: 11px; border: 1px solid var(--border); border-radius: 10px; overflow-wrap: anywhere; }
        .detail-label { color: var(--muted); font-size: 10px; margin-bottom: 3px; }
        .detail-value { font-size: 12px; font-weight: 700; }

        .upload { margin-top: 14px; padding: 14px; border: 1px solid var(--border); border-radius: 11px; background: #f8faf6; }
        .upload p { color: var(--muted); font-size: 11px; margin-bottom: 8px; }

        input[type="file"] {
            display: block;
            width: 100%;
            padding: 9px;
            margin: 9px 0;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            font-size: 11px;
        }

        .proof-status { color: #28663c; font-size: 11px; margin: 7px 0; }
        .order-actions { margin-top: 15px; padding-top: 13px; border-top: 1px solid var(--border); }

        .cancelled { margin-top: 13px; padding: 11px; border-radius: 9px; background: #f3f4f0; color: var(--muted); font-size: 11px; }

        .empty {
            padding: 40px 18px;
            text-align: center;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 13px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            background: var(--sage);
            font-size: 29px;
        }

        .empty h2 { color: var(--green); font-size: 19px; margin-bottom: 6px; }
        .empty p { color: var(--muted); font-size: 12px; margin-bottom: 15px; }

        /* Pagination: hilangkan tombol panah dan teks informasi */
        .pagination { margin-top: 20px; }
        .pagination nav > div:first-child { display: none !important; }
        .pagination nav svg { display: none !important; }

        .pagination nav a,
        .pagination nav button {
            font-size: 0 !important;
        }

        .pagination nav a[aria-label*="Previous"],
        .pagination nav a[aria-label*="Next"],
        .pagination nav button[aria-label*="Previous"],
        .pagination nav button[aria-label*="Next"],
        .pagination nav a[aria-label*="previous"],
        .pagination nav a[aria-label*="next"],
        .pagination nav button[aria-label*="previous"],
        .pagination nav button[aria-label*="next"] {
            display: none !important;
        }

        .pagination nav > div:last-child {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination nav a,
        .pagination nav span[aria-current="page"] span {
            min-width: 32px;
            height: 32px;
            padding: 5px 10px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--green);
            font-size: 12px !important;
        }

        .pagination nav span[aria-current="page"] span {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        .pagination nav a:hover { background: var(--sage); }
        footer { padding: 20px 12px; color: var(--muted); text-align: center; font-size: 11px; }

        @media (max-width: 600px) {
            .navbar { padding: 13px 4%; }
            .brand { font-size: 18px; }
            .container { margin-top: 22px; }
            h1 { font-size: 22px; }
            .heading > .btn { width: 100%; }
            .order-header, .order-body { padding: 14px; }
            .details { grid-template-columns: 1fr; }
            .order-actions .btn { width: 100%; }
            .total strong { font-size: 15px; }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('user.dashboard') }}" class="brand">
                🌿 Inventory Sales
                <small>Belanja dan pantau pesananmu</small>
            </a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-light">← Kembali Belanja</a>
        </div>
    </header>

    <main class="container">
        <div class="heading">
            <div>
                <h1>Pesanan Saya 📦</h1>
                <p class="subtitle">Pantau status dan rincian pesananmu di sini.</p>
            </div>
            <a href="{{ route('user.dashboard') }}" class="btn">+ Belanja Lagi</a>
        </div>

        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="notice error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="notice error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @forelse ($orders as $order)
            <article class="order-card">
                <div class="order-header">
                    <div>
                        <div class="invoice">{{ $order->invoice_number }}</div>
                        <div class="muted">Tanggal: {{ $order->sale_date }}</div>
                    </div>
                    <div class="statuses">
                        <span class="badge">Pesanan: {{ ucfirst(str_replace('_', ' ', $order->order_status ?? 'pending')) }}</span>
                        <span class="badge">Pembayaran: {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'pending')) }}</span>
                    </div>
                </div>

                <div class="order-body">
                    <h3>Rincian Produk</h3>

                    @foreach ($order->items as $item)
                        <div class="item">
                            <div>
                                <div class="item-name">{{ $item->product->name ?? 'Produk tidak tersedia' }}</div>
                                <div class="muted">{{ $item->quantity }} × Rp{{ number_format($item->selling_price, 0, ',', '.') }}</div>
                            </div>
                            <div class="item-price">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endforeach

                    <div class="total">
                        <span>Total Pembayaran</span>
                        <strong>Rp{{ number_format($order->total, 0, ',', '.') }}</strong>
                    </div>

                    <div class="details">
                        <div class="detail-box">
                            <div class="detail-label">Metode Pembayaran</div>
                            <div class="detail-value">{{ $order->payment_method === 'transfer' ? 'Transfer Bank' : 'Tunai' }}</div>
                        </div>
                        <div class="detail-box">
                            <div class="detail-label">Catatan</div>
                            <div class="detail-value">{{ $order->notes ?: 'Tidak ada catatan.' }}</div>
                        </div>
                    </div>

                    @if ($order->payment_method === 'transfer' && $order->payment_status !== 'paid' && $order->order_status === 'pending')
                        <div class="upload">
                            <h3>Upload Bukti Transfer</h3>
                            <p>Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</p>

                            @if ($order->transfer_proof)
                                <div class="proof-status">✓ Bukti transfer sudah diunggah dan menunggu pemeriksaan.</div>
                            @endif

                            <form action="{{ route('user.orders.transfer-proof', $order) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="transfer_proof" accept=".jpg,.jpeg,.png,.webp" required>
                                <button type="submit" class="btn">
                                    {{ $order->transfer_proof ? 'Ganti Bukti Transfer' : 'Kirim Bukti Transfer' }}
                                </button>
                            </form>
                        </div>
                    @endif

                    @if ($order->order_status === 'pending' && $order->payment_status !== 'paid')
                        <div class="order-actions">
                            <form action="{{ route('user.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini? Stok barang akan dikembalikan.')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-red">Batalkan Pesanan</button>
                            </form>
                        </div>
                    @elseif ($order->order_status === 'cancelled')
                        <div class="cancelled">Pesanan ini sudah dibatalkan. Jika belum lunas, stok barang telah dikembalikan.</div>
                    @endif
                </div>
            </article>
        @empty
            <div class="empty">
                <div class="empty-icon">🛍️</div>
                <h2>Belum Ada Pesanan</h2>
                <p>Pesanan yang kamu buat akan muncul di halaman ini.</p>
                <a href="{{ route('user.dashboard') }}" class="btn">Mulai Belanja →</a>
            </div>
        @endforelse

        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </main>

    <footer>Inventory Sales &copy; {{ date('Y') }}. Semua hak dilindungi.</footer>
</body>
</html>