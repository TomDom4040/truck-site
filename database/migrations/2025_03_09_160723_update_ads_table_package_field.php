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
        // Временно отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('ads', function (Blueprint $table) {
            // Изменяем поле package на NULLABLE
            $table->unsignedBigInteger('package')->nullable()->change();

            // Добавляем внешний ключ
            $table->foreign('package')
                  ->references('id')
                  ->on('packages')
                  ->onDelete('set null');
        });

        // Включаем проверку внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Временно отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('ads', function (Blueprint $table) {
            // Удаляем внешний ключ
            $table->dropForeign(['package']);

            // Возвращаем поле package в исходное состояние (NOT NULL)
            $table->unsignedBigInteger('package')->nullable(false)->change();
        });

        // Включаем проверку внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};