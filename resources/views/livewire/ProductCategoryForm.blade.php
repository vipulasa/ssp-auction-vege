<?php

use function Livewire\Volt\{state, mount};

state([
    'name' => null,
    'slug' => null,
]);

$store = function () {

    (new \App\Models\ProductCategory())->create([
        'name' => $this->name,
        'slug' => $this->slug,
    ]);

    // redirect to index page
    return redirect()->route('product-category.index');
};

mount(function(){

});

?>

<div x-data="{
    name: @entangle('name'),
    slug: @entangle('slug'),
    init() {
        this.$watch('name', value => {
            this.slug = value.toLowerCase().replace(/ /g, '-');
        });
    }
}">
    <span x-html="name"></span>
    <span x-html="slug"></span>
    <form wire:submit.prevent="store">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-4">
                    <x-label for="name" value="{{ __('Name') }}"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" x-model="name" required
                             autofocus autocomplete="name"/>
                </div>

                <div class="col-span-4">
                    <x-label for="slug" value="{{ __('Slug') }}"/>
                    <x-input id="slug" class="block mt-1 w-full"
                             type="text" name="slug" wire:model.live="slug" required
                             autofocus autocomplete="slug"/>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" wire:loading.attr="disabled" wire:target="photo">
                Save
            </button>
        </div>
    </form>

</div>
