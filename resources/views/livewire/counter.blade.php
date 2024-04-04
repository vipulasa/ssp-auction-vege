<?php

use function Livewire\Volt\{state};

state([
    'count' => 0,
    'product' => null,
]);

$increment = function () {
    $this->count++;
};

$getRandomProduct = function () {
    $this->product = (new \App\Models\Product())->inRandomOrder()->first();
};

?>

<div class="text-center mt-10 max-w-2xl  mx-auto">
    <button wire:click="getRandomProduct">Get Random Product</button>

    @if($product)
        <x-product :product="$product"/>
    @endif

</div>
