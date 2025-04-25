<div class="">
    <div class="w-full mx-auto bg-slate-100 mt-2  text-black">
        <div class="md:flex grid grid-cols-1 justify-center p-3 items-center md:space-x-4">
            <div class="">
                <label class="inline-block text-sm text-gray-600" for="Multiselect">{{ session('lang') == 'en' ? 'sorting' : 'ترتيب' }}</label>
                <select wire:model='sort' class="w-80 text-nowrap" name="sorting" id="sorting">
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
                <script>
                    new TomSelect('#sorting', {
                        maxItems: 1,
                        highlight : true,
                        hideSelected : true,
                        plugins: ['remove_button','drag_drop','checkbox_options']
                    });
                </script>
            </div>
            <div class="">
                <div class="w-full">
                    <label class="inline-block text-sm text-gray-600" for="Multiselect">{{session('lang') == 'en' ? 'categories' : 'الاصناف'}}</label>
                    <div class="relative min-w-60">
                        <select id="categories" name="roles[]" multiple placeholder="" autocomplete="off"
                            class="block  rounded-sm cursor-pointer " multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ session('lang') == 'en' ? $category->name_en : $category->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <script>
                    new TomSelect('#categories', {
                        maxItems: 100,
                        highlight : true,
                        hideSelected : true,
                        plugins: ['remove_button','drag_drop']
                    });
                </script>
            </div>

            <div>
                <div class="w-full">
                    <label class="inline-block text-start w-full text-sm text-gray-600" for="Multiselect">{{ session('lang') == 'en' ? 'Price IQD' : 'السعر د.ع' }}</label>
                    <div class="flex space-x-2 md:justify-between justify-start items-center">
                        <input type="number" step="any" min="0" class="w-24 h-[2.2rem] rounded-sm border-gray-300" name="min_price" placeholder=""
                             />
                        <input type="number" step="any" min="0" class="w-24 h-[2.2rem] rounded-sm border-gray-300" name="max_price" placeholder=""
                             />
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>
