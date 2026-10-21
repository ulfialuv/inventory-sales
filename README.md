# Inventory Sales

Inventory Sales adalah aplikasi berbasis web yang dibuat menggunakan Laravel untuk mengelola stok barang dan transaksi penjualan.

## Fitur

- Login dengan 3 role: Admin, Staff, dan User.
- Mengelola data produk dan kategori.
- Mengelola data pemasok.
- Mencatat transaksi pembelian barang.
- Mengelola transaksi penjualan.
- Keranjang belanja dan checkout untuk pembeli.
- Melihat laporan penjualan.

## Teknologi

- Laravel
- PHP
- MySQL
- HTML, CSS, dan JavaScript
- Tailwind CSS

## Cara Menjalankan

1. Clone repository ini.

   ```bash
   git clone https://github.com/ulfialuv/inventory-sales.git
   ```

2. Masuk ke folder proyek.

   ```bash
   cd inventory-sales
   ```

3. Install dependensi.

   ```bash
   composer install
   npm install
   ```

4. Salin `.env.example` menjadi `.env`.

   ```powershell
   Copy-Item .env.example .env
   ```

5. Buat application key.

   ```bash
   php artisan key:generate
   ```

6. Buat database dengan nama `inventory_sales`, lalu sesuaikan pengaturannya di file `.env`.

7. Jalankan migrasi database.

   ```bash
   php artisan migrate
   ```

8. Build file frontend.

   ```bash
   npm run build
   ```

9. Jalankan aplikasi.

   ```bash
   php artisan serve
   ```

10. Buka `http://127.0.0.1:8000` di browser.

## Repository

https://github.com/ulfialuv/inventory-sales