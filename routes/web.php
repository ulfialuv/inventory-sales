<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($role === 'staff') {
        return redirect()->route('staff.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalPurchases = Purchase::count();
        $totalSales = Sale::count();

        $totalSalesAmount = Sale::sum('total');
        $totalPurchaseAmount = Purchase::sum('total');

        $lowStockProducts = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        $users = User::latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalPurchases',
            'totalSales',
            'totalSalesAmount',
            'totalPurchaseAmount',
            'lowStockProducts',
            'users'
        ));
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN DAN STAFF
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,staff'])->group(function () {

    // Transaksi pembelian
    Route::resource('purchases', PurchaseController::class)
        ->only(['index', 'create', 'store']);

    // Transaksi penjualan
    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store']);

    // Konfirmasi pembayaran transfer atau QRIS/e-wallet
    Route::patch('/sales/{sale}/confirm-payment', [
        SaleController::class,
        'confirmPayment'
    ])->name('sales.confirmPayment');

    // Ubah status pesanan menjadi diproses atau dikirim
    Route::patch('/sales/{sale}/order-status', [
        SaleController::class,
        'updateOrderStatus'
    ])->name('sales.updateOrderStatus');

    // Selesaikan pesanan setelah pelanggan mengonfirmasi penerimaan
    Route::patch('/sales/{sale}/complete-order', [
        SaleController::class,
        'completeOrder'
    ])->name('sales.completeOrder');

    // Batalkan pesanan
    Route::patch('/sales/{sale}/cancel-order', [
        SaleController::class,
        'cancelOrder'
    ])->name('sales.cancelOrder');

    // Laporan
    Route::get('/reports', [
        ReportController::class,
        'index'
    ])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    Route::get('/staff/products', [
        ProductController::class,
        'index'
    ])->name('staff.products.index');
});

/*
|--------------------------------------------------------------------------
| USER / PEMBELI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    // Dashboard pembeli
    Route::get('/user', function (Request $request) {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        $totalProducts = Product::count();

        $availableProducts = Product::where(
            'stock',
            '>',
            0
        )->count();

        $products = $query->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        $users = User::count();

        return view('user.dashboard', compact(
            'totalProducts',
            'availableProducts',
            'products',
            'users'
        ));
    })->name('user.dashboard');

    // Keranjang belanja
    Route::get('/cart', [
        SaleController::class,
        'cart'
    ])->name('cart.index');

    Route::post('/cart/add', [
        SaleController::class,
        'addToCart'
    ])->name('cart.add');

    Route::patch('/cart/{product}', [
        SaleController::class,
        'updateCart'
    ])->name('cart.update');

    Route::delete('/cart/{product}', [
        SaleController::class,
        'removeFromCart'
    ])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [
        SaleController::class,
        'checkout'
    ])->name('cart.checkout');

    Route::post('/checkout', [
        SaleController::class,
        'placeOrder'
    ])->name('cart.placeOrder');

    // Riwayat pesanan
    Route::get('/pesanan-saya', [
        SaleController::class,
        'myOrders'
    ])->name('user.orders');

    // Batalkan pesanan sendiri
    Route::patch('/pesanan-saya/{sale}/batalkan', [
        SaleController::class,
        'cancelMyOrder'
    ])->name('user.orders.cancel');

    // Unggah bukti transfer atau QRIS/e-wallet
    Route::post('/pesanan-saya/{sale}/bukti-transfer', [
        SaleController::class,
        'uploadTransferProof'
    ])->name('user.orders.transfer-proof');

    // Pelanggan mengonfirmasi bahwa barang sudah diterima
    Route::patch('/pesanan-saya/{sale}/diterima', [
        SaleController::class,
        'markReceived'
    ])->name('user.orders.received');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ROUTE AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';