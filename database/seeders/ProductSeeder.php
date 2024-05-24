<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void{

        $product= new Product();
        $product->name="cama";
        $product->description="De plaza y media";
        $product->price="500";
        $product->image="1716471116.jpg";
        $product->save();

        $product1= new Product();
        $product1->name="lampara";
        $product1->description="De 2 años de duración";
        $product1->price="60";
        $product1->image="1716471337.jpg";
        $product1->save();
    }
        
}
