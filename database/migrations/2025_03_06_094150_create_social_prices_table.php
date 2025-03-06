<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('social_prices', function (Blueprint $table) {
            $table->id();
            $table->decimal('tg_price', 8, 2);
            $table->decimal('fb_price', 8, 2);
            $table->timestamps();
        });
    
        // Добавим начальные цены для соцсетей
        DB::table('social_prices')->insert([
            'tg_price' => 0.00,
            'fb_price' => 0.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
    public function down()
    {
        Schema::dropIfExists('social_prices');
    }
};
