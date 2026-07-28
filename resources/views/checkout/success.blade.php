@extends('layouts.app')
@section('title', 'Pesanan Berhasil - Pandaoni')
@section('content')

<div class="max-w-2xl mx-auto px-6 py-20 text-center">
    <div class="text-5xl mb-4">✅</div>
    <h1 class="font-heading text-3xl text-maroon font-bold mb-2">Pesanan Berhasil Dibuat!</h1>
    <p class="text-gray-600 mb-8">Nomor pesanan Anda: <span class="font-semibold text-maroon">{{ $order->order_number }}</span></p>

    <div class="bg-gray-50 rounded p-6 text-left mb-8">
        @foreach($order->items as $item)
            <div class="flex justify-between text-sm mb-3">
                <span>{{ $item->product_name }} ({{ $item->variant_label }}) x{{ $item->quantity }}</span>
                <span>Rp {{ number_format($item->subtotal,0,',','.') }}</span>
            </div>
        @endforeach
        <div class="flex justify-between font-bold text-maroon border-t pt-3 mt-3">
            <span>Total</span><span>{{ $order->formatted_total }}</span>
        </div>
    </div>

    <a href="{{ route('products.index') }}" class="inline-block bg-maroon text-white px-6 py-3 text-sm tracking-wide">LANJUT BELANJA</a>
</div>

@endsection
