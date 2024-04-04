@props([
    'product' => null
])
@if($product)
    <div class="bg-white shadow-lg rounded-lg p-4">
        <div class="mb-4">
            <img src="{{ $product->getFirstMediaUrl('featured_image') }}" alt="{{ $product->name }}"
                 class="w-full h-32 object-cover rounded">
        </div>
        <div class="justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
            <span class="text-xs font-semibold text-gray-500">
                        <a href="{{ route('category.show', $product->category->slug) }}">
                            {{ $product->category->name }}
                        </a>
                    </span>
        </div>
        <div class="mt-2">
                    <span class="text-gray-500 text-sm">
                        LKR {{ $product->price }}
                    </span>
        </div>
        <p class="text-gray-700 my-2 text-sm">
            {{ Str::limit($product->description, 60) }}
        </p>
        <div class="flex justify-center items-center mt-6">
            <a href="{{ route('product.show', $product->slug) }}"
               class="bg-green-500 text-white rounded py-2 px-5 text-sm font-semibold">
                Buy Now
            </a>
        </div>
    </div>
@endif

