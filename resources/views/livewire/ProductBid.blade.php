<?php

use function Livewire\Volt\{state, mount};

state([
    'product' => null
]);

mount(function () {

    // check if the user is not authenticated
    if (!auth()->check()) {
        // set the redirect url
        session()
            ->put('url.intended', route('product.show', $this->product->slug));
    }
});

?>

<div>
    @auth
    @endauth

    @guest
        <div>
            <a href="{{ route('login') }}" class="bg-red-500 text-white mt-4 p-4">
                Login to bid
            </a>
        </div>
    @endguest
</div>
