<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembelian | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        a { text-decoration: none; }
        button { font-family: inherit; }

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
        }

        /* SIDEBAR ADMIN - MENGIKUTI ADMIN DASHBOARD */

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
            border-radius: 12px;
            background: #b99556;
            color: #54232b;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
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
            text-align: center;
            flex-shrink: 0;
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

        .logout button:hover {
            background: #78404a;
        }

        /* SIDEBAR STAFF - MEMPERTAHANKAN TAMPILAN STAFF */

        .sidebar.staff-sidebar {
            display: flex;
            flex-direction: column;
            padding: 28px 18px;
        }

        .staff-sidebar .brand {
            margin-bottom: 35px;
        }

        .staff-sidebar .brand-icon {
            border-radius: 10px;
            font-size: 21px;
        }

        .staff-sidebar .brand p {
            margin: 4px 0 0;
            color: #e3d1ca;
            font-size: 10px;
        }

        .staff-sidebar .nav-title {
            margin: 20px 0 10px 10px;
            color: #cdb5ae;
        }

        .staff-sidebar a {
            gap: 11px;
            padding: 12px 11px;
            border-radius: 8px;
            color: #f5e9e5;
            transition: background 0.2s;
        }

        .staff-sidebar a:hover,
        .staff-sidebar a.active {
            background: #78404a;
            color: white;
        }

        .staff-sidebar .nav-icon {
            width: 19px;
            font-size: 15px;
        }

        .staff-sidebar .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .staff-sidebar .logout {
            position: static;
        }

        .staff-sidebar .logout button {
            border: 1px solid #91616a;
            border-radius: 8px;
            font-size: 13px;
        }

        /* KONTEN UTAMA */

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
            margin-bottom: 30px;
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
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: normal;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
            line-height: 1.7;
        }

        .button,
        .button-light {
            display: inline-block;
            padding: 11px 15px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .button {
            border: 0;
            background: #6b3039;
            color: white;
        }

        .button:hover {
            background: #54232b;
        }

        .button-light {
            border: 1px solid #e4d8cc;
            background: #f7f0e7;
            color: #54232b;
        }

        .button-light:hover {
            background: #efe3d4;
        }

        /* PESAN VALIDASI */

        .alert {
            padding: 14px 16px;
            margin-bottom: 18px;
            border: 1px solid #f1c9c5;
            border-radius: 9px;
            background: #fff0ef;
            color: #a13f38;
            font-size: 13px;
        }

        .alert ul {
            margin: 8px 0 0 20px;
        }

        .alert li {
            margin-bottom: 4px;
        }

        /* FORM PEMBELIAN */

        .form-panel {
            max-width: 1050px;
            padding: 24px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .form-heading {
            padding-bottom: 20px;
            margin-bottom: 22px;
            border-bottom: 1px solid #f0e8df;
        }

        .form-heading h3 {
            margin: 0 0 7px;
            color: #54232b;
            font-size: 16px;
        }

        .form-heading p {
            margin: 0;
            color: #8a7d79;
            font-size: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            color: #746664;
            font-size: 12px;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            min-width: 0;
            padding: 12px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: white;
            color: #302526;
            font-family: inherit;
            font-size: 13px;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        .hint {
            color: #8a7d79;
            font-size: 11px;
        }

        .error {
            color: #b42318;
            font-size: 12px;
        }

        .price-info {
            padding: 12px 14px;
            border: 1px solid #eadcc8;
            border-radius: 8px;
            background: #faf4e9;
            color: #6b3039;
            font-size: 12px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 22px;
            margin-top: 28px;
            border-top: 1px solid #f0e8df;
        }

        /* RESPONSIVE */

        @media (max-width: 950px) {
            .main {
                padding: 22px;
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar:not(.staff-sidebar) .logout {
                position: static;
                margin-top: 15px;
            }

            .sidebar.staff-sidebar {
                padding: 20px;
            }

            .staff-sidebar .brand {
                margin-bottom: 15px;
            }

            .staff-sidebar .sidebar-bottom {
                margin-top: 15px;
                padding-top: 10px;
            }

            .main {
                margin-left: 0;
                padding: 22px 20px;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 {
                font-size: 25px;
            }

            .form-panel {
                padding: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .button,
            .form-actions .button-light {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    @php
        $isAdmin = auth()->user()->role === 'admin';
    @endphp

    <aside class="sidebar {{ $isAdmin ? '' : 'staff-sidebar' }}">

        <div class="brand">
            <div class="brand-icon">R</div>
            <div>
                <h2>Ranitha Stuff</h2>

                @if ($isAdmin)
                    <small>Skincare & Beauty Store</small>
                @else
                    <p>Skincare & Beauty Store</p>
                @endif
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        @if ($isAdmin)

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span>
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                <span class="nav-icon">▦</span>
                Data Produk
            </a>

            <a href="{{ route('categories.index') }}"
               class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span>
                Kategori
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                <span class="nav-icon">♙</span>
                Pemasok
            </a>

        @else

            <a href="{{ route('staff.dashboard') }}"
               class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span>
                Dashboard
            </a>

            <a href="{{ route('staff.products.index') }}"
               class="{{ request()->routeIs('staff.products.*') ? 'active' : '' }}">
                <span class="nav-icon">▦</span>
                Data Produk
            </a>

        @endif

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}"
           class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}">
            <span class="nav-icon">{{ $isAdmin ? '↓' : '⇩' }}</span>
            Pembelian
        </a>

        <a href="{{ route('sales.index') }}"
           class="{{ request()->routeIs('sales.*') ? 'active' : '' }}">
            <span class="nav-icon">{{ $isAdmin ? '↑' : '⇧' }}</span>
            Penjualan
        </a>

        @if ($isAdmin)

            <div class="nav-title">LAINNYA</div>

            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <span class="nav-icon">♧</span>
                Pengguna
            </a>

            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <span class="nav-icon">▥</span>
                Laporan
            </a>

        @endif

        @if ($isAdmin)

            <form class="logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">↪ &nbsp; Keluar dari akun</button>
            </form>

        @else

            <div class="sidebar-bottom">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        ↪ Keluar
                    </button>
                </form>
            </div>

        @endif

    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Tambah Transaksi Pembelian</h1>
                <div class="muted">
                    Catat pembelian produk skincare dari pemasok untuk menambah stok toko.
                </div>
            </div>

            <a href="{{ route('purchases.index') }}" class="button-light">
                ← Kembali ke Pembelian
            </a>
        </header>

        @if ($errors->any())
            <div class="alert">
                <strong>Data belum bisa disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="form-panel">

            <div class="form-heading">
                <h3>Informasi Pembelian</h3>
                <p>Isi informasi pemasok dan produk yang dibeli dengan benar.</p>
            </div>

            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="supplier_id">Pemasok *</label>

                        <select id="supplier_id" name="supplier_id" required>
                            <option value="">-- Pilih Pemasok --</option>

                            @foreach ($suppliers as $supplier)
                                <option
                                    value="{{ $supplier->id }}"
                                    {{ (string) old('supplier_id') === (string) $supplier->id ? 'selected' : '' }}
                                >
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('supplier_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="purchase_date">Tanggal Pembelian *</label>

                        <input
                            type="date"
                            id="purchase_date"
                            name="purchase_date"
                            value="{{ old('purchase_date', now()->format('Y-m-d')) }}"
                            required
                        >

                        @error('purchase_date')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="product_id">Produk *</label>

                        <select
                            id="product_id"
                            name="items[0][product_id]"
                            required
                        >
                            <option value="">-- Pilih Produk --</option>

                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}"
                                    data-price="{{ (float) $product->purchase_price }}"
                                    {{ (string) old('items.0.product_id') === (string) $product->id ? 'selected' : '' }}
                                >
                                    {{ $product->name }} — {{ $product->sku }}
                                </option>
                            @endforeach
                        </select>

                        @error('items.0.product_id')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <div class="price-info" id="price-info">
                            Harga beli akan ditampilkan setelah produk dipilih.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah Barang *</label>

                        <input
                            type="number"
                            id="quantity"
                            name="items[0][quantity]"
                            min="1"
                            step="1"
                            value="{{ old('items.0.quantity', 1) }}"
                            required
                        >

                        @error('items.0.quantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Total Perkiraan</label>

                        <div class="price-info" id="total-info">
                            Rp 0
                        </div>

                        <span class="hint">
                            Perkiraan dihitung dari harga beli produk dikali jumlah.
                        </span>
                    </div>

                    <div class="form-group full">
                        <label for="notes">Catatan (opsional)</label>

                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            placeholder="Contoh: Pembelian stok skincare bulanan"
                        >{{ old('notes') }}</textarea>

                        @error('notes')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('purchases.index') }}" class="button-light">
                        Batal
                    </a>

                    <button type="submit" class="button">
                        Simpan Pembelian
                    </button>
                </div>

            </form>
        </section>
    </main>

    <script>
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const priceInfo = document.getElementById('price-info');
        const totalInfo = document.getElementById('total-info');

        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        });

        function updatePurchaseInfo() {
            const option = productSelect.options[productSelect.selectedIndex];
            const quantity = Number(quantityInput.value);
            const hasProduct = option && option.value !== '';
            const price = hasProduct
                ? Number(option.dataset.price || 0)
                : 0;

            if (hasProduct) {
                priceInfo.textContent =
                    'Harga beli per unit: ' + rupiah.format(price);

                totalInfo.textContent =
                    rupiah.format(price * Math.max(quantity, 0));
            } else {
                priceInfo.textContent =
                    'Harga beli akan ditampilkan setelah produk dipilih.';

                totalInfo.textContent = rupiah.format(0);
            }
        }

        productSelect.addEventListener('change', updatePurchaseInfo);
        quantityInput.addEventListener('input', updatePurchaseInfo);

        updatePurchaseInfo();
    </script>

</body>
</html>