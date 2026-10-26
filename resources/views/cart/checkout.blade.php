<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pesanan | Inventory Sales</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --maroon: #54232b;
            --maroon-light: #78404a;
            --maroon-dark: #3d1820;
            --gold: #b99556;
            --gold-light: #f1e6d7;
            --background: #f7f3ed;
            --white: #fffdf9;
            --text: #302526;
            --muted: #8a7d79;
            --border: #ece2d7;
            --green: #346441;
            --red: #a33333;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }

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
            transition: background .2s;
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

        .alert {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.7;
        }

        .alert-success {
            border: 1px solid #c8dfcb;
            background: #edf7ee;
            color: var(--green);
        }

        .alert-error {
            border: 1px solid #e8caca;
            background: #fff0f0;
            color: var(--red);
        }

        .alert ul { margin: 7px 0 0; padding-left: 20px; }

        .page-heading { margin-bottom: 23px; }

        .breadcrumb {
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 11px;
        }

        .breadcrumb a {
            color: var(--maroon-light);
            font-weight: 600;
        }

        .page-heading h2 {
            margin: 0;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 22px;
            font-weight: normal;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .steps {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a39a94;
            font-size: 11px;
            font-weight: 600;
        }

        .step-number {
            display: grid;
            place-items: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #eee7df;
            color: var(--muted);
        }

        .step.active { color: var(--maroon); }
        .step.active .step-number { background: var(--maroon); color: white; }
        .step.done { color: var(--green); }
        .step.done .step-number { background: #e1eee2; color: var(--green); }

        .step-line {
            width: 35px;
            height: 1px;
            background: #dfd2c5;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 15px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s, transform .2s;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--maroon); color: white; }
        .btn-primary:hover { background: var(--maroon-light); }
        .btn-gold { background: var(--gold-light); color: var(--maroon); }
        .btn-gold:hover { background: #e9d7bc; }
        .btn-full { width: 100%; padding: 13px; font-size: 13px; }

        .checkout-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            gap: 18px;
            align-items: start;
        }

        .left-column { min-width: 0; }

        .card {
            min-width: 0;
            margin-bottom: 18px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(84, 35, 43, .035);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding: 19px 20px;
            border-bottom: 1px solid var(--border);
            background: #fffdf9;
        }

        .card-header h2,
        .summary-body h2 {
            margin: 0;
            color: var(--maroon);
            font-family: Georgia, serif;
            font-size: 19px;
            font-weight: normal;
        }

        .card-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .card-body { padding: 21px 20px; }

        .count {
            padding: 7px 11px;
            border-radius: 20px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0e8df;
        }

        .item:first-child { padding-top: 0; }
        .item:last-child { padding-bottom: 0; border-bottom: none; }

        .item-name {
            color: var(--maroon);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .item-detail {
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.8;
        }

        .item-price {
            color: var(--maroon);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .total-products {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px dashed #ddcdbb;
        }

        .total-products span { font-size: 12px; font-weight: 700; }

        .total-products strong {
            color: var(--maroon);
            font-size: 18px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .form-group { margin-bottom: 21px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .required { color: var(--red); }

        .optional {
            color: var(--muted);
            font-size: 11px;
            font-weight: normal;
        }

        select, textarea {
            display: block;
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: inherit;
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
        }

        select:focus, textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(185, 149, 86, .12);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
            line-height: 1.7;
        }

        .helper {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.8;
        }

        .payment-info {
            display: none;
            margin-top: 12px;
            padding: 13px 14px;
            border: 1px solid #e6d5b9;
            border-radius: 9px;
            background: var(--gold-light);
            color: var(--maroon);
            font-size: 11px;
            line-height: 1.8;
        }

        .payment-info.show { display: block; }

        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .summary { position: sticky; top: 20px; }
        .summary-body { padding: 21px; }
        .summary-body h2 { margin-bottom: 23px; }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 12px;
        }

        .summary-row strong {
            color: var(--text);
            text-align: right;
        }

        .divider {
            margin: 20px 0;
            border: 0;
            border-top: 1px dashed #ddcdbb;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 22px;
            font-size: 13px;
            font-weight: 700;
        }

        .summary-total strong {
            color: var(--maroon);
            font-size: 19px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .summary-note {
            margin-top: 13px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.8;
            text-align: center;
        }

        .back-link {
            display: block;
            margin-top: 16px;
            color: var(--maroon-light);
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        .back-link:hover { color: var(--gold); }

        .footer {
            padding: 28px 0 5px;
            color: #9a8d86;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 1200px) {
            .main { padding: 25px 22px; }
            .checkout-layout {
                grid-template-columns: minmax(0, 1fr) 260px;
            }
        }

        @media (max-width: 1000px) {
            .checkout-layout { grid-template-columns: 1fr; }
            .summary { position: static; }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .brand { margin-bottom: 20px; }
            .sidebar .nav-title { margin-top: 17px; }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 22px 20px;
            }
        }

        @media (max-width: 550px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .main { padding: 20px 14px; }
            h1 { font-size: 26px; }

            .card-header, .card-body { padding: 16px; }

            .form-actions { flex-direction: column; }
            .form-actions .btn { width: 100%; }
            .steps { gap: 8px; }
            .step { gap: 5px; font-size: 10px; }
            .step-line { width: 15px; }
            .item { gap: 10px; }
            .item-price { font-size: 11px; }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <h2>Inventory Sales</h2>
                <small>Customer Portal</small>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('user.dashboard') }}">
            <span class="nav-icon">⌂</span>
            Beranda
        </a>

        <a href="{{ route('cart.index') }}" class="active">
            <span class="nav-icon">🛒</span>
            Keranjang
        </a>

        <a href="{{ route('user.orders') }}">
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
                <div class="eyebrow">Inventory Sales</div>
                <h1>Checkout Pesanan</h1>
                <div class="muted">
                    Periksa pesanan dan pilih metode pembayaran sebelum membuat pesanan.
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
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
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

        <section class="page-heading">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}">Beranda</a>
                &nbsp; / &nbsp;
                <a href="{{ route('cart.index') }}">Keranjang</a>
                &nbsp; / &nbsp;
                Checkout
            </div>

            <h2>Penyelesaian Pesanan</h2>
            <p>Pastikan produk dan jumlah pembelian sudah benar sebelum melanjutkan.</p>

            <div class="steps">
                <div class="step done">
                    <span class="step-number">✓</span>
                    Keranjang
                </div>
                <div class="step-line"></div>
                <div class="step active">
                    <span class="step-number">2</span>
                    Checkout
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <span class="step-number">3</span>
                    Selesai
                </div>
            </div>
        </section>

        <div class="checkout-layout">
            <div class="left-column">

                <section class="card">
                    <div class="card-header">
                        <div>
                            <h2>Daftar Belanja</h2>
                            <p>Pastikan produk dan jumlah pembelian sudah sesuai.</p>
                        </div>
                        <span class="count">{{ $items->count() }} jenis produk</span>
                    </div>

                    <div class="card-body">
                        @forelse ($items as $item)
                            <div class="item">
                                <div>
                                    <div class="item-name">
                                        {{ $item['product']->name }}
                                    </div>
                                    <div class="item-detail">
                                        SKU: {{ $item['product']->sku ?? '-' }}
                                        <br>
                                        {{ $item['quantity'] }} ×
                                        Rp{{ number_format((float) $item['product']->selling_price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <strong class="item-price">
                                    Rp{{ number_format((float) $item['subtotal'], 0, ',', '.') }}
                                </strong>
                            </div>
                        @empty
                            <p class="muted">Keranjang kamu masih kosong.</p>
                        @endforelse

                        <div class="total-products">
                            <span>Total Belanja</span>
                            <strong>
                                Rp{{ number_format((float) $total, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                </section>

                <section class="card">
                    <div class="card-header">
                        <div>
                            <h2>Informasi Pembayaran</h2>
                            <p>Pilih metode pembayaran yang akan kamu gunakan.</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <form
                            id="checkout-form"
                            action="{{ route('cart.placeOrder') }}"
                            method="POST"
                        >
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="payment_method">
                                    Metode Pembayaran
                                    <span class="required">*</span>
                                </label>

                                <select name="payment_method" id="payment_method" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="cod"
                                        {{ old('payment_method') === 'cod' ? 'selected' : '' }}>
                                        COD (Bayar Saat Diterima)
                                    </option>
                                    <option value="transfer"
                                        {{ old('payment_method') === 'transfer' ? 'selected' : '' }}>
                                        Transfer Bank
                                    </option>
                                    <option value="qris"
                                        {{ old('payment_method') === 'qris' ? 'selected' : '' }}>
                                        QRIS
                                    </option>
                                    <option value="ewallet"
                                        {{ old('payment_method') === 'ewallet' ? 'selected' : '' }}>
                                        E-Wallet
                                    </option>
                                </select>

                                <div id="cod-info" class="payment-info">
                                    <strong>COD (Cash on Delivery)</strong><br>
                                    Pembayaran dilakukan saat pesanan diterima. Siapkan uang sesuai total pesanan.
                                    Status pembayaran akan diperbarui oleh Admin atau Staff setelah pesanan selesai.
                                </div>

                                <div id="transfer-info" class="payment-info">
                                    <strong>Transfer Bank</strong><br>
                                    Buat pesanan terlebih dahulu, kemudian lakukan transfer mengikuti informasi rekening dari toko.
                                    Setelah itu, buka halaman Pesanan Saya untuk mengunggah bukti transfer.
                                    Pembayaran akan diperiksa secara manual oleh Admin atau Staff.
                                </div>

                                <div id="qris-info" class="payment-info">
                                    <strong>Pembayaran QRIS</strong><br>
                                    Buat pesanan terlebih dahulu. Ikuti informasi pembayaran QRIS yang diberikan oleh toko,
                                    kemudian unggah bukti pembayaran melalui halaman Pesanan Saya.
                                    Pembayaran akan diperiksa oleh Admin atau Staff.
                                </div>

                                <div id="ewallet-info" class="payment-info">
                                    <strong>Pembayaran E-Wallet</strong><br>
                                    Buat pesanan terlebih dahulu. Ikuti petunjuk pembayaran dari toko,
                                    lalu unggah bukti pembayaran melalui halaman Pesanan Saya untuk diperiksa oleh Admin atau Staff.
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="notes">
                                    Catatan Pesanan
                                    <span class="optional">(Opsional)</span>
                                </label>

                                <textarea
                                    name="notes"
                                    id="notes"
                                    maxlength="1000"
                                    placeholder="Contoh: Mohon periksa kondisi produk sebelum dikirim..."
                                >{{ old('notes') }}</textarea>

                                <p class="helper">
                                    Maksimal 1.000 karakter. Kosongkan jika tidak ada catatan.
                                </p>
                            </div>

                            <div class="form-actions">
                                <a href="{{ route('cart.index') }}" class="btn btn-gold">
                                    ← Kembali ke Keranjang
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Buat Pesanan →
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            <aside class="card summary">
                <div class="card-header">
                    <div>
                        <h2>Ringkasan Belanja</h2>
                        <p>Detail total pesanan kamu.</p>
                    </div>
                </div>

                <div class="summary-body">
                    <div class="summary-row">
                        <span>Jenis produk</span>
                        <strong>{{ $items->count() }} produk</strong>
                    </div>

                    <div class="summary-row">
                        <span>Total barang</span>
                        <strong>{{ $items->sum('quantity') }} barang</strong>
                    </div>

                    <hr class="divider">

                    <div class="summary-total">
                        <span>Total Pembayaran</span>
                        <strong>
                            Rp{{ number_format((float) $total, 0, ',', '.') }}
                        </strong>
                    </div>

                    <button
                        type="submit"
                        form="checkout-form"
                        class="btn btn-primary btn-full"
                    >
                        Buat Pesanan →
                    </button>

                    <p class="summary-note">
                        Bukti pembayaran transfer, QRIS, dan e-wallet diunggah setelah pesanan dibuat,
                        melalui halaman Pesanan Saya. Pembayaran perlu dikonfirmasi oleh Admin atau Staff.
                    </p>

                    <a href="{{ route('cart.index') }}" class="back-link">
                        ← Ubah isi keranjang
                    </a>
                </div>
            </aside>
        </div>

        <footer class="footer">
            Inventory Sales &copy; {{ date('Y') }}. Semua hak dilindungi.
        </footer>
    </main>

    <script>
        const paymentSelect = document.getElementById('payment_method');

        const paymentInfos = {
            cod: document.getElementById('cod-info'),
            transfer: document.getElementById('transfer-info'),
            qris: document.getElementById('qris-info'),
            ewallet: document.getElementById('ewallet-info')
        };

        function updatePaymentInfo() {
            const selectedMethod = paymentSelect.value;

            Object.keys(paymentInfos).forEach(function (method) {
                paymentInfos[method].classList.toggle(
                    'show',
                    method === selectedMethod
                );
            });
        }

        paymentSelect.addEventListener('change', updatePaymentInfo);
        updatePaymentInfo();
    </script>
</body>
</html>