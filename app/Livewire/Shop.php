<?php

namespace App\Livewire;

use Livewire\Component;

class Shop extends Component
{
    public $sort;
    public $category;
    public $categories;
    public function render()
    {
        return view('livewire.shop');
    }
}
