<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'subtotal', 'shipping_cost', 'tax', 'total',
        'status', 'payment_method', 'shipping_name', 'shipping_address',
        'shipping_city', 'shipping_postal_code', 'shipping_province',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->total, 0, ',', '.');
    }

    public static function generateOrderNumber(): string
    {
        return 'PND-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
