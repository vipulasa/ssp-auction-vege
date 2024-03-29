<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'quantity',
        'stock_status',
        'unit_type',
        'unit_price',
    ];

    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
