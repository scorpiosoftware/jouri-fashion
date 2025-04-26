<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use function Livewire\on;

class Shop extends Component
{
    public $sort;
    public $category = [];

    public $minPrice;
    public $maxPrice;

    public $categories;
    public $products;
    public function mount()
    {
        // $this->dispatch('apply');
        $this->listProducts();
    }
    #[On('apply')]
    public function listProducts()
    {
        $this->products = new Product();
        if (!empty($this->category)) {
            $this->products = $this->products->whereHas('categories', function ($subQuery) {
                $subQuery->whereIn('categories.id', $this->category);
            });
        }

        if (!empty($this->sort)) {
            switch ($this->sort) {
                case 'asc':
                    $this->products = $this->products->orderBy('name_en', 'asc');
                    break;
                case 'desc':
                    $this->products = $this->products->orderBy('name_en', 'desc');
                    break;
                case 'low_price':
                    $this->products = $this->products->orderBy('price', 'asc');
                    break;
                case 'high_price':
                    $this->products = $this->products->orderBy('price', 'desc');
                    break;
            }
        }

        if (!empty($this->minPrice) && !empty($this->maxPrice)) {
            $this->products = $this->products->whereRaw("
            CASE 
                WHEN offer_price IS NOT NULL THEN offer_price 
                ELSE price 
            END BETWEEN ? AND ?
        ", [$this->minPrice, $this->maxPrice]);
        }

        $this->products = $this->products->get();
    }


    public function render()
    {
        return view('livewire.shop');
    }
}
