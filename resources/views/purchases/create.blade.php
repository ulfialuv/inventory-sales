<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: #4b5563;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            padding: 12px;
            border-radius: 6px;
        }

        .hint {
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Transaksi Pembelian</h1>
        <p>Masukkan barang yang dibeli dari pemasok.</p>

        @if ($errors->any())
            <div class="error">
                <strong>Periksa kembali input kamu:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf

            <label for="supplier_id">Pemasok</label>
            <select id="supplier_id" name="supplier_id" required>
                <option value="">-- Pilih Pemasok --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        @selected(old('supplier_id') == $supplier->id)>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>

            <label for="purchase_date">Tanggal Pembelian</label>
            <input
                type="date"
                id="purchase_date"
                name="purchase_date"
                value="{{ old('purchase_date', now()->format('Y-m-d')) }}"
                required
            >

            <label for="product_id">Produk</label>
            <select id="product_id" name="items[0][product_id]" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option
                        value="{{ $product->id }}"
                        data-price="{{ (float) $product->purchase_price }}"
                        @selected(old('items.0.product_id') == $product->id)
                    >
                        {{ $product->name }} — {{ $product->sku }}
                    </option>
                @endforeach
            </select>

            <p class="hint" id="price-info">
                Harga beli diambil dari data produk.
            </p>

            <label for="quantity">Jumlah Barang</label>
            <input
                type="number"
                id="quantity"
                name="items[0][quantity]"
                min="1"
                step="1"
                value="{{ old('items.0.quantity', 1) }}"
                required
            >

            <label for="notes">Catatan (opsional)</label>
            <textarea id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>

            <button type="submit" class="btn">Simpan Pembelian</button>
            <a href="{{ route('purchases.index') }}" class="btn back">
                Kembali
            </a>
        </form>
    </div>

    <script>
        const productSelect = document.getElementById('product_id');
        const priceInfo = document.getElementById('price-info');

        function showPrice() {
            const option = productSelect.options[productSelect.selectedIndex];

            if (option && option.dataset.price !== undefined &&
                option.value !== '') {
                const price = Number(option.dataset.price);
                priceInfo.textContent = 'Harga beli per unit: Rp ' +
                    new Intl.NumberFormat('id-ID').format(price);
            } else {
                priceInfo.textContent = 'Harga beli diambil dari data produk.';
            }
        }

        productSelect.addEventListener('change', showPrice);
        showPrice();
    </script>
</body>
</html>
