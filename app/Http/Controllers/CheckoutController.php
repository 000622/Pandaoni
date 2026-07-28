<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.variant.product')->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $cart->subtotal();
        $shipping = 0; // gratis ongkir untuk demo
        $tax = round($subtotal * 0.11);
        $total = $subtotal + $shipping + $tax;

        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'shipping_city' => ['required', 'string', 'max:255'],
            'shipping_postal_code' => ['required', 'string', 'max:10'],
            'shipping_province' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'in:transfer_bank,kartu_kredit'],
        ]);

        $cart = Auth::user()->cart()->with('items.variant.product')->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $order = DB::transaction(function () use ($cart, $data) {
            $subtotal = $cart->subtotal();
            $shipping = 0;
            $tax = round($subtotal * 0.11);
            $total = $subtotal + $shipping + $tax;

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $data['payment_method'],
                'shipping_name' => $data['shipping_name'],
                'shipping_address' => $data['shipping_address'],
                'shipping_city' => $data['shipping_city'],
                'shipping_postal_code' => $data['shipping_postal_code'],
                'shipping_province' => $data['shipping_province'],
            ]);

            foreach ($cart->items as $item) {
                $variant = $item->variant;
                $order->items()->create([
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product->name,
                    'variant_label' => $variant->label,
                    'price' => $variant->effective_price,
                    'quantity' => $item->quantity,
                    'subtotal' => $variant->effective_price * $item->quantity,
                ]);

                $variant->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('checkout.success', $order)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function success(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('items');

        return view('checkout.success', compact('order'));
    }
}
