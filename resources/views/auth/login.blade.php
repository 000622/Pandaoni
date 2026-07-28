@extends('layouts.app')
@section('title', 'Masuk - Pandaoni')
@section('content')

<div class="max-w-md mx-auto px-6 py-16">
    <h1 class="font-heading text-2xl text-maroon font-bold mb-6 text-center">Masuk ke Akun Anda</h1>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 border border-red-200 rounded p-3 mb-4 text-sm">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="text-xs text-gray-500 tracking-wide">EMAIL</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border-b py-2 outline-none" required autofocus>
        </div>
        <div>
            <label class="text-xs text-gray-500 tracking-wide">KATA SANDI</label>
            <input type="password" name="password" class="w-full border-b py-2 outline-none" required>
        </div>
        <label class="flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember"> Ingat saya
        </label>
        <button class="w-full bg-maroon text-white py-3 text-sm tracking-wide font-medium">MASUK</button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">Belum punya akun? <a href="{{ route('register') }}" class="text-maroon underline">Daftar di sini</a></p>

    <div class="mt-8 text-xs text-gray-400 text-center border-t pt-4">
        Demo: admin@pandaoni.com / customer@pandaoni.com — password: <b>password</b>
    </div>
</div>

@endsection
