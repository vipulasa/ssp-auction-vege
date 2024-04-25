<?php

namespace App\Models;

use App\Models\Pivot\CartProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'item_count',
        'sub_total',
        'total_discount',
        'total',
        'total_tax',
        'is_paid',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this
            ->belongsToMany(Product::class)
            ->using(CartProduct::class)
            ->withPivot([
                'quantity',
                'tax',
                'discount',
                'price',
            ]);
    }
}
