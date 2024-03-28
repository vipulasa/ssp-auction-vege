<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->longText('description')->nullable();
            $table->tinyInteger('status');
            $table->softDeletes();
            $table->timestamps();
        });

        // pivot table for auction and product
        Schema::create('auction_product', function (Blueprint $table) {
            $table->foreignId('auction_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('auction_product');
        Schema::dropIfExists('auctions');
    }
};
