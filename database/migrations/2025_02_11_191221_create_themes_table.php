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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Название темы
            $table->decimal('price', 8, 2);  // Цена для темы
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('themes');
    }
};
