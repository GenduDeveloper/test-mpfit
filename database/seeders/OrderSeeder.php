<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            'customer_name'       => 'Иван',
            'customer_surname'    => 'Иванов',
            'customer_patronymic' => 'Иванович',
            'created_at'          => Carbon::now(),
            'comment'             => 'test',
            'product_id'          => Product::query()->inRandomOrder()->first()->id,
            'product_quantity'    => rand(1, 5),
            'total_price'         => 99.99 // Просто число для примера
        ]);
    }
}
