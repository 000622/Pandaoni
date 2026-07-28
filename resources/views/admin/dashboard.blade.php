@extends('layouts.admin')
@section('title', 'Dashboard - Admin Pandaoni')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola inventaris koleksi busana warisan Pandaoni.')
@section('page-action')
    <a href="{{ route('admin.products.create') }}" class="bg-maroon text-white px-5 py-2.5 rounded text-sm font-medium">+ TAMBAH PRODUK BARU</a>
@endsection

@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white border-l-4 border-maroon rounded p-5">
        <p class="text-xs text-gray-500 tracking-wide mb-1">TOTAL PRODUK</p>
        <p class="text-2xl font-heading font-bold">{{ number_format($totalProduk) }}</p>
    </div>
    <div class="bg-white border-l-4 border-gold rounded p-5">
        <p class="text-xs text-gray-500 tracking-wide mb-1">PESANAN BARU</p>
        <p class="text-2xl font-heading font-bold">{{ $pesananBaru }} <span class="text-xs text-red-600 font-normal">Harap Proses</span></p>
    </div>
    <div class="bg-white border-l-4 border-gray-400 rounded p-5">
        <p class="text-xs text-gray-500 tracking-wide mb-1">PENJUALAN (BLN INI)</p>
        <p class="text-2xl font-heading font-bold">Rp {{ number_format($penjualanBulanIni,0,',','.') }}</p>
    </div>
    <div class="bg-red-50 border-l-4 border-red-500 rounded p-5">
        <p class="text-xs text-red-600 tracking-wide mb-1">STOK RENDAH</p>
        <p class="text-2xl font-heading font-bold text-red-700">{{ $stokRendah }} <a href="{{ route('admin.products.index') }}" class="text-xs underline font-normal">Lihat Detail</a></p>
    </div>
</div>

<div class="bg-white rounded shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 tracking-wide">
            <tr>
                <th class="text-left px-6 py-3">PRODUK</th>
                <th class="text-left px-6 py-3">KATEGORI</th>
                <th class="text-left px-6 py-3">HARGA</th>
                <th class="text-left px-6 py-3">STOK</th>
                <th class="text-left px-6 py-3">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($produkTerbaru as $product)
                <tr>
                    <td class="px-6 py-3 flex items-center gap-3">
                        <img src="{{ $product->image }}" class="w-10 h-10 rounded object-cover">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-3"><span class="bg-gray-100 text-xs px-2 py-1 rounded uppercase">{{ $product->category->name }}</span></td>
                    <td class="px-6 py-3">Rp {{ number_format($product->price,0,',','.') }}</td>
                    <td class="px-6 py-3 {{ $product->variants_sum_stock < 10 ? 'text-red-600 font-semibold' : '' }}">{{ $product->variants_sum_stock ?? 0 }} Unit</td>
                    <td class="px-6 py-3">
                        <a href="{{ route('admin.products.edit', $product) }}">✏️</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
