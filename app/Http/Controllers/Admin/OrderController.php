<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,paid,processing,shipped,completed,cancelled'],
        ]);

        $order->update($data);

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}