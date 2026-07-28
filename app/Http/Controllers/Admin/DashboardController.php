<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $pesananBaru = Order::where('status', 'pending')->count();
        $penjualanBulanIni = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->whereIn('status', ['paid', 'processing', 'shipped', 'completed'])
            ->sum('total');
        $stokRendah = ProductVariant::where('stock', '<', 10)->count();

        $produkTerbaru = Product::with('category')
            ->withSum('variants', 'stock')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProduk', 'pesananBaru', 'penjualanBulanIni', 'stokRendah', 'produkTerbaru'
        ));
    }
}
