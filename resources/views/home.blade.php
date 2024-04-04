<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    @livewire('counter')

    <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-6 gap-4 mx-10 mt-10">
        @foreach($products as $product)
            <x-product :product="$product" />
        @endforeach
    </div>

</x-app-layout>
