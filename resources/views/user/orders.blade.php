<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --maroon: #54232b;
            --maroon-light: #78404a;
            --gold: #b99556;
            --gold-light: #f1e6d7;
            --background: #f7f3ed;
            --white: #fffdf9;
            --text: #302526;
            --muted: #8a7d79;
            --border: #ece2d7;
            --green: #346441;
            --red: #a33333;
            --blue: #315c86;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

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
        .sidebar a.active { background: var(--maroon-light); }

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
        }

        .logout button:hover { background: var(--maroon-light); }

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
            color: var(--maroon);
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

        .user-chip strong { display: block; font-size: 12px; }
        .user-chip small { color: var(--muted); font-size: 11px; }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 28px 0 15px;
        }

        .section-heading h2 {
            margin: 0;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
        }

        .section-heading p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s;
        }

        .btn-primary { background: var(--maroon); color: white; }
        .btn-primary:hover { background: var(--maroon-light); }
        .btn-gold { background: var(--gold-light); color: var(--maroon); }
        .btn-gold:hover { background: #e9d7bc; }
        .btn-red { border: 1px solid #e8caca; background: #fff0f0; color: var(--red); }
        .btn-red:hover { background: #f9dfdf; }
        .btn-green { background: #e4f1e5; color: var(--green); }
        .btn-green:hover { background: #d1e8d4; }
        .btn:disabled { opacity: .6; cursor: not-allowed; }

        .alert {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.7;
        }

        .alert-success { border: 1px solid #c8dfcb; background: #edf7ee; color: var(--green); }
        .alert-error { border: 1px solid #e8caca; background: #fff0f0; color: var(--red); }
        .alert ul { margin: 7px 0 0; padding-left: 20px; }

        .order-card {
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            transition: box-shadow .2s;
        }

        .order-card:hover { box-shadow: 0 8px 22px rgba(84, 35, 43, .07); }

        .order-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            background: #f4ece4;
        }

        .invoice {
            color: var(--maroon);
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .order-date { margin-top: 4px; color: var(--muted); font-size: 11px; }

        .statuses { display: flex; flex-wrap: wrap; gap: 7px; }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 10px;
            font-weight: 700;
        }

        .badge-green { background: #e4f1e5; color: var(--green); }
        .badge-red { background: #fff0f0; color: var(--red); }
        .badge-blue { background: #e8f0f8; color: var(--blue); }

        .order-body { padding: 20px; }

        .order-body h3 {
            margin: 0 0 12px;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 17px;
            font-weight: normal;
        }

        .item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #f0e8df;
        }

        .item-name { color: var(--text); font-size: 12px; font-weight: 700; overflow-wrap: anywhere; }
        .item-quantity { margin-top: 4px; color: var(--muted); font-size: 11px; }
        .item-price { color: var(--maroon); font-size: 12px; font-weight: 800; text-align: right; white-space: nowrap; }

        .total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px;
            margin-top: 15px;
            border-radius: 10px;
            background: var(--gold-light);
        }

        .total span { color: var(--maroon); font-size: 12px; font-weight: 700; }
        .total strong {
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 21px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 15px;
        }

        .detail-box {
            min-width: 0;
            padding: 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fffefa;
            overflow-wrap: anywhere;
        }

        .detail-label { margin-bottom: 5px; color: var(--muted); font-size: 11px; }
        .detail-value { color: var(--text); font-size: 12px; font-weight: 600; }

        .upload {
            padding: 17px;
            margin-top: 17px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #faf6f0;
        }

        .upload h3 { margin-bottom: 5px; }

        .upload p {
            margin-bottom: 10px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            font-size: 11px;
        }

        .proof-status {
            padding: 10px 12px;
            margin: 10px 0;
            border-radius: 8px;
            background: #edf7ee;
            color: var(--green);
            font-size: 11px;
            line-height: 1.7;
        }

        .info-note {
            padding: 13px;
            margin-top: 15px;
            border-radius: 9px;
            background: #f4ece4;
            color: var(--maroon);
            font-size: 11px;
            line-height: 1.8;
        }

        .order-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 16px;
            margin-top: 17px;
            border-top: 1px solid var(--border);
        }

        .cancelled {
            padding: 13px;
            margin-top: 15px;
            border-radius: 9px;
            background: #f3eee8;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .empty-state {
            padding: 45px 20px;
            border: 1px dashed #d9c8b4;
            border-radius: 13px;
            background: var(--white);
            text-align: center;
        }

        .empty-icon {
            display: grid;
            place-items: center;
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            border-radius: 18px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 29px;
        }

        .empty-state h3 {
            margin: 0 0 8px;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: normal;
        }

        .empty-state p {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .pagination { margin-top: 20px; }
        .footer { padding: 25px 0 5px; color: #9a8d86; text-align: center; font-size: 11px; }

        @media (max-width: 800px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .logout { position: static; margin-top: 15px; }
            .main { margin-left: 0; padding: 20px; }
        }

        @media (max-width: 550px) {
            .topbar { align-items: flex-start; flex-direction: column; }
            .section-heading { align-items: flex-start; flex-direction: column; }
            .details { grid-template-columns: 1fr; }
            .statuses { align-items: flex-start; flex-direction: column; }
            .order-header, .order-body { padding: 15px; }
            .order-actions .btn, .upload form .btn { width: 100%; }
            .total strong { font-size: 17px; }
            h1 { font-size: 26px; }
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

        <a href="{{ route('user.dashboard') }}">
            <span class="nav-icon">⌂</span>
            Beranda
        </a>

        <a href="{{ route('cart.index') }}">
            <span class="nav-icon">🛒</span>
            Keranjang
        </a>

        <a href="{{ route('user.orders') }}" class="active">
            <span class="nav-icon">▤</span>
            Pesanan Saya
        </a>

        <div class="nav-title">AKUN</div>

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Pesanan Saya</h1>
                <div class="muted">
                    Pantau status pembayaran dan rincian pesanan skincare kamu.
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

        <section class="section-heading">
            <div>
                <h2>Daftar Pesanan 📦</h2>
                <p>Semua pesanan skincare yang kamu buat akan ditampilkan di sini.</p>
            </div>

            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                + Belanja Lagi
            </a>
        </section>

        @forelse ($orders as $order)

            @php
                $orderStatus = $order->order_status ?? 'pending';
                $paymentStatus = $order->payment_status ?? 'pending';
                $paymentMethod = $order->payment_method ?? 'cash';

                $orderLabels = [
                    'pending' => 'Menunggu Diproses',
                    'processing' => 'Sedang Diproses',
                    'shipped' => 'Dalam Pengiriman',
                    'received' => 'Barang Diterima',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ];

                $paymentLabels = [
                    'pending' => 'Menunggu Pembayaran',
                    'waiting_confirmation' => 'Menunggu Konfirmasi',
                    'paid' => 'Lunas',
                ];

                $paymentMethodLabels = [
                    'cash' => 'Tunai',
                    'cod' => 'COD (Bayar Saat Diterima)',
                    'transfer' => 'Transfer Bank',
                    'qris' => 'QRIS',
                    'ewallet' => 'E-Wallet',
                ];

                $requiresProof = in_array($paymentMethod, ['transfer', 'qris', 'ewallet']);
                $canUploadProof = $requiresProof
                    && $orderStatus === 'pending'
                    && $paymentStatus !== 'paid';
                $canCancel = $orderStatus === 'pending'
                    && $paymentStatus !== 'paid';
            @endphp

            <article class="order-card">

                <div class="order-header">
                    <div>
                        <div class="invoice">{{ $order->invoice_number }}</div>
                        <div class="order-date">
                            Tanggal pesanan:
                            {{ $order->sale_date ? \Carbon\Carbon::parse($order->sale_date)->format('d-m-Y') : '-' }}
                        </div>
                    </div>

                    <div class="statuses">
                        <span class="badge
                            {{ $orderStatus === 'completed' ? 'badge-green' : '' }}
                            {{ $orderStatus === 'cancelled' ? 'badge-red' : '' }}
                            {{ in_array($orderStatus, ['shipped', 'received']) ? 'badge-blue' : '' }}">
                            Pesanan: {{ $orderLabels[$orderStatus] ?? ucfirst(str_replace('_', ' ', $orderStatus)) }}
                        </span>

                        <span class="badge
                            {{ $paymentStatus === 'paid' ? 'badge-green' : '' }}
                            {{ $paymentStatus === 'waiting_confirmation' ? 'badge-blue' : '' }}">
                            Pembayaran: {{ $paymentLabels[$paymentStatus] ?? ucfirst(str_replace('_', ' ', $paymentStatus)) }}
                        </span>
                    </div>
                </div>

                <div class="order-body">

                    <h3>Rincian Produk</h3>

                    @forelse ($order->items as $item)
                        <div class="item">
                            <div>
                                <div class="item-name">
                                    {{ $item->product->name ?? 'Produk tidak tersedia' }}
                                </div>
                                <div class="item-quantity">
                                    {{ $item->quantity }} ×
                                    Rp{{ number_format((float) $item->selling_price, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="item-price">
                                Rp{{ number_format((float) $item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @empty
                        <p class="muted">Tidak ada rincian produk untuk pesanan ini.</p>
                    @endforelse

                    <div class="total">
                        <span>Total Pembayaran</span>
                        <strong>
                            Rp{{ number_format((float) $order->total, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="details">
                        <div class="detail-box">
                            <div class="detail-label">Metode Pembayaran</div>
                            <div class="detail-value">
                                {{ $paymentMethodLabels[$paymentMethod] ?? ucfirst($paymentMethod) }}
                            </div>
                        </div>

                        <div class="detail-box">
                            <div class="detail-label">Catatan Pesanan</div>
                            <div class="detail-value">
                                {{ $order->notes ?: 'Tidak ada catatan.' }}
                            </div>
                        </div>
                    </div>

                    @if ($canUploadProof)
                        <div class="upload">
                            <h3>
                                @if ($order->transfer_proof)
                                    Bukti Pembayaran Sudah Dikirim
                                @else
                                    Upload Bukti Pembayaran
                                @endif
                            </h3>

                            <p>
                                Unggah bukti pembayaran untuk metode
                                {{ $paymentMethodLabels[$paymentMethod] ?? $paymentMethod }}.
                                Format yang diterima JPG, JPEG, PNG, atau WEBP,
                                dengan ukuran maksimal 2 MB.
                            </p>

                            @if ($order->transfer_proof)
                                <div class="proof-status">
                                    ✓ Bukti pembayaran sudah diunggah.
                                    Menunggu pemeriksaan Admin atau Staff.
                                    Jika bukti perlu diganti, kamu bisa mengunggahnya kembali selama pesanan belum diproses.
                                </div>
                            @endif

                            <form
                                action="{{ route('user.orders.transfer-proof', $order) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf

                                <input
                                    type="file"
                                    name="transfer_proof"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    required
                                >

                                <button type="submit" class="btn btn-primary">
                                    {{ $order->transfer_proof ? 'Ganti Bukti Pembayaran' : 'Kirim Bukti Pembayaran' }}
                                </button>
                            </form>
                        </div>
                    @elseif ($requiresProof && $paymentStatus === 'waiting_confirmation')
                        <div class="proof-status">
                            Bukti pembayaran sudah dikirim dan sedang diperiksa oleh Admin atau Staff.
                        </div>
                    @elseif ($requiresProof && $paymentStatus === 'paid')
                        <div class="proof-status">
                            Pembayaran sudah dikonfirmasi dan dinyatakan lunas.
                        </div>
                    @endif

                    @if ($orderStatus === 'pending' && $paymentMethod === 'cod')
                        <div class="info-note">
                            <strong>Informasi COD:</strong>
                            Pembayaran dilakukan saat pesanan diterima.
                            Tunggu Admin atau Staff memproses pesananmu.
                        </div>
                    @endif

                    @if ($orderStatus === 'shipped')
                        <div class="info-note">
                            Pesanan sedang dalam pengiriman.
                            Tekan tombol <strong>Pesanan Diterima</strong> setelah barang benar-benar kamu terima.
                        </div>

                        <div class="order-actions">
                            <form
                                action="{{ route('user.orders.received', $order) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah barang sudah benar-benar kamu terima?')"
                            >
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-green">
                                    ✓ Pesanan Diterima
                                </button>
                            </form>
                        </div>
                    @elseif ($orderStatus === 'received')
                        <div class="info-note">
                            Barang sudah kamu tandai diterima.
                            Pesanan menunggu Admin atau Staff menyelesaikan prosesnya.
                            Untuk COD, pembayaran akan ditandai lunas saat pesanan diselesaikan.
                        </div>
                    @elseif ($orderStatus === 'completed')
                        <div class="proof-status">
                            ✓ Pesanan sudah selesai.
                            @if ($paymentStatus === 'paid')
                                Pembayaran telah dinyatakan lunas.
                            @endif
                        </div>
                    @elseif ($orderStatus === 'cancelled')
                        <div class="cancelled">
                            Pesanan ini sudah dibatalkan.
                            Stok barang telah dikembalikan sesuai proses pembatalan.
                        </div>
                    @endif

                    @if ($canCancel)
                        <div class="order-actions">
                            <form
                                action="{{ route('user.orders.cancel', $order) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')"
                            >
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-red">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </article>

        @empty

            <section class="empty-state">
                <div class="empty-icon">🛍️</div>
                <h3>Belum Ada Pesanan</h3>
                <p>
                    Pesanan skincare yang kamu buat akan muncul di halaman ini.
                    Yuk, temukan produk perawatan kulit favoritmu di Ranitha Stuff.
                </p>
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                    Mulai Belanja →
                </a>
            </section>

        @endforelse

        @if (method_exists($orders, 'links'))
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @endif

        <footer class="footer">
            Ranitha Stuff &copy; {{ date('Y') }}. Semua hak dilindungi.
        </footer>

    </main>

</body>
</html>