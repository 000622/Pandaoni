<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Pandaoni')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            colors: { maroon: { DEFAULT: '#5B1A2E', dark: '#3E1120', light: '#7A2540' }, cream: '#FAF3EA', gold: '#B8965A' },
            fontFamily: { serif: ['"Playfair Display"', 'serif'], sans: ['Poppins', 'sans-serif'] },
        } } }
    </script>
    <style> body { font-family: 'Poppins', sans-serif; } .font-heading { font-family: 'Playfair Display', serif; } </style>
</head>
<body class="bg-cream text-gray-800 flex">

    <aside class="w-64 bg-maroon min-h-screen text-white/80 flex flex-col">
        <div class="p-6 border-b border-white/10">
            <p class="font-heading text-xl font-bold text-white">PANDAONI</p>
            <p class="text-xs tracking-widest text-white/60">ADMIN CONSOLE</p>
        </div>
        <nav class="flex-1 py-4">
            @php
                $navs = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '📊'],
                    ['label' => 'Produk', 'route' => 'admin.products.index', 'icon' => '👕'],
                    ['label' => 'Pesanan', 'route' => 'admin.orders.index', 'icon' => '🛒'],
                ];
            @endphp
            @foreach($navs as $nav)
                <a href="{{ route($nav['route']) }}" class="flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs($nav['route'].'*') ? 'bg-maroon-dark text-white font-medium' : 'hover:bg-maroon-dark/60' }}">
                    <span>{{ $nav['icon'] }}</span> {{ strtoupper($nav['label']) }}
                </a>
            @endforeach
        </nav>

        {{-- Footer sidebar: profil + link ke storefront + logout (sebelumnya di sini cuma teks, tidak ada tombol) --}}
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-gold text-maroon-dark flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name,0,2)) }}
                </div>
                <div class="text-xs">
                    <p class="text-white font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-white/60">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <a href="{{ route('home') }}" class="block text-xs text-white/70 hover:text-white mb-2">
                &larr; Kembali ke Toko
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-xs bg-white/10 hover:bg-white/20 text-white rounded px-3 py-2 transition">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1">
        <div class="max-w-7xl mx-auto px-8 py-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="font-heading text-3xl text-maroon font-bold">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-gray-600 text-sm mt-1">@yield('page-subtitle')</p>
                </div>
                @hasSection('page-action') @yield('page-action') @endif
            </div>

            @if(session('success'))
                <div class="bg-green-50 text-green-800 border border-green-200 rounded px-4 py-3 text-sm mb-6">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>