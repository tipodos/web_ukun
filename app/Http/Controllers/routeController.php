<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ImgProducto;
USE App\Models\Product;


class routeController extends Controller
{
    public function inicio(){
        $productos=Producto::all();
        return view('inicio', compact('productos'));
    }
    public function tienda(){
        $products=Product::all();
        return view('tienda', compact('products'));
     }
    public function detalle(Request $request,$id){
        $productos=Producto::find($id);
        $imgProducto=ImgProducto::where('producto_id', $id);
        return view('detail', [
            'productos' => $productos,
            'imgProducto' => $imgProducto
        ]);
    }
    public function contacto(){
        return view('contact');
    }
    public function checkout(){
    return view('checkout');
    }


}
