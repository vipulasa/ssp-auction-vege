<?php

namespace App\Models\Pivot;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    protected $fillable = [
        'quantity',
        'tax',
        'discount',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'tax' => 'float',
        'discount' => 'float',
        'price' => 'float'
    ];

    public function cart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
