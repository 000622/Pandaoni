@extends('layouts.app')
@section('title', $product->name . ' - Pandaoni')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="text-xs text-gray-500 mb-6 uppercase tracking-wide">
        <a href="{{ route('home') }}" class="hover:underline">Beranda</a> &gt;
        <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:underline">{{ $product->category->name }}</a> &gt;
        <span class="text-maroon font-medium">{{ $product->name }}</span>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
        <div class="flex gap-4">
            <div class="flex flex-col gap-3">
                @for($i=0;$i<4;$i++)
                    <div class="w-20 h-20 rounded overflow-hidden bg-gray-100 border">
                        <img src="{{ $product->image }}?a={{ $i }}" class="w-full h-full object-cover">
                    </div>
                @endfor
            </div>
            <div class="flex-1 rounded overflow-hidden bg-gray-100">
                <img src="{{ $product->image }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
            </div>
        </div>

        <div>
            <p class="text-xs tracking-widest text-gray-500 uppercase mb-2">{{ $product->category->name }}</p>
            <h1 class="font-heading text-3xl text-maroon font-bold mb-2">{{ $product->name }}</h1>
            <div class="text-gold mb-3">★★★★★ <span class="text-gray-500 text-sm">(48 Review)</span></div>
            <p class="text-2xl font-heading font-semibold mb-6">IDR {{ number_format($product->price,0,',','.') }}</p>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                @php($colors = $product->variants->pluck('color','color_hex')->filter()->unique())
                @if($colors->count())
                    <p class="text-xs tracking-wide text-gray-500 mb-2">WARNA</p>
                    <div class="flex gap-2 mb-5">
                        @foreach($colors as $hex => $name)
                            <span class="w-8 h-8 rounded-full border-2 border-maroon" style="background-color: {{ $hex }}" title="{{ $name }}"></span>
                        @endforeach
                    </div>
                @endif

                <p class="text-xs tracking-wide text-gray-500 mb-2">UKURAN <a href="#" class="float-right underline">Panduan Ukuran</a></p>
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($product->variants as $variant)
                        <label class="border rounded text-center py-2 px-4 text-sm cursor-pointer has-[:checked]:bg-maroon has-[:checked]:text-white has-[:checked]:border-maroon {{ $variant->stock < 1 ? 'opacity-40 pointer-events-none' : '' }}">
                            <input type="radio" name="product_variant_id" value="{{ $variant->id }}" class="hidden" required @checked($loop->first)>
                            {{ $variant->size ?? $variant->color }}
                        </label>
                    @endforeach
                </div>

                <p class="text-xs tracking-wide text-gray-500 mb-2">JUMLAH</p>
                <input type="number" name="quantity" value="1" min="1" class="border rounded w-24 px-3 py-2 mb-6">

                <div class="grid gap-3">
                    <button type="submit" class="bg-maroon text-white py-3 text-sm tracking-wide font-medium">TAMBAH KE KERANJANG</button>
                    <button type="submit" formaction="{{ route('cart.add') }}" class="border border-maroon text-maroon py-3 text-sm tracking-wide font-medium">BELI SEKARANG</button>
                </div>
            </form>

            <div class="mt-8 border-t divide-y text-sm">
                <details class="py-3"><summary class="cursor-pointer font-medium text-maroon">INFORMASI PENGIRIMAN</summary>
                    <p class="mt-2 text-gray-600">Pengiriman ke seluruh Indonesia 3-7 hari kerja. Gratis ongkir untuk pembelian tertentu.</p></details>
                <details class="py-3"><summary class="cursor-pointer font-medium text-maroon">INSTRUKSI PERAWATAN</summary>
                    <p class="mt-2 text-gray-600">{{ $product->description }}</p></details>
            </div>
        </div>
    </div>

    @if($related->count())
    <section class="mt-16">
        <div class="flex justify-between mb-6">
            <h2 class="font-heading text-2xl text-maroon font-bold">Anda Mungkin Juga Suka</h2>
            <a href="{{ route('products.index') }}" class="text-sm underline text-maroon">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($related as $r)
                <a href="{{ route('products.show', $r) }}" class="group">
                    <div class="overflow-hidden rounded mb-3 bg-gray-100 aspect-[3/4]">
                        <img src="{{ $r->image }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                    </div>
                    <p class="text-xs text-gray-500 uppercase">{{ $r->category->name }}</p>
                    <p class="text-sm font-medium">{{ $r->name }}</p>
                    <p class="text-sm text-maroon font-semibold">{{ $r->formatted_price }}</p>
                </a>
            @endforeach
        </div>
    </section>
    @endif
</div>

@endsection
