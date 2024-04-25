<?php

use function Livewire\Volt\{state};
use App\Models\Cart;

state([
    'product' => null,
    'quantity' => 1,
    'cart' => null,
]);

$decrement = function () {
    $quantity = $this->quantity;
    $quantity = $quantity - 1;
    if ($quantity < 1) {
        $quantity = 1;
    }

    $this->quantity = $quantity;
};

$increment = function () {
    $quantity = $this->quantity;
    $this->quantity = $quantity + 1;

    // get the product stock
    $stock = $this->product->stocks;

    // check if the quantity is greater than the stock
    if ($this->quantity > $stock->first()->quantity) {
        $this->quantity = $stock->first()->quantity;
    }
};

$addToCart = function () {

    // check if the user has an active cart with the status is_paid false
    $cart = Cart::where('user_id', auth()->id())
        ->where('is_paid', false)
        ->first();

    // if not found, create a new cart
    if (!$cart) {
        $cart = Cart::create([
            'user_id' => auth()->id(),
            'is_paid' => false,
        ]);
    }

    // check if the product is already in the cart
    $cartItem = $cart->products()
        ->where('product_id', $this->product->id)
        ->first();

    // if the product is already in the cart, update the quantity
    if ($cartItem) {
        $cartItem->pivot->quantity = $this->quantity;
        $cartItem->pivot->save();
    } else {
        // if the product is not in the cart, add the product to the cart
        $cart
            ->products()
            ->attach($this->product->id, [
                'quantity' => $this->quantity,
                'tax' => 0,
                'discount' => 0,
                'price' => $this->product->price,
            ]);
    }

    // calculate the total price of the cart
    $cart->total = $cart->products->sum(function ($product) {
        return $product->pivot->price * $product->pivot->quantity;
    });

    $cart->save();

    // dispatch cart refresh event
    $this->dispatch('cartRefresh');
}

?>

<div>
    <div class="flex justify-between items-center">
        <div class="flex items center">
            <button wire:click="decrement" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded">
                -
            </button>
            <input type="text" class="px-4 py-2 w-20 bg-gray-200 text-center" value="{{ $quantity }}">
            <button wire:click="increment" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded">
                +
            </button>
        </div>
    </div>
    <div class="mt-5">
        <button wire:click="addToCart" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded">
            Add to Cart
        </button>
    </div>

    {{ $cart?->total }}
</div>
