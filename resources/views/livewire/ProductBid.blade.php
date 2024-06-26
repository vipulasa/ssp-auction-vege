<?php

use function Livewire\Volt\{state, mount};

state([
    'product' => null,
    'bid' => null,
    'message' => null,
    'min_bid' => null
]);

mount(function () {

    // check if the user is not authenticated
    if (!auth()->check()) {
        // set the redirect url
        session()
            ->put('url.intended', route('product.show', $this->product->slug));
    }

    // check if the product has any bids
    if ($this->product->bids->count()) {

        // get the minimum bid
        $this->min_bid = $this->product->bids->max('bid') + 50;

    } else {

        // set the minimum bid to the product price
        $this->min_bid = $this->product->price;

    }
});

$placeBid = function () {
    $this->validate([
        'bid' => 'required|numeric|min:' . $this->min_bid
    ]);

    $this->product->bids()->create([
        'auction_id' => 1,
        'user_id' => auth()->id(),
        'bid' => $this->bid
    ]);

    $this->message = 'Bid placed successfully';

    $this->bid = null;

    // check if the product has any bids
    if ($this->product->bids->count()) {

        // get the minimum bid
        $this->min_bid = $this->product->bids->max('bid') + 50;

    } else {

        // set the minimum bid to the product price
        $this->min_bid = $this->product->price;

    }

};

?>

<div>
    @auth
        <form wire:submit.prevent="placeBid">
            @if($message)
                <div class="bg-green-500 text-white p-4 mb-3">{{ $message }}</div>
            @endif
            <h3>Place Bid</h3>
            <input type="text" placeholder="LKR" wire:model="bid"/>
            @error('bid') <span class="text-red-500">{{ $message }}</span> @enderror
            <div>
                <div class="text-sm mt-4 mb-4">Minimum Bid: {{ $min_bid }}</div>
                <button class="bg-blue-500 text-white p-2">Place Bid</button>
            </div>
        </form>
    @endauth

    @guest
        <div>
            <a href="{{ route('login') }}" class="bg-red-500 text-white mt-4 p-4">
                Login to bid
            </a>
        </div>
    @endguest

    <table class="mt-8">
        <thead>
        <tr>
            <th>Bidder</th>
            <th>Bid</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product->bids()->orderBy('bid', 'DESC')->get() as $bid)
            <tr>
                <td>{{ $bid->user->name }}</td>
                <td>{{ $bid->bid }}</td>
                <td>{{ $bid->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
