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
            $table->unsignedBigInteger('city_id')->nullable()->after('category_id'); // Добавляем колонку city_id
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null'); // Связываем с таблицей cities
        });
    }
    
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['city_id']); // Убираем внешний ключ
            $table->dropColumn('city_id'); // Удаляем колонку
        });
    }
};
