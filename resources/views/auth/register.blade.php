@extends('layouts.app')
@section('title', 'Daftar - Pandaoni')
@section('content')

<div class="max-w-md mx-auto px-6 py-16">
    <h1 class="font-heading text-2xl text-maroon font-bold mb-6 text-center">Buat Akun Baru</h1>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 border border-red-200 rounded p-3 mb-4 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="text-xs text-gray-500 tracking-wide">NAMA LENGKAP</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border-b py-2 outline-none" required autofocus>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">EMAIL</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border-b py-2 outline-none" required>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">NOMOR TELEPON</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border-b py-2 outline-none">
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">KATA SANDI</label>
            <input type="password" name="password" class="w-full border-b py-2 outline-none" required>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">KONFIRMASI KATA SANDI</label>
            <input type="password" name="password_confirmation" class="w-full border-b py-2 outline-none" required>
        </div>
        <button class="w-full bg-maroon text-white py-3 text-sm tracking-wide font-medium">DAFTAR</button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">Sudah punya akun? <a href="{{ route('login') }}" class="text-maroon underline">Masuk di sini</a></p>
</div>

@endsection
