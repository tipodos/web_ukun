<?php

namespace Database\Seeders;

use App\Models\ImgProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Producto;

class ImgProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imgProducto =new ImgProducto();

        $imgProducto -> producto_id="2";
        $imgProducto -> img = "img/product-1.jpg";

        $imgProducto->save();

        $imgProducto1 =new ImgProducto();

        $imgProducto1 -> producto_id="2";
        $imgProducto1 -> img = "img/product-1.jpg";

        $imgProducto1->save();

        $imgProducto2 =new ImgProducto();

        $imgProducto2 -> producto_id="2";
        $imgProducto2 -> img = "img/product-1.jpg";

        $imgProducto2->save();
    }
}
