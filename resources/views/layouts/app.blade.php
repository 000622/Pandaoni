<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pandaoni Collection')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { DEFAULT: '#5B1A2E', dark: '#3E1120', light: '#7A2540' },
                        cream: '#FAF3EA',
                        gold: '#B8965A',
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style> body { font-family: 'Poppins', sans-serif; } .font-heading { font-family: 'Playfair Display', serif; } </style>
</head>
<body class="bg-cream text-gray-800">

    <header class="bg-cream border-b border-maroon/10">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-heading text-2xl font-bold text-maroon leading-tight">PANDAONI<br class="hidden md:block"> <span class="text-lg md:text-2xl">COLLECTION</span></a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium tracking-wide text-maroon">
                <a href="{{ route('products.index', ['kategori' => 'pria']) }}" class="hover:text-gold">PRIA</a>
                <a href="{{ route('products.index', ['kategori' => 'wanita']) }}" class="hover:text-gold">WANITA</a>
                <a href="{{ route('products.index', ['kategori' => 'anak-anak']) }}" class="hover:text-gold">ANAK-ANAK</a>
                <a href="{{ route('products.index', ['kategori' => 'kebaya']) }}" class="hover:text-gold">KEBAYA</a>
                <a href="{{ route('products.index', ['kategori' => 'aksesoris']) }}" class="hover:text-gold">AKSESORIS</a>
            </nav>

            <div class="flex items-center gap-5 text-maroon">
                @auth
                    <div class="relative">
                        <button onclick="this.parentElement.querySelector('.acc-menu').classList.toggle('hidden')"
                                class="flex items-center gap-2 text-sm font-medium">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="hidden md:inline">{{ Str::before(auth()->user()->name, ' ') }}</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>

                        <div class="acc-menu hidden absolute right-0 top-full mt-2 w-48 bg-white border border-maroon/10 rounded-md shadow-lg z-50 py-1">
                            <div class="px-4 py-2 text-xs text-gray-500 border-b border-gray-100">
                                {{ auth()->user()->email }}
                            </div>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-cream">Admin Console</a>
                            @endif

                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm hover:bg-cream">Pesanan Saya</a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm text-maroon hover:bg-cream">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" title="Masuk">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                @endauth

                <a href="{{ route('cart.index') }}" class="relative" title="Keranjang">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    @auth
                        @php($count = auth()->user()->cart?->items->sum('quantity') ?? 0)
                        @if($count > 0)
                            <span class="absolute -top-2 -right-2 bg-maroon text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">{{ $count }}</span>
                        @endif
                    @endauth
                </a>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-green-50 text-green-800 border border-green-200 rounded px-4 py-3 text-sm">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-red-50 text-red-800 border border-red-200 rounded px-4 py-3 text-sm">{{ session('error') }}</div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-100 border-t border-maroon/10 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-heading text-2xl text-maroon font-bold mb-3">Pandaoni</h3>
                <p class="text-sm text-gray-600">Warisan tradisi yang dihidupkan kembali melalui desain kontemporer. Kualitas tanpa kompromi.</p>
            </div>
            <div>
                <h4 class="text-maroon font-semibold mb-3 text-sm tracking-wide">PERUSAHAAN</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Tentang Kami</li><li>Koleksi</li><li>Karir</li><li>Blog</li>
                </ul>
            </div>
            <div>
                <h4 class="text-maroon font-semibold mb-3 text-sm tracking-wide">BANTUAN</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>FAQ</li><li>Pengiriman</li><li>Pengembalian</li><li>Panduan Ukuran</li>
                </ul>
            </div>
            <div>
                <h4 class="text-maroon font-semibold mb-3 text-sm tracking-wide">HUBUNGI KAMI</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Instagram</li><li>Facebook</li><li>hello@pandaoni.com</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-xs text-gray-500 py-4 border-t border-gray-200">
            © {{ date('Y') }} Pandaoni Collection. Heritage-inspired premium fashion.
        </div>
    </footer>

    <script>
    document.addEventListener('click', function (e) {
        document.querySelectorAll('.acc-menu').forEach(function (menu) {
            if (!menu.parentElement.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
    </script>
</body>
</html>