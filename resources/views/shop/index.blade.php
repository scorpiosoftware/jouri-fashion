@extends('layouts.home')
@section('content')
    <div class="md:max-w-4xl mx-auto pt-4">
        <livewire:breadcrumb :links="[
            [
                'path' => '/',
                'name_en' => 'Home',
                'name_ar' => 'الصفحة الرئيسية',
            ],
            [
                'path' => '/shop',
                'name_en' => 'Catalog',
                'name_ar' => 'المنتجات',
            ],
        ]">

            @livewire('shop', [
                'categories' => \App\Models\Category::all(),
                'minPrice' => $inputs['min_price'] ?? null,
                'maxPrice' => $inputs['max_price'] ?? null,
            ])

    </div>

    {{-- <nav aria-label="Page navigation example" class="p-4 w-1/4 mx-auto">
        {{ $products->links() }}
    </nav> --}}
@endsection
