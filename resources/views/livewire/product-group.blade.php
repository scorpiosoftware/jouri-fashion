<div x-data="{ show: true }" class="md:mx-auto w-full md:max-w-4xl">
    <div @click="show = !show"
        class="font-bold cursor-pointer text-2xl text-center mb-4 border bg-slate-100 text-gray-800">{{ $title }}
    </div>
    <div x-show="show" x-transition.duration.300ms class="grid md:grid-cols-3 grid-cols-1  md:gap-y-4 bg-slate-100">
        @foreach ($products as $item)
            <livewire:product :item="$item">
        @endforeach
    </div>
</div>
