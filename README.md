# Pandaoni Collection — Laravel + PostgreSQL

Project e-commerce fashion (storefront + admin console) sesuai desain yang kamu kirimkan. Panduan ini untuk setup di **Laragon** dengan **PostgreSQL**.

## Fitur
- **Storefront**: Beranda, Katalog (filter kategori/ukuran/warna/harga + sortir), Detail Produk, Keranjang, Checkout, Halaman Sukses.
- **Auth**: Login & Register (role `admin` / `customer`).
- **Admin Console**: Dashboard (statistik), Manajemen Produk (CRUD + variasi ukuran/warna/stok), Manajemen Pesanan (ubah status).
- Data dummy: 5 kategori, 20 produk (dengan variasi), 1 akun admin, 1 akun customer.

## 1. Buat Project Laravel Baru
Buka terminal Laragon (Terminal > cwd project), lalu:

```bash
composer create-project laravel/laravel pandaoni
cd pandaoni
```

## 2. Salin File dari Paket Ini
Salin **isi folder ini** (kecuali `README.md` dan `bootstrap_app_snippet.php`) ke folder project `pandaoni` yang baru dibuat, timpa file yang sama:

```
app/Models/                  -> pandaoni/app/Models/
app/Http/Controllers/        -> pandaoni/app/Http/Controllers/
app/Http/Middleware/         -> pandaoni/app/Http/Middleware/
database/migrations/         -> pandaoni/database/migrations/
database/seeders/            -> pandaoni/database/seeders/
routes/web.php                -> pandaoni/routes/web.php (timpa)
resources/views/             -> pandaoni/resources/views/
```

## 3. Daftarkan Middleware Admin
Buka `bootstrap/app.php` di project Laravel-mu, tambahkan alias middleware (lihat detail di `bootstrap_app_snippet.php`):

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    ]);
})
```

## 4. Install Driver PostgreSQL untuk PHP (Laragon)
1. Buka **Laragon > Menu > PHP > php.ini** (atau edit langsung file `php.ini` PHP yang aktif).
2. Pastikan baris berikut **tidak** diberi tanda `;` di depannya (uncomment):
   ```
   extension=pdo_pgsql
   extension=pgsql
   ```
3. Restart Laragon (Stop All > Start All).

## 5. Buat Database PostgreSQL
Buka **pgAdmin** atau psql, buat database baru:
```sql
CREATE DATABASE pandaoni;
```

## 6. Konfigurasi `.env`
Edit file `.env` di root project:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pandaoni
DB_USERNAME=postgres
DB_PASSWORD=isi_password_postgres_kamu
```

Jika kamu memakai PostgreSQL portable bawaan Laragon, host/port/username bisa berbeda — cek di Laragon > PostgreSQL.

## 7. Migrate & Seed
```bash
php artisan migrate
php artisan db:seed
```

Ini akan membuat semua tabel + mengisi data dummy (kategori, produk, dan 2 akun):

| Role     | Email                  | Password  |
|----------|------------------------|-----------|
| Admin    | admin@pandaoni.com     | password  |
| Customer | customer@pandaoni.com  | password  |

## 8. Jalankan Project
Arahkan domain Laragon ke folder `pandaoni/public`, atau jalankan:
```bash
php artisan serve
```
lalu buka `http://localhost:8000`.

Admin console ada di `http://localhost:8000/admin` (login sebagai admin dulu).

## Catatan
- Gambar produk pada data dummy memakai layanan placeholder (`picsum.photos`) — ganti `image` di tabel `products` / form admin dengan URL foto asli produk kamu nanti.
- Tailwind dimuat via CDN (tidak perlu `npm install`/build) supaya setup di Laragon lebih ringan untuk keperluan tugas kuliah. Kalau nanti mau production-ready, ganti ke Tailwind via Vite.
- Checkout memakai alur 1 halaman (alamat + pembayaran + ringkasan) — belum ada integrasi payment gateway riil (Midtrans/Xendit), status pesanan langsung `pending` dan bisa diubah manual dari Admin > Pesanan.
