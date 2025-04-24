<div class="product-grid md:w-[250px] w-[350px] group [perspective:1000px]  mx-auto flex-shrink-0 transition-all duration-500 hover:scale-90 "
    data-animation="animate__backInUp" data-min-delay='300' data-delay="1500">

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <div class="product-image">
        <a name="{{ $item->id }}" href="{{ route('shop.show', $item->id) }}" class="image block">
            <div class="box-border">

                <img src="{{ URL::to('storage/' . $item->main_image_url) }}" class="w-full  p-3 object-cover">
            </div>

        </a>


        <div
            class="absolute top-0 opacity-0 transition-opacity duration-300 hover:opacity-100 w-full h-full text-center content-center">
            <div
                class="product-content flex flex-col items-center bg-white bg-opacity-25   rounded-2xl shadow-lg p-4 hover:shadow-xl transition-all duration-300 hover:scale-110">

                <!-- Product Name -->
                <a href="#"
                    class="line-clamp-3 text-center text-lg md:text-xl font-semibold text-gray-800 hover:text-indigo-600 transition-colors duration-200">
                    @if (session('lang') == 'en')
                        {{ $item->name_en }}
                    @else
                        {{ $item->name_ar }}
                    @endif
                </a>

                <!-- Pricing -->
                <div class="flex items-center gap-3 mt-4">
                    <!-- Original Price -->
                    <span
                        class="@if (!empty($item->offer_price)) line-through text-red-600 @else text-indigo-600 @endif text-base md:text-lg font-bold">
                        {{ session('lang') == 'en' ? 'IQD' : 'د.ع' }} {{ $item->price }}
                    </span>

                    <!-- Offer Price -->
                    @if (!empty($item->offer_price))
                        <span
                            class="bg-green-100 text-green-800 text-sm md:text-base font-bold px-2 py-1 rounded-xl shadow-sm">
                            {{ session('lang') == 'en' ? 'IQD' : 'د.ع' }} {{ $item->offer_price }}
                        </span>
                    @endif
                </div>
                <div class="grid grid-cols-1 mx-auto w-full justify-items-center gap-3 justify-center mt-2">
                    <!-- Add to Cart -->
                    <button id="p-item-{{ $item->id }}" wire:click="addToCart({{ $item->id }})"
                        class="w-28 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-semibold rounded-lg shadow-md hover:from-indigo-700 hover:to-indigo-600 hover:scale-105 transition-all duration-300">
                        🛒 Cart
                    </button>
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
                    </script>
                    <!-- Add to Fav -->
                    <button id="whishlist-{{ $item->id }}"
                        class="w-28 bg-pink-500 text-white text-sm font-semibold rounded-full shadow-md hover:bg-pink-600 hover:scale-105 transition-all duration-300">
                        ❤️ Fav
                    </button>
                    <script>
                        $(document).ready(function() {
                            $("#whishlist-{{ $item->id }}").click(function() {
                                $.ajax({
                                    url: "{{ route('wishlist.add', $item->id) }}",
                                    type: "GET",
                                    success: function(response) {
                                        setTimeout(function() {
                                            $("#ico-{{ $item->id }}").addClass("text-red-600");
                                            $('#toast-cart').show();
                                        }, 0);
                                    }
                                });
                            });
                        });
                    </script>
                    <!-- View Item -->
                    <button
                        class="w-28 border border-gray-400 text-gray-700 text-sm font-semibold rounded-lg shadow-sm hover:bg-gray-100 hover:scale-105 transition-all duration-300">
                        <a href="{{ route('shop.show', $item->id) }}">🔍 View</a>
                    </button>
                </div>
            </div>



            {{-- <ul class="product-links flex  space-x-2 items-center justify-center relative z-50">
                <li>
                    <a id="p-item-{{ $item->id }}" wire:click="addToCart({{ $item->id }})"
                        class="custom-toast.success-toast" data-tip="Add to Cart">
                        <img class="w-6" src="{{ asset('media/icons/cart.png') }}" alt="">
                    </a>
                </li>
                <script>
                    $("#p-item-{{ $item->id }}").click(function() {
                        $('#cart-message').show(500);
                    });
                </script>


                <li class="">
                    <a id="whishlist-{{ $item->id }}" data-tip="Add to Wishlist">
                        <i id="ico-{{ $item->id }}"
                            class="fa fa-heart 
                            @if (session('wishlist')) @foreach (session('wishlist') as $id => $details)
                                    @if ($details['name'] == $item->name_en)
                                        text-red-600
                                        @break @endif
                                @endforeach
                            @endif"></i>


                    </a>
                    <script>
                        $(document).ready(function() {
                            $("#whishlist-{{ $item->id }}").click(function() {
                                $.ajax({
                                    url: "{{ route('wishlist.add', $item->id) }}",
                                    type: "GET",
                                    success: function(response) {
                                        setTimeout(function() {
                                            $("#ico-{{ $item->id }}").addClass("text-red-600");
                                            $('#toast-cart').show();
                                        }, 0);
                                    }
                                });
                            });
                        });
                    </script>
                </li>

                <li>
                    <a href="{{ route('shop.show', $item->id) }}" data-tip="Quick View">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</div>
