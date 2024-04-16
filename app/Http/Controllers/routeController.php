<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ImgProducto;

class routeController extends Controller
{
    public function inicio(){
        $productos=Producto::all();
        return view('inicio', compact('productos'));
 }
    public function tienda(){
        $productos=Producto::all();
        return view('tienda', compact('productos'));
     }
    public function detalle(Request $request, $id){
        
        $id=$request->input('id');
        $producto=Producto::find($id);
        $imgProducto=ImgProducto::where('producto_id', $id)->get();
        return view('detail', [
            'producto' => $producto,
            'imgProducto' => $imgProducto
        ]);        
 }
    public function contacto(){
        return view('contact');
}
    public function checkout(){
    return view('checkout');
}
    public function cart(){
    return view('cart');
}
}
