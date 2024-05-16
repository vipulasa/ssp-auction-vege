<?php

use function Livewire\Volt\{state, mount};

state([
    'category' => null,
    'name' => null,
    'slug' => null,
]);

mount(function(){
    $this->name = $this->category->name;
    $this->slug = $this->category->slug;
});

$save = function(){

    // validate
    $this->validate([
        'name' => 'required',
        'slug' => 'required',
    ]);

    $this->category->update([
        'name' => $this->name,
        'slug' => $this->slug,
    ]);

    session()->flash('message', 'Category updated successfully.');

    return redirect()->route('product-category.index');
};

?>

<div x-data="{
     name : @entangle('name'),
     slug : @entangle('slug'),
     init() {
         this.$watch('name', value => {
             this.slug = value.toLowerCase().replace(/ /g, '-');
         });
     }
}">

    <form wire:submit.prevent="save">
        <div>
            <label for="name" value="{{ __('Name') }}" />
            <input id="name" class="block mt-1 w-full"
                   type="text" name="name" x-model="name"
                autofocus autocomplete="name" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="slug" value="{{ __('Slug') }}" />
            <input id="slug" class="block mt-1 w-full"
            type="text" name="slug" x-model="slug"
                autofocus autocomplete="slug" />
            @error('slug') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Save
        </button>
    </form>


<h1>Hello !!!!</h1>
</div>
