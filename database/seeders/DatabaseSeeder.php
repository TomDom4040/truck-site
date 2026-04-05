<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Listing::create([
            'title' => 'iPhone 14 Pro',
            'description' => 'Brand new iPhone 14 Pro, 128GB, Space Black',
            'price' => 999.99
        ]);

        Listing::create([
            'title' => 'Tesla Model 3 for Rent',
            'description' => 'Tesla Model 3 available for rent in LA.',
            'price' => 150.00
        ]);
    }
}
