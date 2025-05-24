<div x-data="{ visible: @entangle('show') }" x-init="$watch('visible', value => {
    if (value) Livewire.dispatch('swiperUpdated', true);
})">
    <div x-show="visible" 
        x-transition:enter="transition-all ease-out duration-700"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition-all ease-in duration-500"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="swiper-container fixed top-0 z-50 w-full bg-[#1a1a1a] max-w-full min-h-screen content-center"
        wire:ignore style="display: none;">
        
        <!-- Professional overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#1a1a1a]/95 via-[#1a1a1a]/90 to-[#1a1a1a]/95 backdrop-blur-[2px]"></div>
        
        <div class="relative z-10">
            <div class="flex justify-end w-full p-4">
                <button wire:click="close" 
                    class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-full backdrop-blur-sm transition-all duration-300 transform hover:scale-105 flex items-center gap-2 group">
                    <span class="text-sm font-medium">{{ session('lang') == 'en' ? 'Close' : 'اغلاق' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <div class="relative group">
                            <img src="{{ URL::to('storage/' . $image->image_url) }}" 
                                class="w-full h-auto object-contain transform transition-transform duration-500 group-hover:scale-105"
                                alt="Product image">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next !text-white/80 hover:!text-white transition-colors duration-300"></div>
            <div class="swiper-button-prev !text-white/80 hover:!text-white transition-colors duration-300"></div>

            <!-- Pagination -->
            <div class="swiper-pagination !bottom-8"></div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <style>
        .swiper-slide img {
            max-height: 70vh;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .swiper-button-next,
        .swiper-button-prev {
            background: rgba(255, 255, 255, 0.1);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px !important;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5) !important;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: white !important;
            opacity: 1;
            transform: scale(1.2);
        }

        /* Disable selection globally for swiper elements */
        .swiper-container * {
            user-select: none !important;
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
        }

        /* Prevent blue highlight on mobile */
        .swiper-button-next,
        .swiper-button-prev,
        .close-button {
            -webkit-tap-highlight-color: transparent;
        }

        @media (max-width: 768px) {
            .swiper-button-next,
            .swiper-button-prev {
                width: 40px !important;
                height: 40px !important;
            }
            
            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 16px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            let swiperInstance = null;

            Livewire.on('swiperUpdated', (show) => {
                if (show) {
                    if (swiperInstance) {
                        swiperInstance.destroy();
                    }

                    setTimeout(() => {
                        swiperInstance = new Swiper('.swiper-container', {
                            loop: true,
                            effect: 'fade',
                            fadeEffect: {
                                crossFade: true
                            },
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            keyboard: {
                                enabled: true,
                            },
                            mousewheel: {
                                sensitivity: 1,
                            },
                        });
                    }, 100);
                }
            });
        });
    </script>
@endpush
