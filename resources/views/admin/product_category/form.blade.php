<x-app-layout>

    <div class="my-10 mx-auto max-w-2xl">
        @livewire('ProductCategoryForm')
    </div>



    OLD COMPONENT
    |
    |
    |
    |
    \/
    <form action="{{  route('product-category.store') }}" method="post">
        @csrf

        <div>
            <label for="name" value="{{ __('Name') }}" />
            <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
        </div>

        <div>
            <label for="slug" value="{{ __('Slug') }}" />
            <input id="slug" class="block mt-1 w-full"
            type="text" name="slug" :value="old('slug')" required
                autofocus autocomplete="slug" />
        </div>


        <button type="submit">
            Save
        </button>
    </form>
</x-app-layout>
