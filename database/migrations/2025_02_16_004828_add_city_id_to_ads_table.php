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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('city_id');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('package');
            $table->boolean('tg')->nullable()->change();
            $table->boolean('fb')->nullable()->default(false); // Обновлено: nullable и default false
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    
    
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
