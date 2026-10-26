 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan | Inventory Sales</title>

    <style>
        * { box-sizing: border-box; }

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

        /* KONTEN KANAN */
        .main {
            margin-left: 225px;
            padding: 30px 34px;
            max-width: 1600px;
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

        .muted { color: #8a7d79; font-size: 12px; }

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
            font-weight: bold;
            flex-shrink: 0;
        }

        .user-name { font-size: 12px; font-weight: bold; }
        .user-role { font-size: 11px; color: #8a7d79; margin-top: 3px; }

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

        .button:hover { background: #54232b; }

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

        .notice, .error-notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            font-size: 13px;
        }

        .notice { background: #e8f4e8; color: #286338; }
        .error-notice { background: #f9e6e3; color: #a13f38; }

        .summary {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card, .table-panel, .filter-panel {
            padding: 21px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .summary-card { background: #6b3039; color: white; }
        .summary-card small { color: #ead9d5; font-size: 12px; }

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

        .filter-panel { margin-bottom: 20px; }

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

        input {
            width: 100%;
            min-width: 0;
            padding: 11px 12px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            font-family: inherit;
            font-size: 12px;
        }

        input:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .search-form input { flex: 1; }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
        }

        .table-heading h3 { margin: 0; font-size: 15px; }

        .result-info {
            margin: 0 0 14px;
            color: #8a7d79;
            font-size: 12px;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            min-width: 1200px;
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

        tbody tr:hover { background: #fcf8f2; }

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
            white-space: nowrap;
        }

        .status-paid, .status-completed {
            background: #e5f4e8;
            color: #276738;
        }

        .status-pending { background: #fff2d6; color: #8a5a12; }
        .status-cancelled { background: #fde8e7; color: #a12b2b; }

        .status-waiting {
            background: #dcecff;
            color: #24558a;
        }

        .payment-method {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 7px;
            background: #f3e9d9;
            color: #6b3039;
            font-size: 11px;
            font-weight: bold;
        }

        .proof-link {
            display: inline-block;
            color: #75414a;
            font-weight: bold;
            text-decoration: none;
        }

        .proof-link:hover { text-decoration: underline; }
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

        .empty {
            padding: 35px;
            color: #8a7d79;
            text-align: center;
            white-space: normal;
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

        @media (max-width: 1000px) {
            .summary { grid-template-columns: 1fr; }
            .topbar { flex-wrap: wrap; }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding-bottom: 20px;
            }

            .sidebar .nav-title { margin-top: 15px; }
            .sidebar-bottom { margin-top: 15px; }
            .main { margin-left: 0; padding: 20px; }
        }

        @media (max-width: 500px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group { width: 100%; }
            .filter-panel, .table-panel { padding: 13px; }
            .search-form input { flex-basis: 100%; }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR STAFF -->
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

        <a href="{{ route('purchases.index') }}">
            <span class="nav-icon">⇩</span>
            Pembelian
        </a>

        <a href="{{ route('sales.index') }}" class="active">
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

    <!-- KONTEN KANAN -->
    <main class="main">
        <header class="topbar">
            <div>
                <div class="eyebrow">Manajemen Inventory</div>
                <h1>Transaksi Penjualan</h1>
                <div class="muted">
                    Kelola transaksi, bukti pembayaran, dan status pesanan.
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

            <a href="{{ route('sales.create') }}" class="button">
                + Tambah Penjualan
            </a>
        </header>

        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="error-notice">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="error-notice">
                <strong>Transaksi gagal:</strong>
                <ul style="margin: 8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="summary">
            <div class="summary-card">
                <small>Total Transaksi Penjualan</small>
                <div class="summary-number">{{ $sales->total() }}</div>
                <small>Jumlah transaksi tercatat</small>
            </div>

            <div class="summary-info">
                <div class="table-panel" style="height:100%;">
                    <h3>Kelola Transaksi Penjualan</h3>
                    <p>
                        Halaman ini digunakan untuk melihat transaksi penjualan,
                        memeriksa bukti transfer, dan mengelola status pembayaran
                        serta pesanan. Gunakan filter tanggal atau pencarian untuk
                        menemukan transaksi yang dibutuhkan.
                    </p>
                </div>
            </div>
        </section>

        <section class="filter-panel">
            <h2 class="filter-heading">Filter Tanggal Penjualan</h2>

            <form method="GET" action="{{ route('sales.index') }}" class="filter-form">
                <div class="form-group">
                    <label for="start_date">Dari Tanggal</label>
                    <input type="date" id="start_date" name="start_date"
                        value="{{ request('start_date') }}">
                </div>

                <div class="form-group">
                    <label for="end_date">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date"
                        value="{{ request('end_date') }}">
                </div>

                <button type="submit" class="button">Terapkan Filter</button>
                <a href="{{ route('sales.index') }}" class="button-light">Reset</a>
            </form>
        </section>

        <section class="table-panel">
            <div class="table-heading">
                <h3>Riwayat Transaksi</h3>
                <span class="muted">Daftar penjualan barang</span>
            </div>

            <form action="{{ route('sales.index') }}" method="GET" class="search-form">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">

                <input type="text" name="search"
                    placeholder="Cari nomor faktur atau nama pembeli..."
                    value="{{ request('search') }}">

                <button type="submit" class="button">Cari</button>
                <a href="{{ route('sales.index') }}" class="button-light">Reset</a>
            </form>

            <p class="result-info">
                Menampilkan {{ $sales->firstItem() ?? 0 }}
                sampai {{ $sales->lastItem() ?? 0 }}
                dari {{ $sales->total() }} transaksi.
            </p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Faktur</th>
                            <th>Tanggal</th>
                            <th>Pelanggan / Petugas</th>
                            <th>Total</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Bukti Transfer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        
@forelse($sales as $sale)
    @php
        $paymentStatus = $sale->payment_status ?? 'pending';
        $orderStatus = $sale->order_status ?? 'pending';
        $paymentMethod = $sale->payment_method ?? 'cash';

        $isPaid = $paymentStatus === 'paid';
        $isCancelled = $orderStatus === 'cancelled';
        $isCompleted = $orderStatus === 'completed';
        $hasProof = !empty($sale->transfer_proof);

        $isOnlinePayment = in_array(
            $paymentMethod,
            ['transfer', 'qris', 'ewallet'],
            true
        );

        $canConfirmPayment =
            !$isCancelled &&
            !$isCompleted &&
            !$isPaid &&
            $hasProof &&
            $isOnlinePayment;

        $canProcessOrder =
            !$isCancelled &&
            !$isCompleted &&
            $orderStatus === 'pending' &&
            (!$isOnlinePayment || $isPaid);

        $canShipOrder =
            !$isCancelled &&
            !$isCompleted &&
            $orderStatus === 'processing' &&
            (!$isOnlinePayment || $isPaid);

        $canCompleteOrder =
            !$isCancelled &&
            !$isCompleted &&
            $orderStatus === 'received' &&
            ($paymentMethod === 'cod' || $isPaid);

        $canCancelOrder =
            !$isCancelled &&
            !$isCompleted &&
            !$isPaid &&
            $orderStatus === 'pending';

        $paymentLabel = match ($paymentStatus) {
            'paid' => 'Lunas',
            'waiting_confirmation' => 'Menunggu Konfirmasi',
            default => 'Belum Dibayar',
        };

        $orderLabel = match ($orderStatus) {
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'received' => 'Diterima',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($orderStatus),
        };
    @endphp

    <tr>
        <td>{{ $sales->firstItem() + $loop->index }}</td>

        <td class="invoice">{{ $sale->invoice_number }}</td>

        <td>
            {{ $sale->sale_date
                ? \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y')
                : '-' }}
        </td>

        <td>{{ $sale->user->name ?? '-' }}</td>

        <td class="amount">
            Rp {{ number_format((float) $sale->total, 0, ',', '.') }}
        </td>

        <td>
            <span class="payment-method">
                @switch($paymentMethod)
                    @case('cash') Tunai @break
                    @case('cod') COD @break
                    @case('transfer') Transfer @break
                    @case('qris') QRIS @break
                    @case('ewallet') E-Wallet @break
                    @default {{ ucfirst($paymentMethod) }}
                @endswitch
            </span>
        </td>

        <td>
            <span class="status {{
                $isCancelled ? 'status-cancelled' :
                ($isPaid ? 'status-paid' :
                ($paymentStatus === 'waiting_confirmation'
                    ? 'status-waiting' : 'status-pending'))
            }}">
                {{ $isCancelled ? 'Dibatalkan' : $paymentLabel }}
            </span>
        </td>

        <td>
            <span class="status {{
                $isCancelled ? 'status-cancelled' :
                (in_array($orderStatus, ['completed', 'received'])
                    ? 'status-completed' : 'status-pending')
            }}">
                {{ $orderLabel }}
            </span>
        </td>

        <td>
            @if($hasProof)
                <a
                    href="{{ asset('storage/' . $sale->transfer_proof) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="proof-link">
                    Lihat Bukti Transfer
                </a>
            @else
                <span class="muted">
                    {{ $isOnlinePayment ? 'Belum ada bukti' : 'Tidak diperlukan' }}
                </span>
            @endif
        </td>

        <td>
            @if($canConfirmPayment)
                <form
                    action="{{ route('sales.confirmPayment', $sale) }}"
                    method="POST"
                    class="action-form"
                    onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="button success-btn">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            @endif

            @if($canProcessOrder)
                <form
                    action="{{ route('sales.updateOrderStatus', $sale) }}"
                    method="POST"
                    class="action-form"
                    onsubmit="return confirm('Proses pesanan ini?')">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="order_status" value="processing">

                    <button type="submit" class="button success-btn">
                        Proses Pesanan
                    </button>
                </form>
            @endif

            @if($canShipOrder)
                <form
                    action="{{ route('sales.updateOrderStatus', $sale) }}"
                    method="POST"
                    class="action-form"
                    onsubmit="return confirm('Kirim pesanan ini?')">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="order_status" value="shipped">

                    <button type="submit" class="button">
                        Kirim Pesanan
                    </button>
                </form>
            @endif

            @if($canCompleteOrder)
                <form
                    action="{{ route('sales.completeOrder', $sale) }}"
                    method="POST"
                    class="action-form"
                    onsubmit="return confirm('Selesaikan pesanan ini?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="button success-btn">
                        Selesaikan Pesanan
                    </button>
                </form>
            @endif

            @if($canCancelOrder)
                <form
                    action="{{ route('sales.cancelOrder', $sale) }}"
                    method="POST"
                    class="action-form"
                    onsubmit="return confirm('Batalkan pesanan ini?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="button danger-btn">
                        Batalkan Pesanan
                    </button>
                </form>
            @endif

            @if(
                !$canConfirmPayment &&
                !$canProcessOrder &&
                !$canShipOrder &&
                !$canCompleteOrder &&
                !$canCancelOrder
            )
                <span class="muted">
                    @if($isCancelled)
                        Pesanan dibatalkan
                    @elseif($isCompleted)
                        Pesanan selesai
                    @elseif($orderStatus === 'shipped')
                        Menunggu konfirmasi pembeli
                    @elseif($orderStatus === 'received')
                        Menunggu penyelesaian
                    @elseif($isOnlinePayment && !$hasProof && !$isPaid)
                        Menunggu bukti pembayaran
                    @else
                        Tidak ada aksi
                    @endif
                </span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="10" class="empty">
            Tidak ada transaksi penjualan pada filter tersebut.
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
    </main>
</body>
</html>