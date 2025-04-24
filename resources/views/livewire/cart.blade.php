<div>
    <div x-data="{ openCart: false }" class="relative">
        <!-- Toggle Button -->
        <button id="myCartDropdownButton1" type="button" @click="openCart = !openCart"
            class="inline-flex items-center justify-center p-2 bg-white rounded-full text-sm font-medium leading-none text-[#ec5793] transition-transform duration-300 ease-in-out transform focus:ring-2 focus:ring-[#5f9e9d] focus:outline-none">
            <span class="sr-only">Cart</span>
            <img class="w-6" src="{{ asset('media/icons/cart.png') }}" alt="Cart">
        </button>
        <script>
            window.addEventListener('toast:remove', event => {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: event.detail.icon || 'success',
                    title: event.detail.message || 'Item removed!',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
        <!-- Dropdown Panel -->
        <div id="myCartDropdown1"  x-show="openCart" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="absolute right-0 mt-2 z-10 w-72 overflow-hidden rounded-lg bg-white p-4 shadow-lg antialiased">
            <livewire:cart-items />
        </div>
    </div>
</div>

