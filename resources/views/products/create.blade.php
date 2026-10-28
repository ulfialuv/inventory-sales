<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | Ranitha Stuff</title>

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
            font-weight: bold;
            font-size: 20px;
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
        .sidebar a.active { background: #78404a; }

        .nav-icon { width: 20px; text-align: center; }

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

        .logout button:hover { background: #78404a; }

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

        .muted { color: #8a7d79; font-size: 12px; }

        .button {
            display: inline-block;
            padding: 11px 15px;
            border: 0;
            border-radius: 8px;
            background: #6b3039;
            color: white;
            text-decoration: none;
            text-align: center;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .button:hover { background: #54232b; }

        .button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .button-light {
            display: inline-block;
            padding: 11px 15px;
            border: 1px solid #e4d8cc;
            border-radius: 8px;
            background: #f7f0e7;
            color: #54232b;
            text-decoration: none;
            text-align: center;
            font-size: 12px;
            cursor: pointer;
        }

        .button-light:hover { background: #efe3d4; }

        .alert {
            padding: 14px 16px;
            margin-bottom: 18px;
            border: 1px solid #f1c9c5;
            border-radius: 9px;
            background: #fff0ef;
            color: #a13f38;
            font-size: 13px;
        }

        .alert ul { margin: 8px 0 0 20px; }
        .alert li { margin-bottom: 4px; }

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

        .form-group.full { grid-column: 1 / -1; }

        label {
            color: #746664;
            font-size: 12px;
            font-weight: 600;
        }

        input, select {
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

        input:focus, select:focus {
            outline: 2px solid #dfc69c;
            border-color: #b99556;
        }

        input.invalid {
            border-color: #b42318;
        }

        .hint {
            color: #8a7d79;
            font-size: 11px;
        }

        .error {
            color: #b42318;
            font-size: 12px;
        }

        .price-warning {
            display: none;
            padding: 10px 12px;
            border: 1px solid #f1c9c5;
            border-radius: 8px;
            background: #fff0ef;
            color: #a13f38;
            font-size: 12px;
        }

        .price-warning.show { display: block; }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 22px;
            margin-top: 28px;
            border-top: 1px solid #f0e8df;
        }

        @media (max-width: 950px) {
            .sidebar { width: 190px; }
            .main { margin-left: 190px; padding: 22px; }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 18px;
            }

            .main { margin-left: 0; padding: 18px; }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-panel { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: auto; }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .button,
            .form-actions .button-light { width: 100%; }
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

        <a href="{{ route('admin.dashboard') }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}" class="active">
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

        <a href="{{ route('reports.index') }}">
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
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Tambah Produk</h1>
                <div class="muted">
                    Tambahkan produk skincare dan kecantikan baru ke dalam inventaris toko.
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="button-light">
                ← Kembali ke Produk
            </a>
        </div>

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
                <h3>Informasi Produk</h3>
                <p>Isi semua informasi produk dengan benar sebelum disimpan.</p>
            </div>

            <form
                id="productForm"
                action="{{ route('products.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Nama Produk *</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Serum Wajah"
                            maxlength="255"
                            required
                        >
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sku">Kode SKU *</label>
                        <input
                            id="sku"
                            type="text"
                            name="sku"
                            value="{{ old('sku') }}"
                            placeholder="Contoh: SKN001"
                            maxlength="255"
                            required
                        >
                        @error('sku')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="category_id">Kategori *</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ (string) old('category_id') === (string) $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="purchase_price">Harga Beli (Rp) *</label>
                        <input
                            id="purchase_price"
                            type="number"
                            name="purchase_price"
                            value="{{ old('purchase_price') }}"
                            min="0"
                            step="1"
                            placeholder="0"
                            required
                        >
                        @error('purchase_price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="selling_price">Harga Jual (Rp) *</label>
                        <input
                            id="selling_price"
                            type="number"
                            name="selling_price"
                            value="{{ old('selling_price') }}"
                            min="0"
                            step="1"
                            placeholder="0"
                            required
                        >
                        <span class="hint">
                            Harga jual harus lebih tinggi daripada harga beli.
                        </span>
                        <span id="priceWarning" class="price-warning">
                            Harga jual harus lebih tinggi daripada harga beli. Produk tidak bisa disimpan dengan harga jual yang sama atau lebih rendah.
                        </span>
                        @error('selling_price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok Awal *</label>
                        <input
                            id="stock"
                            type="number"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            step="1"
                            required
                        >
                        @error('stock')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="minimum_stock">Batas Minimum Stok *</label>
                        <input
                            id="minimum_stock"
                            type="number"
                            name="minimum_stock"
                            value="{{ old('minimum_stock', 5) }}"
                            min="0"
                            step="1"
                            required
                        >
                        <span class="hint">
                            Peringatan muncul saat stok mencapai batas ini.
                        </span>
                        @error('minimum_stock')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="button-light">
                        Batal
                    </a>

                    <button id="submitButton" type="submit" class="button">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('productForm');
            const nameInput = document.getElementById('name');
            const skuInput = document.getElementById('sku');
            const purchasePrice = document.getElementById('purchase_price');
            const sellingPrice = document.getElementById('selling_price');
            const priceWarning = document.getElementById('priceWarning');

            function checkPrice() {
                const beli = purchasePrice.value;
                const jual = sellingPrice.value;

                sellingPrice.setCustomValidity('');

                if (beli === '' || jual === '') {
                    priceWarning.classList.remove('show');
                    sellingPrice.classList.remove('invalid');
                    return true;
                }

                if (Number(jual) <= Number(beli)) {
                    sellingPrice.setCustomValidity(
                        'Harga jual harus lebih tinggi daripada harga beli.'
                    );
                    priceWarning.classList.add('show');
                    sellingPrice.classList.add('invalid');
                    return false;
                }

                priceWarning.classList.remove('show');
                sellingPrice.classList.remove('invalid');
                return true;
            }

            function checkNotBlank(input, label) {
                input.setCustomValidity('');

                if (input.value.trim() === '') {
                    input.setCustomValidity(
                        label + ' tidak boleh hanya berisi spasi.'
                    );
                    return false;
                }

                return true;
            }

            purchasePrice.addEventListener('input', checkPrice);
            sellingPrice.addEventListener('input', checkPrice);

            nameInput.addEventListener('input', function () {
                checkNotBlank(nameInput, 'Nama produk');
            });

            skuInput.addEventListener('input', function () {
                checkNotBlank(skuInput, 'Kode SKU');
            });

            form.addEventListener('submit', function (event) {
                const priceValid = checkPrice();
                const nameValid = checkNotBlank(nameInput, 'Nama produk');
                const skuValid = checkNotBlank(skuInput, 'Kode SKU');

                if (!priceValid || !nameValid || !skuValid || !form.checkValidity()) {
                    event.preventDefault();
                    form.reportValidity();
                }
            });
        });
    </script>
</body>
</html>