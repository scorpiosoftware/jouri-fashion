<?php

namespace App\Livewire;

use Livewire\Component;

class CartItems extends Component
{
    protected $listeners = ['refreshCart' =>'$refresh'];

    public function removeItem($id){
        $cart = session()->get('cart');

        if (isset($cart[$id])) {

            unset($cart[$id]);
            session()->put('cart', $cart);
            $this->dispatch('refreshCart');
                $success = session('lang') == 'en' ? 'Product Removed!' : 'تمت ازالة المنتج من السلة!';
            $this->dispatch('toast:remove', [
                'message' => $success,
                'icon' => 'success'
            ]);
        }
        session()->flash('success-remove', 'Product removed successfully');
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.cart-items');
    }
}
