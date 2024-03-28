<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignId('cart_id');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->float('tax', 10, 2)->default(0);
            $table->float('discount', 10, 2)->default(0);
            $table->float('price', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};
