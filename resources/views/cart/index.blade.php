@extends('layouts.app')
@section('title', 'Keranjang Belanja - Pandaoni')
@section('content')

<div class="max-w-6xl mx-auto px-6 py-8">
    <h1 class="font-heading text-2xl text-maroon font-bold mb-6">Keranjang Belanja</h1>

    @if($cart->items->isEmpty())
        <p class="text-gray-600 mb-6">Keranjang Anda masih kosong.</p>
        <a href="{{ route('products.index') }}" class="text-maroon underline text-sm">&laquo; Kembali Berbelanja</a>
    @else
    <div class="grid md:grid-cols-3 gap-10">
        <div class="md:col-span-2 space-y-6">
            @foreach($cart->items as $item)
                <div class="flex gap-4 border-b pb-6">
                    <img src="{{ $item->variant->product->image }}" class="w-20 h-24 object-cover rounded bg-gray-100">
                    <div class="flex-1">
                        <p class="font-medium">{{ $item->variant->product->name }}</p>
                        <p class="text-xs text-gray-500 mb-2">{{ $item->variant->label }}</p>
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                            @csrf @method('PATCH')
                            <button type="button" onclick="this.nextElementSibling.stepDown();this.closest('form').submit()" class="border w-7 h-7 rounded">-</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-14 text-center border rounded" onchange="this.closest('form').submit()">
                            <button type="button" onclick="this.previousElementSibling.stepUp();this.closest('form').submit()" class="border w-7 h-7 rounded">+</button>
                        </form>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-maroon">Rp {{ number_format($item->subtotal(),0,',','.') }}</p>
                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-2">
                            @csrf @method('DELETE')
                            <button class="text-xs text-gray-400 underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('products.index') }}" class="text-maroon underline text-sm">&laquo; Kembali Berbelanja</a>
        </div>

        <div class="bg-gray-50 rounded p-6 h-fit">
            <h3 class="font-heading text-lg text-maroon font-bold mb-4">Ringkasan Pesanan</h3>
            @php($subtotal = $cart->subtotal())
            <div class="flex justify-between text-sm mb-2"><span>Subtotal</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span></div>
            <div class="flex justify-between text-sm mb-2"><span>Biaya Pengiriman</span><span class="text-green-700">Gratis</span></div>
            <div class="flex justify-between text-sm mb-4"><span>Pajak (11%)</span><span>Rp {{ number_format(round($subtotal*0.11),0,',','.') }}</span></div>
            <div class="flex justify-between font-bold text-maroon border-t pt-4 mb-4"><span>Total</span><span>Rp {{ number_format($subtotal + round($subtotal*0.11),0,',','.') }}</span></div>

            <div class="flex gap-2 mb-4">
                <input type="text" placeholder="Kode Promo" class="flex-1 border rounded px-3 py-2 text-sm">
                <button class="border border-maroon text-maroon px-3 rounded text-sm">PAKAI</button>
            </div>

            <a href="{{ route('checkout.index') }}" class="block text-center bg-maroon text-white py-3 text-sm tracking-wide font-medium">LANJUTKAN KE PEMBAYARAN</a>
        </div>
    </div>
    @endif
</div>

@endsection
