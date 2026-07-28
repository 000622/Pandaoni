@extends('layouts.admin')
@section('title', 'Produk - Admin Pandaoni')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola inventaris koleksi busana warisan Pandaoni.')
@section('page-action')
    <a href="{{ route('admin.products.create') }}" class="bg-maroon text-white px-5 py-2.5 rounded text-sm font-medium">+ TAMBAH PRODUK BARU</a>
@endsection

@section('content')
<form method="GET" class="flex gap-3 mb-6">
    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari SKU atau nama..." class="border rounded px-4 py-2 text-sm flex-1 max-w-sm">
    <select name="kategori" onchange="this.form.submit()" class="border rounded px-4 py-2 text-sm">
        <option value="">Semua Kategori</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(request('kategori')==$c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <button class="border rounded px-4 py-2 text-sm">Cari</button>
</form>

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
            @foreach($products as $product)
                <tr>
                    <td class="px-6 py-3 flex items-center gap-3">
                        <img src="{{ $product->image }}" class="w-10 h-10 rounded object-cover">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-3"><span class="bg-gray-100 text-xs px-2 py-1 rounded uppercase">{{ $product->category->name }}</span></td>
                    <td class="px-6 py-3">Rp {{ number_format($product->price,0,',','.') }}</td>
                    <td class="px-6 py-3 {{ ($product->variants_sum_stock ?? 0) < 10 ? 'text-red-600 font-semibold' : '' }}">{{ $product->variants_sum_stock ?? 0 }} Unit</td>
                    <td class="px-6 py-3 flex gap-3">
                        <a href="{{ route('admin.products.edit', $product) }}" title="Ubah">✏️</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button title="Hapus">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection
