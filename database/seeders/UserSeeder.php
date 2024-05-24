<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=new User();
        $user->name="admin";
        $user->email="admin@gmail.com";
        $user->activo="1";
        $user->password="$2y$12$/5AIZRFzn76acuwEiBAW8.ikpz/1DpVCBOQc395nJZBnkuLkNbEku";
        $user->save();

        $user1=new User();
        $user1->name="cliente";
        $user1->email="user@gmail.com";
        $user1->activo="0";
        $user1->password="$2y$12\$ww8qLzjKNA/hmwTv2lELV.FAa//dFqIotK67w4wz8Do75GIuETBdS";
        $user1->save();
    }
}
