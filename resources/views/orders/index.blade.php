@extends('layouts.app')

@section('title', 'Pesanan Saya - Pandaoni')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">
    <h1 class="font-heading text-3xl text-maroon font-bold mb-6">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <div class="bg-white border border-maroon/10 rounded-lg p-10 text-center text-gray-500">
            Belum ada pesanan. <a href="{{ route('products.index') }}" class="text-maroon underline">Mulai belanja</a>.
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white border border-maroon/10 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-maroon">{{ $order->order_number }}</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $order->items->count() }} item</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                            @class([
                                'bg-yellow-100 text-yellow-800' => $order->status === 'pending',
                                'bg-blue-100 text-blue-800' => $order->status === 'paid' || $order->status === 'processing',
                                'bg-purple-100 text-purple-800' => $order->status === 'shipped',
                                'bg-green-100 text-green-800' => $order->status === 'completed',
                                'bg-red-100 text-red-800' => $order->status === 'cancelled',
                            ])">
                            {{ ucfirst($order->status) }}
                        </span>
                        <p class="text-sm font-medium mt-1">{{ $order->formatted_total }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection