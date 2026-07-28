<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_active', true)->with('category', 'variants');

        // Filter kategori (bisa banyak, checkbox)
        if ($request->filled('kategori')) {
            $slugs = (array) $request->input('kategori');
            $query->whereHas('category', fn ($q) => $q->whereIn('slug', $slugs));
        }

        // Filter ukuran
        if ($request->filled('ukuran')) {
            $query->whereHas('variants', fn ($q) => $q->where('size', $request->input('ukuran')));
        }

        // Filter warna
        if ($request->filled('warna')) {
            $query->whereHas('variants', fn ($q) => $q->where('color', $request->input('warna')));
        }

        // Rentang harga
        if ($request->filled('harga_min')) {
            $query->where('price', '>=', (float) $request->input('harga_min'));
        }
        if ($request->filled('harga_max')) {
            $query->where('price', '<=', (float) $request->input('harga_max'));
        }

        // Sortir
        match ($request->input('urutkan')) {
            'harga_terendah' => $query->orderBy('price', 'asc'),
            'harga_tertinggi' => $query->orderBy('price', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(8)->withQueryString();
        $categories = Category::all();
        $colors = \App\Models\ProductVariant::whereNotNull('color')->distinct()->pluck('color', 'color_hex');

        return view('products.index', compact('products', 'categories', 'colors'));
    }

    public function show(Product $product)
    {
        $product->load('variants', 'category');
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
