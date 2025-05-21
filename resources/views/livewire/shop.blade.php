<div class="">
    <div class="w-full mx-auto bg-slate-100 mt-2  text-black" wire:ignore>
        <div class="md:flex grid grid-cols-1 justify-center p-3 items-center md:space-x-4">
            <div class="">
                <label class="inline-block text-sm text-gray-600"
                    for="Multiselect">{{ session('lang') == 'en' ? 'sorting' : 'ترتيب' }}</label>
                <select wire:model='sort' wire:change="dispatch('apply')" class="w-80 text-nowrap" id="sorting">
                    <option value="asc">{{ session('lang') == 'en' ? 'Ascending' : 'تصاعدي' }}</option>
                    <option value="desc">
                        {{ session('lang') == 'en' ? 'Descending' : 'تنازلي' }}</option>
                    <option value="low_price">
                        {{ session('lang') == 'en' ? 'Price - Low to high' : 'السعر من الارخص للاعلى' }}
                    </option>
                    <option value="high_price">
                        {{ session('lang') == 'en' ? 'Price - High to low' : 'السعر الاعلى الى الادنى' }}
                    </option>
                </select>
            </div>
            <div class="">
                <div class="w-full">
                    <label class="inline-block text-sm text-gray-600"
                        for="Multiselect">{{ session('lang') == 'en' ? 'categories' : 'الاصناف' }}</label>
                    <div class="relative min-w-60">
                        <select id="categories" wire:model="category" wire:change="dispatch('apply')" placeholder=""
                            autocomplete="off" class="block rounded-sm cursor-pointer">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ session('lang') == 'en' ? $category->name_en : $category->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <div class="w-full">
                    <label class="inline-block text-start w-full text-sm text-gray-600"
                        for="Multiselect">{{ session('lang') == 'en' ? 'Price IQD' : 'السعر د.ع' }}</label>
                    <div class="flex space-x-2 md:justify-between justify-start items-center">
                        <input type="number" step="any" min="0"
                            class="w-24 h-[2.2rem] rounded-sm border-gray-300" name="min_price" wire:model='minPrice'
                            wire:change="dispatch('apply')" placeholder=""/>
                        <input type="number" step="any" min="0"
                            class="w-24 h-[2.2rem] rounded-sm border-gray-300" name="max_price" wire:model='maxPrice'
                            wire:change="dispatch('apply')" placeholder="" />
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-slate-100 h-screen">
        @if ($products?->count() <= 0)
            <div class="text-center flex items-center justify-center w-full mx-auto">
                {{ session('lang') == 'en' ? 'No results found' : 'لم يتم العثور على نتائج' }} </div>
        @endif

        @isset($products)
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 50);
            $wire.on('apply', () => {
                show = false;
                setTimeout(() => show = true, 50);
            });" x-show="show"
                x-transition:enter="transition ease-out duration-1000 delay-100"
                x-transition:enter-start="opacity-0 scale-75 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="grid grid-cols-1 md:grid-cols-4 mx-auto ap-4 md:px-0 mt-2">
                @foreach ($products as $item)
                    @livewire('product', ['item' => $item], key($item->id))
                @endforeach
            </div>


        @endisset
    </div>
</div>
@script
    <script>
        new TomSelect('#categories', {
            minItems: 0,
            maxItems: 100,
            highlight: true,
            hideSelected: true,
            plugins: ['remove_button', 'drag_drop']
        });
        new TomSelect('#sorting', {
            maxItems: 1,
            highlight: true,
            hideSelected: true,
            plugins: ['remove_button', 'drag_drop', 'checkbox_options']
        });
    </script>
@endscript
