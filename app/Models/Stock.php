<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quantity',
        'stock_status',
    ];

    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
