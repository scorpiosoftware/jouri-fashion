<div class="product-grid group relative overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl wowDiv" 
    data-animation="animate__backInUp" 
    data-min-delay='300' 
    data-delay="1500"
    wire:key="product-{{ $item->id }}">
    
    <div class="product-image relative overflow-hidden">
        <a name="{{ $item->id }}" href="{{ route('shop.show', ['id' => $item->id, 'slug' => Str::slug($item->name_en)]) }}" class="image block">
            <div class="image-container relative overflow-hidden">
                <div class="skeleton-loader min-h-36 animate-pulse bg-gray-200"></div>
                <img src="{{ URL::to('storage/' . $item->main_image_url) }}" 
                     class="w-full max-h-60 object-cover p-3 transition-transform duration-500 group-hover:scale-110" 
                     onload="this.previousElementSibling.style.display='none'">
            </div>
        </a>

        @if (!empty($item->offer_price))
            <span class="product-hot-label absolute left-0 top-4 bg-[#ec5793] px-4 py-1 text-sm font-semibold text-white shadow-md">
                {{ session('lang') == 'en' ? 'Sale' : 'تخفيضات' }}
            </span>
        @endif

        <ul class="product-links absolute right-4 top-4 flex flex-col space-y-3 opacity-0 transition-all duration-300 group-hover:opacity-100">
            <li>
                <button wire:click="addToCart({{ $item->id }})"
                    class="custom-toast success-toast flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-lg transition-all duration-300 hover:bg-[#ec5793] hover:text-white" 
                    data-tip="Add to Cart">
                    <i class="fa fa-shopping-bag"></i>
                </button>
            </li>

            <li>
                <button wire:click="addToWishlist({{ $item->id }})"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-lg transition-all duration-300 hover:bg-[#ec5793] hover:text-white" 
                    data-tip="Add to Wishlist">
                    <i class="fa fa-heart transition-colors duration-300 
                        @if (session('wishlist')) 
                            @foreach (session('wishlist') as $id => $details)
                                @if ($details['name'] == $item->name_en)
                                    text-red-600
                                    @break 
                                @endif
                            @endforeach
                        @endif"></i>
                </button>
            </li>

         <li><a href="{{ route('shop.show', ['id' => $item->id, 'slug' => Str::slug($item->name_en)]) }}"
                    data-tip="Quick View"><i class="fa fa-search"></i></a>
            </li>
        </ul>
    </div>

    <div class="product-content flex flex-col space-y-2 p-4">
        <a href="#" class="line-clamp-2 text-center text-sm font-medium text-gray-800 transition-colors duration-300 hover:text-[#ec5793]">
            @if (session('lang') == 'en')
                {{ $item->name_en }}
            @else
                {{ $item->name_ar }}
            @endif
        </a>

        <div class="flex items-center justify-center space-x-2">
            <span class="@if (!empty($item->offer_price)) line-through text-sm text-red-500 @else text-[#ec5793] font-semibold @endif">
                {{session('lang') == 'en' ? 'IQD' : 'د.ع'}} {{ $item->price }}
            </span>
            @if (!empty($item->offer_price))
                <div class="rounded-lg bg-[#ec5793] bg-opacity-10 px-3 py-1 text-sm font-bold text-[#ec5793]">
                    {{session('lang') == 'en' ? 'IQD' : 'د.ع'}} {{ $item->offer_price }}
                </div>
            @endif
        </div>
    </div>

    <div wire:loading wire:target="addToCart" class="absolute inset-0 flex items-center justify-center bg-white/50 backdrop-blur-sm">
        <div class="h-8 w-8 animate-spin rounded-full border-4 border-[#ec5793] border-t-transparent"></div>
    </div>
</div>

<style>
[data-tip] {
    position: relative;
}

[data-tip]:before {
    content: attr(data-tip);
    position: absolute;
    right: 100%;
    top: 50%;
    transform: translateY(-50%);
    padding: 4px 8px;
    background: #333;
    color: #fff;
    font-size: 12px;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    margin-right: 10px;
}

[data-tip]:hover:before {
    opacity: 1;
    visibility: visible;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-in-out;
}
</style>
