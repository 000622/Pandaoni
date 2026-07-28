@extends('layouts.app')
@section('title', 'Pandaoni Collection - Beranda')
@section('content')

<section class="relative h-[520px] bg-maroon-dark flex items-end">
    <img src="https://down-id.img.susercontent.com/file/id-11134207-7r990-lxagsj4x3inie0" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Hero">
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
        <h1 class="font-heading text-white text-4xl md:text-5xl font-bold max-w-xl mb-4">Gaya yang Menceritakan Kisah Anda</h1>
        <p class="text-white/90 max-w-lg mb-6">Menghadirkan harmoni antara warisan budaya Nusantara dan desain kontemporer. Koleksi eksklusif untuk mereka yang menghargai setiap detail keindahan dan kemewahan yang abadi.</p>
        <div class="flex gap-4">
            <a href="{{ route('products.index') }}" class="bg-maroon text-white px-6 py-3 text-sm tracking-wide hover:bg-maroon-light">BELANJA KOLEKSI</a>
            <a href="{{ route('products.index', ['urutkan' => 'terbaru']) }}" class="border border-white text-white px-6 py-3 text-sm tracking-wide hover:bg-white/10">JELAJAHI PRODUK BARU</a>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex items-center justify-between mb-8">
        <h2 class="font-heading text-2xl text-maroon font-bold">Kategori Pilihan</h2>
        <a href="{{ route('products.index') }}" class="text-sm text-maroon underline">Lihat Semua Kategori</a>
    </div>

    {{--
        Grid asymmetric sesuai desain: Wanita & Pria full-height di kolom 1 & 2,
        kolom 3 dipecah jadi Kebaya (atas) & Anak-anak (bawah).
        Kategori lain (mis. Aksesoris) sengaja TIDAK ditampilkan di section ini,
        sesuai desain asli (aksesoris cukup ada di navbar).

        CATATAN: URL gambar di bawah ini SEMENTARA di-hardcode langsung
        (bukan lewat SiteImage::url()) karena fitur edit gambar admin
        masih error dan waktu pengumpulan tugas terbatas.
        Kalau nanti fitur SiteImage sudah diperbaiki, tinggal kembalikan
        ke \App\Models\SiteImage::url('category_wanita') dst.
    --}}
    @php
        $wanita   = $categories->firstWhere('slug', 'wanita');
        $pria     = $categories->firstWhere('slug', 'pria');
        $kebaya   = $categories->firstWhere('slug', 'kebaya');
        $anak     = $categories->firstWhere('slug', 'anak-anak');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4" style="grid-template-rows: repeat(2, 200px);">
        @if($wanita)
            <a href="{{ route('products.index', ['kategori' => $wanita->slug]) }}"
               class="relative rounded-lg overflow-hidden group md:row-span-2 h-48 md:h-full">
                <img src="https://cdn0-production-images-kly.akamaized.net/Zv0kFU0Zd6DQMPAR30pyfigJM4I=/1280x1280/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/5260261/original/071595800_1750565695-Gemini_Generated_Image_3qtd7a3qtd7a3qtd.jpg" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Wanita">
                <div class="absolute inset-0 bg-black/20"></div>
                <span class="absolute bottom-4 left-4 text-white font-heading text-lg">{{ $wanita->name }}</span>
            </a>
        @endif

        @if($pria)
            <a href="{{ route('products.index', ['kategori' => $pria->slug]) }}"
               class="relative rounded-lg overflow-hidden group md:row-span-2 h-48 md:h-full">
                <img src="https://down-id.img.susercontent.com/file/id-11134207-7r98q-lq8ttnio800udc" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Pria">
                <div class="absolute inset-0 bg-black/20"></div>
                <span class="absolute bottom-4 left-4 text-white font-heading text-lg">{{ $pria->name }}</span>
            </a>
        @endif

        @if($kebaya)
            <a href="{{ route('products.index', ['kategori' => $kebaya->slug]) }}"
               class="relative rounded-lg overflow-hidden group h-48 md:h-full">
                <img src="https://th.bing.com/th/id/OIP.2ufdEmcqQWGpsmevF8HcEwHaHa?rs=1&pid=ImgDetMain" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Kebaya">
                <div class="absolute inset-0 bg-black/20"></div>
                <span class="absolute bottom-3 left-3 text-white font-medium text-sm">{{ $kebaya->name }}</span>
            </a>
        @endif

        @if($anak)
            <a href="{{ route('products.index', ['kategori' => $anak->slug]) }}"
               class="relative rounded-lg overflow-hidden group h-48 md:h-full">
                <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rcdz-lrujk7ojbku8b8" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Anak-anak">
                <div class="absolute inset-0 bg-black/20"></div>
                <span class="absolute bottom-3 left-3 text-white font-medium text-sm">{{ $anak->name }}</span>
            </a>
        @endif
    </div>
</section>

<section class="bg-maroon">
    <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-8 items-center">
        <div class="text-white">
            <span class="text-xs tracking-widest text-gold">PENAWARAN TERBATAS</span>
            <h2 class="font-heading text-3xl font-bold my-3">Koleksi Warisan: Potongan 20%</h2>
            <p class="text-white/80 mb-5">Gunakan kode HERITAGE20 untuk pesanan pertama Anda. Berlaku untuk semua koleksi batik tulis premium dan kebaya sutra pilihan.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-gold text-maroon-dark px-6 py-3 text-sm font-semibold tracking-wide">DAPATKAN SEKARANG</a>
        </div>
        <img src="https://cdn.nona.my/2024/04/larney6.jpg" class="rounded shadow-lg" alt="Koleksi Warisan">
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="font-heading text-2xl text-maroon font-bold text-center mb-10">Produk Terbaru</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($newProducts as $product)
            <a href="{{ route('products.show', $product) }}" class="group">
                <div class="relative overflow-hidden rounded mb-3 bg-gray-100 aspect-[3/4]">
                    @if($product->badge)
                        <span class="absolute top-2 left-2 bg-maroon text-white text-[10px] px-2 py-1 tracking-wide z-10">{{ strtoupper($product->badge) }}</span>
                    @endif
                    <img src="{{ $product->image }}" class="w-full h-full object-cover group-hover:scale-105 transition" alt="{{ $product->name }}">
                </div>
                <p class="text-sm font-medium text-gray-800">{{ $product->name }}</p>
                <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>
                <p class="text-sm font-semibold text-maroon">{{ $product->formatted_price }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-gray-100 py-16">
    <div class="max-w-2xl mx-auto text-center px-6">
        <h2 class="font-heading text-2xl text-maroon font-bold mb-2">Bergabung dengan Jurnal Kami</h2>
        <p class="text-gray-600 mb-6">Dapatkan update eksklusif mengenai peluncuran koleksi baru, cerita di balik desain kami, dan penawaran khusus member.</p>
        <form class="flex gap-2 justify-center max-w-md mx-auto border-b border-maroon pb-2">
            <input type="email" placeholder="Alamat email Anda" class="flex-1 bg-transparent outline-none text-sm px-2">
            <button class="text-maroon text-sm font-semibold tracking-wide">LANGGANAN</button>
        </form>
    </div>
</section>

@endsection