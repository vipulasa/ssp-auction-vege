<?php

use function Livewire\Volt\{state, mount, on};

state([
    'cart' => null,
    'showCart' => false,
]);

mount(function () {

    $cart = auth()
        ->user()
        ->carts()
        ->where('is_paid', false)
        ->first();

    $this->cart = $cart;

});

$removeProduct = function ($productId) {
    $cart = $this->cart;

    $cart->products()->detach($productId);

    // calculate the total price of the cart
    $cart->total = $cart->products->sum(function ($product) {
        return $product->pivot->price * $product->pivot->quantity;
    });

    $cart->save();

    $this->cart = $cart;
};

on(['cartRefresh' => function () {
    $cart = auth()
        ->user()
        ->carts()
        ->where('is_paid', false)
        ->first();

    $this->cart = $cart;

    $this->showCart = true;
}]);
?>

<div>
    <div class="relative" x-data="{ open: @entangle('showCart') }">
        <button @click="open = !open"
                class="flex items-center justify-center w-10 h-10 bg-gray-800 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
            </svg>

        </button>
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 w-80 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-900">Cart</h3>
                <div class="mt-4">
                    <div class="items center space-y-6">
                        @foreach($cart->products as $product)
                            <div class="flex items center">
                                <img src="{{ $product->getFirstMediaUrl('featured_image') }}"
                                     class="w-10 h-10 object-cover rounded">
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">{{ $product->pivot->quantity }} x
                                        LKR {{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                                <button wire:click="removeProduct({{ $product->id }})"
                                        class="ml-auto text-gray-500 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                        <p class="mt-1 text-sm text-gray-500">
                            LKR {{ number_format($cart->total, 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
