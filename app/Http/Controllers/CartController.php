<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected function currentCart()
    {
        return Auth::user()->cart()->firstOrCreate([]);
    }

    public function index()
    {
        $cart = $this->currentCart()->load('items.variant.product');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $variant = ProductVariant::findOrFail($data['product_variant_id']);
        $qty = $data['quantity'] ?? 1;

        if ($variant->stock < $qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->currentCart();

        $item = $cart->items()->where('product_variant_id', $variant->id)->first();
        if ($item) {
            $item->increment('quantity', $qty);
        } else {
            $cart->items()->create([
                'product_variant_id' => $variant->id,
                'quantity' => $qty,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeItem($cartItem);

        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        $cartItem->update(['quantity' => $data['quantity']]);

        return back();
    }

    public function remove(CartItem $cartItem)
    {
        $this->authorizeItem($cartItem);
        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    protected function authorizeItem(CartItem $cartItem): void
    {
        abort_unless($cartItem->cart->user_id === Auth::id(), 403);
    }
}
