<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'description'];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('name', 'like', '%' . $keyword . '%');
    }
        return $query;
    }

    public function scopePriceOrder($query, $priceOrder)
    {
        if ($priceOrder === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($priceOrder === 'low') {
            $query->orderBy('price', 'asc');
        }
        return $query;
    }
}
