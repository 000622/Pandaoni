<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cat = fn (string $name) => Category::where('slug', Str::slug($name))->first()->id;

        $products = [
            [
                'category' => 'Kebaya', 'name' => "Kebaya Modern 'Larasati'", 'price' => 2450000,
                'badge' => 'Koleksi Baru', 'image' => 'https://picsum.photos/seed/larasati/600/800',
                'variants' => [['S', 'Merah Marun', '#6B1F3A', 12], ['M', 'Merah Marun', '#6B1F3A', 20], ['L', 'Merah Marun', '#6B1F3A', 13]],
            ],
            [
                'category' => 'Pria', 'name' => 'Kemeja Sutra Batik Aruna', 'price' => 1850000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/aruna/600/800',
                'variants' => [['M', 'Charcoal Grey', '#333333', 15], ['L', 'Charcoal Grey', '#333333', 9], ['XL', 'Charcoal Grey', '#333333', 3]],
            ],
            [
                'category' => 'Aksesoris', 'name' => "Kalung Etnik 'Kencana'", 'price' => 890000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/kencana-kalung/600/800',
                'variants' => [['One Size', 'Gold', '#B8965A', 25]],
            ],
            [
                'category' => 'Wanita', 'name' => "Gaun Resepsi 'Kirana'", 'price' => 3100000,
                'badge' => 'Terbatas', 'image' => 'https://picsum.photos/seed/kirana/600/800',
                'variants' => [['S', 'Copper', '#B87333', 5], ['M', 'Copper', '#B87333', 7]],
            ],
            [
                'category' => 'Wanita', 'name' => 'Drupadi Silk Batik Dress', 'price' => 2499000,
                'badge' => 'Baru', 'image' => 'https://picsum.photos/seed/drupadi/600/800',
                'variants' => [['S', 'Indigo & Copper', '#2C3E66', 8], ['M', 'Indigo & Copper', '#2C3E66', 11]],
            ],
            [
                'category' => 'Pria', 'name' => 'Arjuna Signature Shirt', 'price' => 1850000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/arjuna/600/800',
                'variants' => [['M', 'Charcoal Grey', '#333333', 14], ['L', 'Charcoal Grey', '#333333', 6]],
            ],
            [
                'category' => 'Kebaya', 'name' => 'Kencana Emerald Kebaya', 'price' => 4200000,
                'badge' => 'Edisi Terbatas', 'image' => 'https://picsum.photos/seed/emerald/600/800',
                'variants' => [['S', 'Emerald Green', '#046A38', 4], ['M', 'Emerald Green', '#046A38', 6]],
            ],
            [
                'category' => 'Aksesoris', 'name' => 'Prasetya Leather Loafers', 'price' => 1599000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/loafers/600/800',
                'variants' => [['40', 'Tan Leather', '#A9713F', 10], ['41', 'Tan Leather', '#A9713F', 12], ['42', 'Tan Leather', '#A9713F', 8]],
            ],
            [
                'category' => 'Kebaya', 'name' => 'Silk Heritage Wrap', 'price' => 1250000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/heritagewrap/600/800',
                'variants' => [['S', 'Burgundy Heritage', '#6B1F3A', 9], ['M', 'Burgundy Heritage', '#6B1F3A', 15], ['L', 'Burgundy Heritage', '#6B1F3A', 7], ['XL', 'Burgundy Heritage', '#6B1F3A', 4]],
            ],
            [
                'category' => 'Wanita', 'name' => 'Heritage Batik Skirt', 'price' => 850000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/batikskirt/600/800',
                'variants' => [['M', 'Batik Coklat', '#5A3A22', 10]],
            ],
            [
                'category' => 'Aksesoris', 'name' => 'Kencana Gold Brooch', 'price' => 450000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/broochgold/600/800',
                'variants' => [['One Size', 'Gold', '#B8965A', 30]],
            ],
            [
                'category' => 'Kebaya', 'name' => 'Minimalist Silk Kebaya', 'price' => 980000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/minimalistkebaya/600/800',
                'variants' => [['S', 'Putih Gading', '#F3E9DA', 6], ['M', 'Putih Gading', '#F3E9DA', 9]],
            ],
            [
                'category' => 'Aksesoris', 'name' => 'Luxury Silk Shawl', 'price' => 550000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/silkshawl/600/800',
                'variants' => [['One Size', 'Merah Marun', '#6B1F3A', 14]],
            ],
            [
                'category' => 'Kebaya', 'name' => 'Kebaya Kinasih Silk', 'price' => 2450000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/kinasih/600/800',
                'variants' => [['S', 'Merah Marun', '#6B1F3A', 15], ['M', 'Merah Marun', '#6B1F3A', 18], ['L', 'Merah Marun', '#6B1F3A', 12]],
            ],
            [
                'category' => 'Pria', 'name' => 'Batik Pria Parang Kusumo', 'price' => 1850000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/parangkusumo/600/800',
                'variants' => [['M', 'Gold Charcoal', '#7A6A3A', 3], ['L', 'Gold Charcoal', '#7A6A3A', 5]],
            ],
            [
                'category' => 'Aksesoris', 'name' => 'Cunduk Mentul Kencana', 'price' => 750000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/cundukmentul/600/800',
                'variants' => [['Set of 5', 'Gold Plated', '#B8965A', 120]],
            ],
            [
                'category' => 'Anak-anak', 'name' => 'Dress Batik Sekar Alit', 'price' => 425000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/sekaralit/600/800',
                'variants' => [['4-6 thn', 'Pastel Pink', '#F4C2C2', 12]],
            ],
            [
                'category' => 'Anak-anak', 'name' => "Rompi Batik Anak 'Cilik'", 'price' => 650000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/rompianak/600/800',
                'variants' => [['S', 'Navy Batik', '#1E2A4A', 10]],
            ],
            [
                'category' => 'Kebaya', 'name' => "Kebaya Kerah Tinggi 'Adem'", 'price' => 2150000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/adem/600/800',
                'variants' => [['M', 'Putih Gading', '#F3E9DA', 8]],
            ],
            [
                'category' => 'Aksesoris', 'name' => "Sandal Kulit 'Karsa'", 'price' => 1200000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/karsa/600/800',
                'variants' => [['40', 'Tan Leather', '#A9713F', 9], ['41', 'Tan Leather', '#A9713F', 11]],
            ],
            [
                'category' => 'Pria', 'name' => "Jas Batik Eksklusif 'Satria'", 'price' => 4500000,
                'badge' => null, 'image' => 'https://picsum.photos/seed/satria/600/800',
                'variants' => [['L', 'Navy', '#1E2A4A', 4], ['XL', 'Navy', '#1E2A4A', 2]],
            ],
        ];

        foreach ($products as $p) {
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $cat($p['category']),
                    'name' => $p['name'],
                    'description' => 'Menghadirkan harmoni antara warisan budaya Nusantara dan desain kontemporer. Koleksi eksklusif untuk mereka yang menghargai setiap detail keindahan dan kemewahan yang abadi.',
                    'price' => $p['price'],
                    'image' => $p['image'],
                    'badge' => $p['badge'],
                    'is_active' => true,
                ]
            );

            $product->variants()->delete();
            foreach ($p['variants'] as [$size, $color, $hex, $stock]) {
                $product->variants()->create([
                    'size' => $size,
                    'color' => $color,
                    'color_hex' => $hex,
                    'stock' => $stock,
                ]);
            }
        }
    }
}
