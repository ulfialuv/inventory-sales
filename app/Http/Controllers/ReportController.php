<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $startDate = $validated['start_date'] ?? null;
        $endDate = $validated['end_date'] ?? null;

        // Query dasar seluruh transaksi penjualan.
        $salesQuery = Sale::with('user')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('sale_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('sale_date', '<=', $endDate);
            });

        // Query penjualan yang sudah selesai.
        // Pesanan batal dan menunggu tidak masuk ringkasan.
        $completedSalesQuery = (clone $salesQuery)
            ->where('order_status', 'completed');

        // Query dasar seluruh transaksi pembelian.
        $purchasesQuery = Purchase::with(['user', 'supplier'])
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('purchase_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('purchase_date', '<=', $endDate);
            });

        // Ringkasan penjualan selesai.
        $totalSales = (clone $completedSalesQuery)->count();

        $totalSalesAmount = (clone $completedSalesQuery)
            ->sum('total');

        // Ringkasan pembelian tetap menghitung seluruh pembelian.
        $totalPurchases = (clone $purchasesQuery)->count();

        $totalPurchaseAmount = (clone $purchasesQuery)
            ->sum('total');

        // Riwayat menampilkan semua transaksi, termasuk
        // pesanan menunggu dan pesanan yang dibatalkan.
        $sales = (clone $salesQuery)
            ->orderByDesc('sale_date')
            ->orderByDesc('id')
            ->paginate(10, ['*'], 'sales_page')
            ->withQueryString();

        $purchases = (clone $purchasesQuery)
            ->orderByDesc('purchase_date')
            ->orderByDesc('id')
            ->paginate(10, ['*'], 'purchases_page')
            ->withQueryString();

        return view('reports.index', compact(
            'startDate',
            'endDate',
            'totalSales',
            'totalSalesAmount',
            'totalPurchases',
            'totalPurchaseAmount',
            'sales',
            'purchases'
        ));
    }
}
