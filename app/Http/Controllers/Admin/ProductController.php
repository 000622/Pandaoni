<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->withSum('variants', 'stock');

        if ($request->filled('cari')) {
            $cari = $request->input('cari');
            $query->where(fn ($q) => $q->where('name', 'ilike', "%{$cari}%")
                ->orWhere('slug', 'ilike', "%{$cari}%"));
        }

        if ($request->filled('kategori')) {
            $query->where('category_id', $request->input('kategori'));
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.form', ['categories' => $categories, 'product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(4);

        $product = Product::create($data);
        $this->syncVariants($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('variants');

        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        $product->update($data);
        $this->syncVariants($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:500'],
            'badge' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }

    protected function syncVariants(Request $request, Product $product): void
    {
        $product->variants()->delete();

        $sizes = $request->input('variant_size', []);
        $colors = $request->input('variant_color', []);
        $stocks = $request->input('variant_stock', []);

        foreach ($sizes as $i => $size) {
            if (blank($size) && blank($colors[$i] ?? null)) {
                continue;
            }
            $product->variants()->create([
                'size' => $size ?: null,
                'color' => $colors[$i] ?? null,
                'stock' => $stocks[$i] ?? 0,
            ]);
        }
    }
}