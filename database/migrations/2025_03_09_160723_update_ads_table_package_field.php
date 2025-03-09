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
        // Изменяем поле package на NULLABLE
        $table->unsignedBigInteger('package')->nullable()->change();

        // Добавляем внешний ключ
        $table->foreign('package')
              ->references('id')
              ->on('packages')
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('ads', function (Blueprint $table) {
        // Удаляем внешний ключ
        $table->dropForeign(['package']);

        // Возвращаем поле package в исходное состояние (NOT NULL)
        $table->unsignedBigInteger('package')->nullable(false)->change();
    });
}
};
