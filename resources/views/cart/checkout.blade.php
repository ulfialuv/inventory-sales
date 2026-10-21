<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Inventory Sales</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --green: #426B50;
            --green-dark: #2F503C;
            --green-light: #E9F0E8;
            --sage: #D7E3D5;
            --cream: #F7F5ED;
            --white: #FFFFFF;
            --text: #303A32;
            --muted: #7B837A;
            --border: #E2E8DF;
            --red: #C74747;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            background: var(--green-dark);
            color: white;
            padding: 17px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            box-shadow: 0 3px 12px rgba(42, 70, 46, .10);
        }

        .brand {
            color: white;
            font-size: 21px;
            font-weight: bold;
            letter-spacing: .2px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 23px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #F2F6F0;
            font-size: 13px;
            transition: .2s;
        }

        .nav-links a:hover {
            color: #C8DCC9;
        }

        .container {
            width: min(1050px, 92%);
            margin: 32px auto 50px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 13px;
        }

        .breadcrumb a {
            color: var(--green);
            font-weight: bold;
        }

        .page-heading h1 {
            font-size: 28px;
            color: var(--green-dark);
            margin-bottom: 9px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .steps {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #92988F;
            font-size: 12px;
            font-weight: bold;
        }

        .step-number {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #E9E9DF;
            color: #777D73;
        }

        .step.active {
            color: var(--green-dark);
        }

        .step.active .step-number {
            color: white;
            background: var(--green);
        }

        .step-line {
            height: 1px;
            width: 35px;
            background: #D9DFD4;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(45, 65, 43, .04);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            padding: 20px 23px;
            border-bottom: 1px solid var(--border);
            background: #FCFBF7;
        }

        .card-header h2 {
            font-size: 17px;
            color: var(--green-dark);
        }

        .card-header p {
            font-size: 12px;
            color: var(--muted);
            margin-top: 6px;
            line-height: 1.6;
        }

        .card-body {
            padding: 22px 23px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #EDF0E9;
        }

        .item:first-child {
            padding-top: 0;
        }

        .item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .item-name {
            font-size: 13px;
            font-weight: bold;
            line-height: 1.6;
        }

        .item-detail {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
            margin-top: 4px;
        }

        .item-price {
            font-size: 13px;
            font-weight: bold;
            color: var(--green-dark);
            white-space: nowrap;
        }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            border-top: 1px dashed #D6E0D4;
            padding-top: 19px;
            margin-top: 21px;
        }

        .total span {
            font-size: 13px;
            font-weight: bold;
        }

        .total strong {
            color: var(--green-dark);
            font-size: 20px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .form-group {
            margin-bottom: 21px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .required {
            color: var(--red);
        }

        select,
        textarea,
        input[type="file"] {
            display: block;
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #D6E0D4;
            border-radius: 8px;
            font: inherit;
            font-size: 13px;
            color: var(--text);
            background: white;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        select:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(66, 107, 80, .12);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            line-height: 1.7;
        }

        .helper {
            font-size: 11px;
            color: var(--muted);
            margin-top: 7px;
            line-height: 1.7;
        }

        .payment-info {
            display: none;
            padding: 13px 14px;
            border-radius: 9px;
            background: var(--green-light);
            color: var(--green-dark);
            font-size: 12px;
            line-height: 1.8;
            margin-top: 11px;
        }

        .payment-info.show {
            display: block;
        }

        #transfer-upload-group {
            display: none;
            padding: 16px;
            background: #F8FAF6;
            border: 1px solid #DCE6D9;
            border-radius: 10px;
            margin-top: 14px;
        }

        #transfer-upload-group.show {
            display: block;
        }

        .upload-note {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .error {
            background: #FFF0EE;
            color: #9C302B;
            border: 1px solid #F2D0CA;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.8;
        }

        .error ul {
            padding-left: 20px;
            margin-top: 7px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s, transform .2s;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .primary {
            background: var(--green);
            color: white;
        }

        .primary:hover {
            background: var(--green-dark);
        }

        .secondary {
            background: white;
            color: var(--green-dark);
            border: 1px solid #D6E0D4;
        }

        .secondary:hover {
            background: #F1F5EF;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .summary-card {
            position: sticky;
            top: 20px;
        }

        .summary-body {
            padding: 22px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 12px;
            color: var(--muted);
        }

        .summary-row strong {
            color: var(--text);
            text-align: right;
        }

        .summary-divider {
            border: none;
            border-top: 1px dashed #D6E0D4;
            margin: 19px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 21px;
        }

        .summary-total span {
            font-size: 13px;
            font-weight: bold;
        }

        .summary-total strong {
            font-size: 20px;
            color: var(--green-dark);
            text-align: right;
            overflow-wrap: anywhere;
        }

        .submit-button {
            width: 100%;
            padding: 14px;
            font-size: 13px;
        }

        .summary-note {
            margin-top: 13px;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.8;
            text-align: center;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: var(--green);
            font-size: 12px;
            font-weight: bold;
        }

        .back-link:hover {
            color: var(--green-dark);
        }

        footer {
            text-align: center;
            color: #858B80;
            padding: 25px 15px;
            font-size: 11px;
        }

        @media (max-width: 850px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 16px 5%;
            }

            .brand {
                font-size: 19px;
            }

            .nav-links {
                gap: 14px;
            }

            .nav-links a {
                font-size: 12px;
            }

            .container {
                margin-top: 24px;
            }

            .page-heading h1 {
                font-size: 24px;
            }

            .card-header,
            .card-body {
                padding: 17px;
            }

            .item {
                gap: 10px;
            }

            .item-price {
                font-size: 12px;
            }

            .actions .button {
                width: 100%;
            }

            .steps {
                gap: 8px;
            }

            .step {
                gap: 5px;
                font-size: 11px;
            }

            .step-line {
                width: 15px;
            }
        }
    </style>
</head>

<body>

<header class="navbar">
    <a href="{{ route('user.dashboard') }}" class="brand">
        Inventory Sales
    </a>

    <nav class="nav-links">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('cart.index') }}">Keranjang</a>
        <a href="{{ route('user.orders') }}">Pesanan Saya</a>
    </nav>
</header>

<main class="container">

    <div class="page-heading">
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}">Beranda</a>
            &nbsp; / &nbsp;
            <a href="{{ route('cart.index') }}">Keranjang</a>
            &nbsp; / &nbsp;
            Checkout
        </div>

        <h1>Checkout Pesanan</h1>
        <p>Periksa pesanan dan lengkapi informasi pembayaran sebelum membuat pesanan.</p>

        <div class="steps">
            <div class="step">
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
    </div>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data kamu:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">

        <div>
            <section class="card">
                <div class="card-header">
                    <h2>🛍️ Ringkasan Pesanan</h2>
                    <p>Pastikan produk dan jumlah pembelian sudah benar.</p>
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
                        <p class="item-detail">
                            Keranjang kamu masih kosong.
                        </p>
                    @endforelse

                    <div class="total">
                        <span>Total Belanja</span>
                        <strong>
                            Rp{{ number_format((float) $total, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <h2>💳 Informasi Pembayaran</h2>
                    <p>Pilih metode pembayaran yang akan kamu gunakan.</p>
                </div>

                <div class="card-body">
                    <form
                        id="checkout-form"
                        action="{{ route('cart.placeOrder') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="form-group">
                            <label for="payment_method">
                                Metode Pembayaran
                                <span class="required">*</span>
                            </label>

                            <select
                                name="payment_method"
                                id="payment_method"
                                required
                            >
                                <option
                                    value="cash"
                                    {{ old('payment_method', 'cash') === 'cash' ? 'selected' : '' }}
                                >
                                    Bayar Tunai
                                </option>

                                <option
                                    value="transfer"
                                    {{ old('payment_method') === 'transfer' ? 'selected' : '' }}
                                >
                                    Transfer Bank
                                </option>
                            </select>

                            <div id="cash-info" class="payment-info">
                                <strong>Pembayaran tunai</strong><br>
                                Silakan ikuti petunjuk pembayaran tunai yang diberikan oleh pihak toko.
                            </div>

                            <div id="transfer-info" class="payment-info">
                                <strong>Pembayaran melalui transfer bank</strong><br>
                                Lakukan transfer sesuai informasi rekening dari pihak toko.
                                Setelah melakukan pembayaran, unggah bukti transfer di bawah ini.
                            </div>
                        </div>

                        <div id="transfer-upload-group" class="form-group">
                            <label for="transfer_proof">
                                Upload Bukti Transfer
                                <span class="required">*</span>
                            </label>

                            <p class="upload-note">
                                Pilih foto atau dokumen bukti pembayaran.
                                Pastikan tulisan dan nominal transfer dapat dibaca dengan jelas.
                            </p>

                            <input
                                type="file"
                                name="transfer_proof"
                                id="transfer_proof"
                                accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                            >

                            <p class="helper">
                                Format JPG, JPEG, PNG, atau PDF. Ukuran maksimal 2 MB.
                            </p>

                            @if ($errors->has('transfer_proof'))
                                <p class="helper" style="color: #C74747;">
                                    {{ $errors->first('transfer_proof') }}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="notes">
                                Catatan Pesanan
                                <span style="font-weight: normal; color: #858B80;">
                                    (Opsional)
                                </span>
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

                        <div class="actions">
                            <a href="{{ route('cart.index') }}"
                               class="button secondary">
                                ← Kembali ke Keranjang
                            </a>

                            <button type="submit" class="button primary">
                                Buat Pesanan →
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <aside class="card summary-card">
            <div class="card-header">
                <h2>Ringkasan Pembayaran</h2>
                <p>Detail total pesanan kamu.</p>
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

                <hr class="summary-divider">

                <div class="summary-total">
                    <span>Total Pembayaran</span>
                    <strong>
                        Rp{{ number_format((float) $total, 0, ',', '.') }}
                    </strong>
                </div>

                <button
                    type="submit"
                    form="checkout-form"
                    class="button primary submit-button"
                >
                    Buat Pesanan →
                </button>

                <p class="summary-note">
                    Pastikan metode pembayaran dan bukti transfer sudah sesuai sebelum mengirim pesanan.
                </p>

                <a href="{{ route('cart.index') }}" class="back-link">
                    ← Ubah isi keranjang
                </a>
            </div>
        </aside>

    </div>
</main>

<footer>
    Inventory Sales &copy; {{ date('Y') }}. Semua hak dilindungi.
</footer>

<script>
    const paymentSelect = document.getElementById('payment_method');
    const cashInfo = document.getElementById('cash-info');
    const transferInfo = document.getElementById('transfer-info');
    const transferUploadGroup = document.getElementById('transfer-upload-group');
    const transferProof = document.getElementById('transfer_proof');
    const checkoutForm = document.getElementById('checkout-form');

    function updatePaymentInfo() {
        const isTransfer = paymentSelect.value === 'transfer';

        cashInfo.classList.toggle('show', !isTransfer);
        transferInfo.classList.toggle('show', isTransfer);
        transferUploadGroup.classList.toggle('show', isTransfer);

        transferProof.required = isTransfer;

        if (!isTransfer) {
            transferProof.value = '';
        }
    }

    paymentSelect.addEventListener('change', updatePaymentInfo);
    updatePaymentInfo();

    checkoutForm.addEventListener('submit', function (event) {
        if (paymentSelect.value !== 'transfer') {
            return;
        }

        if (!transferProof.files.length) {
            event.preventDefault();
            alert('Silakan upload bukti transfer terlebih dahulu.');
            transferProof.focus();
            return;
        }

        const file = transferProof.files[0];
        const maxSize = 2 * 1024 * 1024;
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf'
        ];

        if (!allowedTypes.includes(file.type)) {
            event.preventDefault();
            alert('Format file harus JPG, JPEG, PNG, atau PDF.');
            transferProof.value = '';
            transferProof.focus();
            return;
        }

        if (file.size > maxSize) {
            event.preventDefault();
            alert('Ukuran file maksimal 2 MB.');
            transferProof.value = '';
            transferProof.focus();
        }
    });
</script>

</body>
</html>