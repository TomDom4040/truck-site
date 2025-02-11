<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Theme::create([
        'name' => 'Косметика',
        'price' => 500.00,
    ]);

    Theme::create([
        'name' => 'Электроника',
        'price' => 1500.00,
    ]);

    Theme::create([
        'name' => 'Одежда',
        'price' => 800.00,
    ]);

    Theme::create([
        'name' => 'Автозапчасти',
        'price' => 1200.00,
    ]);

    Theme::create([
        'name' => 'Недвижимость',
        'price' => 2500.00,
    ]);
}
}
