<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function addToCart(Request $request){
        $producto=Producto::find($request->id);

        Cart::add(
            $producto->id,
            $producto->name,
            1,
            $producto->price,
            ["image"=>$producto->image]

        );

        return redirect()->back()->with("success","Producto agregado ".$producto->name);
    }
    public function cart(){
        return view('cart.cart');
    }

}

