<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            if (!Schema::hasColumn('ads', 'tg')) {
                $table->boolean('tg')->default(false); // Размещение на Тг
            }
    
            if (!Schema::hasColumn('ads', 'fb')) {
                $table->boolean('fb')->default(false); // Размещение на Фб
            }
    
            if (!Schema::hasColumn('ads', 'package')) {
                $table->integer('package')->default(1); // Для пакета объявлений
            }
    
            if (!Schema::hasColumn('ads', 'price')) {
                $table->decimal('price', 10, 2)->default(0); // Стоимость
            }
        });
    }
    
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn(['tg', 'fb', 'package', 'price']);
        });
    }
};
