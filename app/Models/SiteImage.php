<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $fillable = ['key', 'label', 'image'];

    public static function url(string $key, ?string $fallback = null): string
    {
        $item = static::where('key', $key)->first();
        if ($item && $item->image) {
            return asset('storage/' . $item->image);
        }
        return $fallback ?? asset('images/placeholder.png');
    }
}