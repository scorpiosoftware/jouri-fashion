<div class="product-grid w-[350px]  max-w-[350px] group [perspective:1000px] mx-auto flex-shrink-0 transition-all duration-500"
    data-animation="animate__backInUp" data-min-delay='300' data-delay="1500">

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <!-- SweetAlert Event Listeners -->
    <script>
        window.addEventListener('toast:added', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: event.detail.icon || 'success',
                title: event.detail.message || 'Item added to cart!',
                showConfirmButton: false,
                timer: 3000
            });
        });

        window.addEventListener('toast:wishlistAdd', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: event.detail.icon || 'success',
                title: event.detail.message || 'Item added to wishlist!',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>

    <div
        class="product-image w-[350px] h-[350px] relative [transform-style:preserve-3d] transition-transform duration-500 group-hover:[transform:rotateY(180deg)]">
        <!-- Front of card -->
        <div class="absolute inset-0 w-full h-full [backface-visibility:hidden]">
            <a name="{{ $item->id }}" href="{{ route('shop.show', $item->id) }}" class="image block w-full h-full">
                <div class="box-border w-[350px] h-[350px] overflow-hidden flex items-center justify-center">
                    <img src="{{ URL::to('storage/' . $item->main_image_url) }}"
                        class="max-w-full max-h-full p-3 object-contain bg-white" alt="{{ $item->name }}">
                </div>
            </a>
        </div>

        <!-- Back of card -->
        <div
            class="absolute inset-0 flex items-center justify-center [backface-visibility:hidden] [transform:rotateY(180deg)]">
            <div class="w-[200px] h-[300px]">
                <div
                    class="product-content flex flex-col items-center justify-between bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-4 h-full border border-gray-100">
                    <!-- Product Name -->
                    <a href="#"
                        class="line-clamp-2 text-center text-base font-semibold text-gray-800 hover:text-indigo-600 transition-colors duration-200">
                        @if (session('lang') == 'en')
                            {{ $item->name_en }}
                        @else
                            {{ $item->name_ar }}
                        @endif
                    </a>

                    <!-- Pricing -->
                    <div class="flex flex-col items-center gap-2 mt-2">
                        <!-- Original Price -->
                        <span
                            class="@if (!empty($item->offer_price)) line-through text-red-600 @else text-indigo-600 @endif text-sm font-bold">
                            {{ session('lang') == 'en' ? 'IQD' : 'د.ع' }} {{ $item->price }}
                        </span>

                        <!-- Offer Price -->
                        @if (!empty($item->offer_price))
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-xl shadow-sm">
                                {{ session('lang') == 'en' ? 'IQD' : 'د.ع' }} {{ $item->offer_price }}
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 mx-auto w-full justify-items-center gap-2 justify-center mt-2">
                        <!-- Quick View Button -->
                        <button wire:click="$dispatch('openQuickView', { productId: {{ $item->id }} })"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-400 text-white text-xs font-semibold rounded-lg shadow-md hover:from-blue-600 hover:to-blue-500 hover:scale-105 transition-all duration-300 py-1.5">
                            👁️ {{ session('lang') == 'en' ? 'Quick View' : 'نظرة سريعة' }}
                        </button>

                        <!-- Add to Cart -->
                        <button id="p-item-{{ $item->id }}" wire:click="addToCart({{ $item->id }})"
                            class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-xs font-semibold rounded-lg shadow-md hover:from-indigo-700 hover:to-indigo-600 hover:scale-105 transition-all duration-300 py-1.5">
                            🛒 {{ session('lang') == 'en' ? 'Add to Cart' : 'أضف إلى السلة' }}
                        </button>

                        <!-- Add to Fav -->
                        <button id="whishlist-{{ $item->id }}" wire:click="addToWishlist"
                            class="w-full bg-gradient-to-r from-pink-500 to-pink-400 text-white text-xs font-semibold rounded-lg shadow-md hover:from-pink-600 hover:to-pink-500 hover:scale-105 transition-all duration-300 py-1.5">
                            ❤️ {{ session('lang') == 'en' ? 'Add to Favorites' : 'أضف إلى المفضلة' }}
                        </button>

                        <!-- View Item -->
                        <button
                            class="w-full border border-gray-300 text-gray-700 text-xs font-semibold rounded-lg shadow-sm hover:bg-gray-50 hover:scale-105 transition-all duration-300 py-1.5">
                            <a href="{{ route('shop.show', $item->id) }}">🔍
                                {{ session('lang') == 'en' ? 'View Details' : 'عرض التفاصيل' }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
