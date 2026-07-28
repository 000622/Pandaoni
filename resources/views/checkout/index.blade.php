@extends('layouts.app')
@section('title', 'Checkout - Pandaoni')
@section('content')

<div class="max-w-6xl mx-auto px-6 py-8">
    <div class="flex justify-center gap-6 text-sm text-gray-500 mb-10">
        <span class="text-maroon font-semibold">1. INFORMASI</span> —
        <span>2. PENGIRIMAN</span> —
        <span>3. PEMBAYARAN</span>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 border border-red-200 rounded p-4 mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" class="grid md:grid-cols-3 gap-10">
        @csrf
        <div class="md:col-span-2 space-y-8">
            <div>
                <h2 class="font-heading text-xl text-maroon font-bold mb-4">Alamat Pengiriman</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500 tracking-wide">NAMA LENGKAP</label>
                        <input type="text" name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}" class="w-full border-b py-2 outline-none" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500 tracking-wide">ALAMAT LENGKAP</label>
                        <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" placeholder="Nama Jalan, No. Rumah, Unit" class="w-full border-b py-2 outline-none" required>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 tracking-wide">KOTA</label>
                        <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" class="w-full border-b py-2 outline-none" required>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 tracking-wide">KODE POS</label>
                        <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}" class="w-full border-b py-2 outline-none" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500 tracking-wide">PROVINSI</label>
                        <select name="shipping_province" class="w-full border-b py-2 outline-none" required>
                            @foreach(['DKI Jakarta','Jawa Barat','Jawa Tengah','DI Yogyakarta','Jawa Timur','Banten','Bali'] as $prov)
                                <option @selected(old('shipping_province')==$prov)>{{ $prov }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="font-heading text-xl text-maroon font-bold mb-4">Metode Pembayaran</h2>
                <label class="flex items-center gap-3 border rounded p-4 mb-3 cursor-pointer has-[:checked]:border-maroon has-[:checked]:bg-maroon/5">
                    <input type="radio" name="payment_method" value="transfer_bank" checked>
                    <div><p class="font-medium text-sm">Transfer Bank (VA)</p><p class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</p></div>
                </label>
                <label class="flex items-center gap-3 border rounded p-4 cursor-pointer has-[:checked]:border-maroon has-[:checked]:bg-maroon/5">
                    <input type="radio" name="payment_method" value="kartu_kredit">
                    <div><p class="font-medium text-sm">Kartu Kredit / Debit</p><p class="text-xs text-gray-500">Visa, Mastercard, JCB</p></div>
                </label>
            </div>
        </div>

        <div class="bg-gray-50 rounded p-6 h-fit">
            <h3 class="font-heading text-lg text-maroon font-bold mb-4">Ringkasan Pesanan</h3>
            @foreach($cart->items as $item)
                <div class="flex justify-between text-sm mb-3">
                    <span>{{ $item->variant->product->name }} <span class="text-gray-400">x{{ $item->quantity }}</span></span>
                    <span>Rp {{ number_format($item->subtotal(),0,',','.') }}</span>
                </div>
            @endforeach
            <div class="border-t pt-3 space-y-2 text-sm">
                <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span></div>
                <div class="flex justify-between"><span>Pengiriman</span><span class="text-green-700">Gratis</span></div>
                <div class="flex justify-between"><span>Pajak (PPN 11%)</span><span>Rp {{ number_format($tax,0,',','.') }}</span></div>
            </div>
            <div class="flex justify-between font-bold text-maroon border-t pt-4 mt-3 mb-6">
                <span>TOTAL</span><span>Rp {{ number_format($total,0,',','.') }}</span>
            </div>
            <button class="w-full bg-maroon text-white py-3 text-sm tracking-wide font-medium">BUAT PESANAN 🔒</button>
            <p class="text-xs text-gray-500 mt-3 text-center">Dengan menekan tombol di atas, Anda menyetujui Syarat & Ketentuan serta Kebijakan Privasi kami.</p>
        </div>
    </form>
</div>

@endsection
