@extends('layouts.admin')
@section('title', ($product->exists ? 'Ubah' : 'Tambah') . ' Produk - Admin Pandaoni')
@section('page-title', $product->exists ? 'Ubah Produk' : 'Tambah Produk Baru')
@section('page-subtitle', 'Lengkapi detail produk dan variasinya (ukuran/warna/stok).')

@section('content')
<form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" class="bg-white rounded shadow-sm p-8 max-w-3xl">
    @csrf
    @if($product->exists) @method('PUT') @endif

    @if($errors->any())
        <div class="bg-red-50 text-red-700 border border-red-200 rounded p-3 mb-4 text-sm">
            <ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-5 mb-5">
        <div class="md:col-span-2">
            <label class="text-xs text-gray-500 tracking-wide">NAMA PRODUK</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">KATEGORI</label>
            <select name="category_id" class="w-full border rounded px-3 py-2 mt-1" required>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id)==$c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">HARGA (RP)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">URL GAMBAR</label>
            <input type="text" name="image" value="{{ old('image', $product->image) }}" class="w-full border rounded px-3 py-2 mt-1" placeholder="https://...">
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">BADGE (opsional)</label>
            <input type="text" name="badge" value="{{ old('badge', $product->badge) }}" placeholder="Baru / Terbatas / Edisi Terbatas" class="w-full border rounded px-3 py-2 mt-1">
        </div>
        <div class="md:col-span-2">
            <label class="text-xs text-gray-500 tracking-wide">DESKRIPSI</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 mt-1">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
            <label class="text-sm">Aktif / tampilkan di toko</label>
        </div>
    </div>

    <h3 class="font-semibold text-maroon mb-3 mt-6">Variasi Produk (Ukuran / Warna / Stok)</h3>
    <div id="variant-rows" class="space-y-3 mb-4">
        @php($variants = old('variant_size') ? collect(old('variant_size'))->map(fn($s,$i)=>['size'=>$s,'color'=>old('variant_color')[$i]??'','stock'=>old('variant_stock')[$i]??0]) : ($product->exists ? $product->variants : collect([['size'=>'','color'=>'','stock'=>0]])))
        @forelse($variants as $v)
            <div class="grid grid-cols-3 gap-3 variant-row">
                <input type="text" name="variant_size[]" value="{{ is_array($v) ? $v['size'] : $v->size }}" placeholder="Ukuran (S/M/L)" class="border rounded px-3 py-2">
                <input type="text" name="variant_color[]" value="{{ is_array($v) ? $v['color'] : $v->color }}" placeholder="Warna" class="border rounded px-3 py-2">
                <input type="number" name="variant_stock[]" value="{{ is_array($v) ? $v['stock'] : $v->stock }}" placeholder="Stok" class="border rounded px-3 py-2">
            </div>
        @empty
        @endforelse
    </div>
    <button type="button" onclick="addVariantRow()" class="text-sm text-maroon underline mb-6">+ Tambah Variasi</button>

    <div class="flex gap-3">
        <button class="bg-maroon text-white px-6 py-2.5 rounded text-sm font-medium">{{ $product->exists ? 'SIMPAN PERUBAHAN' : 'TAMBAH PRODUK' }}</button>
        <a href="{{ route('admin.products.index') }}" class="border px-6 py-2.5 rounded text-sm">Batal</a>
    </div>
</form>

<script>
function addVariantRow() {
    const container = document.getElementById('variant-rows');
    const row = document.createElement('div');
    row.className = 'grid grid-cols-3 gap-3 variant-row';
    row.innerHTML = `
        <input type="text" name="variant_size[]" placeholder="Ukuran (S/M/L)" class="border rounded px-3 py-2">
        <input type="text" name="variant_color[]" placeholder="Warna" class="border rounded px-3 py-2">
        <input type="number" name="variant_stock[]" placeholder="Stok" class="border rounded px-3 py-2">
    `;
    container.appendChild(row);
}
</script>
@endsection
