@extends('layouts.app')
@section('title', 'Semua Koleksi - Pandaoni')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="text-xs text-gray-500 mb-4">
        <a href="{{ route('home') }}" class="hover:underline">Beranda</a> &gt; Koleksi &gt; <span class="text-maroon font-medium">Semua Koleksi</span>
    </div>

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 gap-4">
        <div>
            <h1 class="font-heading text-3xl text-maroon font-bold mb-2">Semua Koleksi</h1>
            <p class="text-gray-600 max-w-xl text-sm">Jelajahi keindahan warisan budaya dalam balutan modernitas. Dari Kebaya kontemporer hingga aksesori etnik yang mewah.</p>
        </div>
        <form method="GET" class="flex items-center gap-2 text-sm">
            <label class="text-gray-600 tracking-wide">URUTKAN:</label>
            <select name="urutkan" onchange="this.form.submit()" class="border border-gray-300 rounded px-3 py-2">
                <option value="">Terbaru</option>
                <option value="harga_terendah" @selected(request('urutkan')=='harga_terendah')>Harga Terendah</option>
                <option value="harga_tertinggi" @selected(request('urutkan')=='harga_tertinggi')>Harga Tertinggi</option>
            </select>
        </form>
    </div>

    <div class="grid md:grid-cols-4 gap-8">
        <aside class="md:col-span-1">
            <form method="GET">
                @if(request('urutkan'))<input type="hidden" name="urutkan" value="{{ request('urutkan') }}">@endif
                <h3 class="font-semibold text-maroon mb-3 text-sm tracking-wide">KATEGORI</h3>
                <div class="space-y-2 mb-6 text-sm">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori[]" value="{{ $category->slug }}"
                                @checked(in_array($category->slug, (array) request('kategori', [])))>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>

                <h3 class="font-semibold text-maroon mb-3 text-sm tracking-wide">UKURAN</h3>
                <div class="grid grid-cols-3 gap-2 mb-6 text-sm">
                    @foreach(['XS','S','M','L','XL','XXL'] as $size)
                        <label class="border rounded text-center py-1.5 cursor-pointer has-[:checked]:bg-maroon has-[:checked]:text-white">
                            <input type="radio" name="ukuran" value="{{ $size }}" class="hidden" @checked(request('ukuran')==$size)>{{ $size }}
                        </label>
                    @endforeach
                </div>

                <h3 class="font-semibold text-maroon mb-3 text-sm tracking-wide">WARNA</h3>
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($colors as $hex => $name)
                        <label class="w-7 h-7 rounded-full border-2 cursor-pointer has-[:checked]:ring-2 ring-offset-1 ring-maroon" style="background-color: {{ $hex }}" title="{{ $name }}">
                            <input type="radio" name="warna" value="{{ $name }}" class="hidden" @checked(request('warna')==$name)>
                        </label>
                    @endforeach
                </div>

                <h3 class="font-semibold text-maroon mb-3 text-sm tracking-wide">RENTANG HARGA</h3>
                <div class="flex items-center gap-2 mb-6 text-sm">
                    <input type="number" name="harga_min" value="{{ request('harga_min') }}" placeholder="Rp 0" class="w-full border rounded px-2 py-1.5">
                    <span>-</span>
                    <input type="number" name="harga_max" value="{{ request('harga_max') }}" placeholder="Rp 5.000.000" class="w-full border rounded px-2 py-1.5">
                </div>

                <button class="w-full bg-maroon text-white py-2.5 text-sm tracking-wide font-medium">TERAPKAN FILTER</button>
            </form>
        </aside>

        <div class="md:col-span-3">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="group">
                        <div class="relative overflow-hidden rounded mb-3 bg-gray-100 aspect-[3/4]">
                            @if($product->badge)
                                <span class="absolute top-2 left-2 bg-maroon text-white text-[10px] px-2 py-1 tracking-wide z-10">{{ strtoupper($product->badge) }}</span>
                            @endif
                            <img src="{{ $product->image }}" class="w-full h-full object-cover group-hover:scale-105 transition" alt="{{ $product->name }}">
                        </div>
                        <p class="text-sm font-medium text-gray-800">{{ $product->name }}</p>
                        <p class="text-xs text-gray-500 uppercase mb-1">{{ $product->category->name }}</p>
                        <p class="text-sm font-semibold text-maroon">{{ $product->formatted_price }}</p>
                    </a>
                @empty
                    <p class="col-span-4 text-gray-500 text-sm">Tidak ada produk yang cocok dengan filter Anda.</p>
                @endforelse
            </div>

            <div class="mt-10">{{ $products->links() }}</div>
        </div>
    </div>
</div>

@endsection
