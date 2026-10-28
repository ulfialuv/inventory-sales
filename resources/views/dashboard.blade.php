<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size: 12px; color: #788397; margin-bottom: 5px;">
                INVENTORY & SALES MANAGEMENT
            </p>
            <h2 style="color: red; font-size: 40px;">
                TES PERUBAHAN DASHBOARD
            </h2>
            <p style="font-size: 14px; color: #788397; margin-top: 5px;">
                Selamat datang kembali! Pantau aktivitas bisnis kamu di sini.
            </p>
        </div>
    </x-slot>

    <div style="max-width: 1500px; margin: 0 auto; padding: 10px 0 35px;">

        {{-- Welcome Banner --}}
        <div style="background: linear-gradient(120deg, #3157d5, #203ca4); border-radius: 20px; padding: 30px; color: white; margin-bottom: 28px; position: relative; overflow: hidden;">
            <div style="position: relative; z-index: 1;">
                <p style="font-size: 13px; opacity: .8; margin-bottom: 8px;">
                    SISTEM MANAJEMEN BISNIS
                </p>
                <h3 style="font-size: 25px; font-weight: 800; color: white; margin-bottom: 9px;">
                    Kelola Bisnis Lebih Mudah
                </h3>
                <p style="font-size: 14px; color: #e4eaff; max-width: 540px;">
                    Pantau produk, stok barang, transaksi penjualan, dan laporan bisnis melalui satu dashboard.
                </p>
            </div>
            <div style="position: absolute; right: 35px; top: 15px; font-size: 100px; opacity: .12;">
                ▦
            </div>
        </div>

        {{-- Ringkasan --}}
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 18px; font-weight: 800; color: #172033;">
                Ringkasan Sistem
            </h3>
            <p style="font-size: 13px; color: #788397; margin-top: 4px;">
                Informasi singkat untuk membantu aktivitas operasional.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 30px;">

            <div style="background: white; border: 1px solid #e6eaf1; border-radius: 17px; padding: 23px; box-shadow: 0 4px 15px rgba(23,32,51,.035);">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                    <span style="font-size: 13px; color: #788397;">Manajemen Produk</span>
                    <span style="background: #eaf0ff; color: #3157d5; padding: 10px 12px; border-radius: 12px; font-size: 20px;">▤</span>
                </div>
                <p style="font-size: 22px; font-weight: 800; margin-top: 19px; color: #172033;">Data Produk</p>
                <p style="font-size: 12px; color: #788397; margin-top: 5px;">Kelola produk dan informasi stok.</p>
            </div>

            <div style="background: white; border: 1px solid #e6eaf1; border-radius: 17px; padding: 23px; box-shadow: 0 4px 15px rgba(23,32,51,.035);">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                    <span style="font-size: 13px; color: #788397;">Transaksi</span>
                    <span style="background: #e3f8ee; color: #138a60; padding: 10px 12px; border-radius: 12px; font-size: 20px;">↗</span>
                </div>
                <p style="font-size: 22px; font-weight: 800; margin-top: 19px; color: #172033;">Penjualan</p>
                <p style="font-size: 12px; color: #788397; margin-top: 5px;">Pantau aktivitas penjualan.</p>
            </div>

            <div style="background: white; border: 1px solid #e6eaf1; border-radius: 17px; padding: 23px; box-shadow: 0 4px 15px rgba(23,32,51,.035);">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                    <span style="font-size: 13px; color: #788397;">Persediaan</span>
                    <span style="background: #fff4d7; color: #a36a00; padding: 10px 12px; border-radius: 12px; font-size: 20px;">◷</span>
                </div>
                <p style="font-size: 22px; font-weight: 800; margin-top: 19px; color: #172033;">Kontrol Stok</p>
                <p style="font-size: 12px; color: #788397; margin-top: 5px;">Pantau ketersediaan barang.</p>
            </div>

            <div style="background: white; border: 1px solid #e6eaf1; border-radius: 17px; padding: 23px; box-shadow: 0 4px 15px rgba(23,32,51,.035);">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                    <span style="font-size: 13px; color: #788397;">Laporan</span>
                    <span style="background: #f1eaff; color: #7950bd; padding: 10px 12px; border-radius: 12px; font-size: 20px;">▥</span>
                </div>
                <p style="font-size: 22px; font-weight: 800; margin-top: 19px; color: #172033;">Data Bisnis</p>
                <p style="font-size: 12px; color: #788397; margin-top: 5px;">Informasi untuk evaluasi bisnis.</p>
            </div>

        </div>

        {{-- Menu Utama --}}
        <div style="background: white; border: 1px solid #e6eaf1; border-radius: 18px; padding: 25px;">
            <h3 style="font-size: 18px; font-weight: 800; color: #172033;">
                Aktivitas Utama
            </h3>
            <p style="font-size: 13px; color: #788397; margin-top: 5px; margin-bottom: 22px;">
                Pilih bagian sistem yang ingin kamu kelola.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px;">

                <a href="{{ route('dashboard') }}" style="display: block; text-decoration: none; border: 1px solid #e6eaf1; border-radius: 13px; padding: 18px; color: #172033;">
                    <span style="font-size: 22px;">⌂</span>
                    <p style="font-size: 14px; font-weight: 700; margin-top: 10px;">Dashboard</p>
                    <p style="font-size: 12px; color: #788397; margin-top: 4px;">Ringkasan sistem</p>
                </a>

                <div style="border: 1px solid #e6eaf1; border-radius: 13px; padding: 18px;">
                    <span style="font-size: 22px;">▤</span>
                    <p style="font-size: 14px; font-weight: 700; margin-top: 10px;">Produk</p>
                    <p style="font-size: 12px; color: #788397; margin-top: 4px;">Pengelolaan barang</p>
                </div>

                <div style="border: 1px solid #e6eaf1; border-radius: 13px; padding: 18px;">
                    <span style="font-size: 22px;">⇄</span>
                    <p style="font-size: 14px; font-weight: 700; margin-top: 10px;">Transaksi</p>
                    <p style="font-size: 12px; color: #788397; margin-top: 4px;">Pembelian dan penjualan</p>
                </div>

                <div style="border: 1px solid #e6eaf1; border-radius: 13px; padding: 18px;">
                    <span style="font-size: 22px;">▥</span>
                    <p style="font-size: 14px; font-weight: 700; margin-top: 10px;">Laporan</p>
                    <p style="font-size: 12px; color: #788397; margin-top: 4px;">Ringkasan aktivitas bisnis</p>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>