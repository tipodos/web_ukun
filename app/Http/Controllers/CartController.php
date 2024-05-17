<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $producto = Product::find($request->id);

        Cart::add(
            $producto->id,
            $producto->name,
            1,
            $producto->price,
            ["image" => $producto->image]

        );

        return redirect()->back()->with("success", "Producto agregado " . $producto->name);
    }
    public function actualizarCantidad(Request $request)
    {
        $rowId = $request->input('rowId');
        $cantidad = $request->input('qty');

        // Actualizar la cantidad del producto en el carrito
        Cart::update($rowId, $cantidad);

        // Recalcular los valores del carrito después de la actualización
        $subTotal = Cart::subtotal();
        $impuestos = Cart::tax();
        $total = Cart::total();

        // Aquí podrías retornar una vista con los valores actualizados, o redirigir a una ruta específica
        return response()->json([
            'subTotal' => $subTotal,
            'impuestos' => $impuestos,
            'total' => $total
        ]);
    }
    public function cart()
    {
        return view('cart.cart');
    }
    public function remover(Request $request)
    {

        Cart::remove($request->rowId);
        return redirect()->back()->with("success", "Producto eliminado");
    }
}
