<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            ['imagen' => 'img/product-1.jpg', 'nombre' => 'Producto 1', 'descripcion' => 'Descripción del Producto 1', 'precio' => 100, 'precio_oferta' => null],
            ['imagen' => 'img/product-2.jpg', 'nombre' => 'Producto 2', 'descripcion' => 'Descripción del Producto 2', 'precio' => 150, 'precio_oferta' => 120],
            ['imagen' => 'img/product-3.jpg', 'nombre' => 'Producto 3', 'descripcion' => 'Descripción del Producto 3', 'precio' => 80, 'precio_oferta' => 70],
            ['imagen' => 'img/product-4.jpg', 'nombre' => 'Producto 4', 'descripcion' => 'Descripción del Producto 4', 'precio' => 100, 'precio_oferta' => null],
            ['imagen' => 'img/product-5.jpg', 'nombre' => 'Producto 5', 'descripcion' => 'Descripción del Producto 5', 'precio' => 150, 'precio_oferta' => 120],
            ['imagen' => 'img/product-6.jpg', 'nombre' => 'Producto 6', 'descripcion' => 'Descripción del Producto 6', 'precio' => 80, 'precio_oferta' => 70],
            ['imagen' => 'img/product-7.jpg', 'nombre' => 'Producto 7', 'descripcion' => 'Descripción del Producto 7', 'precio' => 100, 'precio_oferta' => null],
            ['imagen' => 'img/product-8.jpg', 'nombre' => 'Producto 8', 'descripcion' => 'Descripción del Producto 8', 'precio' => 150, 'precio_oferta' => 120]
            // Agrega más productos si es necesario
        ];

        // Insertar los productos en la base de datos
        foreach ($productos as $producto) {
            DB::table('productos')->insert([
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'imagen' => $producto['imagen'],
                'precio' => $producto['precio'],
                'precio_oferta' => $producto['precio_oferta'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
