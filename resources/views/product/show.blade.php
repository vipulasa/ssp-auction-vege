<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex space-x-5">
                    <img src="{{ $product->getFirstMediaUrl('featured_image') }}"
                         class="w-1/2" alt="">
                    <div>
                        <h1 class="mt-8 text-2xl font-medium text-gray-900">
                            {{ $product->name }}
                        </h1>

                        <span class="text-xs font-semibold text-gray-500">
                            <a href="{{ route('category.show', $product->category->slug) }}">
                                {{ $product->category->name }}
                            </a>
                        </span>

                        <p class="mt-3 text-gray-500 leading-relaxed">
                            {{ $product->description }}
                        </p>

                        <div class="mt-2">
                            <span class="text-gray-500 text-lg">
                                LKR {{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <div class="mt-5">

                            @livewire('ProductBid', ['product' => $product])
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
