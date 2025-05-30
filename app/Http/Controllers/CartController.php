<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $request->visit();
        $categories = Category::all();
        $cart = session()->get('cart');
        $totale = 0;
        $carousel = Carousel::with('images')->first();
        if ($cart) {
            foreach (session('cart') as $id => $details) {
                $totale += $details['price'];
            }
        }

        // return 
        return view('cart.index', compact('categories', 'totale', 'carousel'));
    }
    public function decrementToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {

            abort(404);
        }

        $cart = session()->get('cart');
        $price = $product->price;
        if (!empty($product->offer_price) || $product->offer_price > 0) {
            $price = $product->offer_price;
        }
        $p_name = session('lang') == 'en' ? $product->name_en : $product->name_ar;
        if (!$cart) {

            $cart = [
                $id => [
                    "name" => $p_name,
                    "quantity" => 1,
                    "price" => $price,
                    "photo" => $product->main_image_url
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success-decrement', 'Product added to cart successfully!');
        }

        if (isset($cart[$id])) {


            if ($cart[$id]['quantity'] == 1) {
                $cart[$id]['quantity'] = 1;
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            } else {
                $cart[$id]['quantity']--;
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            }


            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$id] = [
            "name" => $p_name,
            "quantity" => 1,
            "price" => $price,
            "photo" => $product->main_image_url
        ];

        session()->put('cart', $cart);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Product added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function addToCart($id, Request $request)
    {
        $inputs = $request->all();
        $product = Product::find($id);
        $color = !empty($inputs['color']) ? Color::find($inputs['color']) : $product->colors->first();
        $size = !empty($inputs['size']) ? Size::find($inputs['size']) : $product->sizes->first();
        if (!$product) {

            abort(404);
        }
        $cart = session()->get('cart');
        $price = $product->price;

        if (!empty($product->offer_price) || $product->offer_price > 0) {
            $price = $product->offer_price;
        }
        $p_name = session('lang') == 'en' ? $product->name_en : $product->name_ar;
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $p_name,
                    "quantity" => 0,
                    "price" => $price,
                    "color" => $color,
                    "size" => $size,
                    "photo" => $product->main_image_url
                ]
            ];
            if (!empty($inputs['qty'])) {
                $cart[$id]['quantity'] = $inputs['qty'];
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            } else {
                $cart[$id]['quantity']++;
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            }
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
            // return redirect(url()->previous().'#'.$product->id);
        }

        if (isset($cart[$id])) {

            if (!empty($inputs['qty'])) {
                $cart[$id]['quantity'] = $inputs['qty'];
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            } else {
                $cart[$id]['quantity']++;
                $cart[$id]['price'] = $cart[$id]['quantity'] * $price;
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$id] = [
            "name" => $p_name,
            "quantity" => 1,
            "price" => $price,
            "color" => $color,
            "size" => $size,
            "photo" => $product->main_image_url
        ];

        session()->put('cart', $cart);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Product added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
        // return redirect(url()->previous().'#'.$product->id);
    }
    public function removeCartItem($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        session()->flash('success-remove', 'Product removed successfully');
        return redirect()->back();
    }
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
}
