<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Category;
class CityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       // Добавляем города с ценой
    City::create(['name' => 'Москва', 'price' => 100]);
    City::create(['name' => 'Санкт-Петербург', 'price' => 150]);
    City::create(['name' => 'Екатеринбург', 'price' => 120]);
    City::create(['name' => 'Новосибирск', 'price' => 110]);
    City::create(['name' => 'Казань', 'price' => 130]);
        
        // Добавляем категории
        Category::create(['name' => 'Косметика']);
        Category::create(['name' => 'Электроника']);
        Category::create(['name' => 'Одежда']);
        Category::create(['name' => 'Автозапчасти']);
        Category::create(['name' => 'Недвижимость']);
    }
}
