<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id', 'size', 'color', 'color_hex', 'stock', 'price_override',
    ];

    protected function casts(): array
    {
        return [
            'price_override' => 'decimal:2',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->price_override ?? $this->product->price);
    }

    public function getLabelAttribute(): string
    {
        return trim(collect([$this->color, $this->size])->filter()->implode(' / '));
    }
}
