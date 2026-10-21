<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 30px;
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
            margin: 16px 0 6px;
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
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .back {
            background: #4b5563;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
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
    <h1>Tambah Penjualan</h1>
    <p>Isi data penjualan produk kepada pembeli.</p>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <label for="sale_date">Tanggal Penjualan</label>
        <input
            type="date"
            id="sale_date"
            name="sale_date"
            value="{{ old('sale_date', now()->format('Y-m-d')) }}"
            required
        >

        <label for="product_id">Pilih Produk</label>
        <select id="product_id" name="items[0][product_id]" required>
            <option value="">-- Pilih Produk --</option>
            @foreach ($products as $product)
                <option
                    value="{{ $product->id }}"
                    data-price="{{ (float) $product->selling_price }}"
                    data-stock="{{ $product->stock }}"
                    @selected(old('items.0.product_id') == $product->id)
                >
                    {{ $product->name }} (Stok: {{ $product->stock }})
                </option>
            @endforeach
        </select>

        <p id="product-info" class="hint">
            Harga dan stok produk akan ditampilkan di sini.
        </p>

        <label for="quantity">Jumlah yang Dijual</label>
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

        <button type="submit" class="btn">Simpan Penjualan</button>
        <a href="{{ route('sales.index') }}" class="btn back">Kembali</a>
    </form>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const productInfo = document.getElementById('product-info');

    function updateProductInfo() {
        const option = productSelect.options[productSelect.selectedIndex];

        if (!option || !option.value) {
            productInfo.textContent =
                'Harga dan stok produk akan ditampilkan di sini.';
            quantityInput.removeAttribute('max');
            return;
        }

        const price = Number(option.dataset.price);
        const stock = Number(option.dataset.stock);

        productInfo.textContent =
            'Harga jual: Rp ' +
            new Intl.NumberFormat('id-ID').format(price) +
            ' | Stok tersedia: ' +
            stock;

        quantityInput.max = stock;
    }

    productSelect.addEventListener('change', updateProductInfo);
    updateProductInfo();
</script>
</body>
</html>
