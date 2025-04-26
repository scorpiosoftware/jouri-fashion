<div wire:click="addFav({{ $id }})" class="cursor-pointer transition-all duration-300">
    <div id="whishlist" data-tip="Add to Wishlist" class="">
        <i id="ico"
            class="fa fa-heart fa-2x {{ $isFavorited ? 'text-red-500' : 'text-gray-300' }}"></i>
    </div>
    <script>
        window.addEventListener('toast:added', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: event.detail.icon || 'success',
                title: event.detail.message || 'Item added wishlist!',
                showConfirmButton: false,
                timer: 3000
            });
        });
        window.addEventListener('toast:removed', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: event.detail.icon || 'success',
                title: event.detail.message || 'Item removed from wishlist!',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
</div>
