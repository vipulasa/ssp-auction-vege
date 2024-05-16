<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div x-data="{
        show : true
    }">
        <template x-if="show">
            <h1 id="ela">
                Hello
            </h1>
        </template>
    </div>

    {{ $app_name }}

    @livewire('counter')

    <div class="grid grid-cols-6 md:grid-cols-5 lg:grid-cols-6 gap-4 mx-10 mt-10">
        @foreach($products as $product)
            <x-product :product="$product"/>
        @endforeach
    </div>

</x-app-layout>
