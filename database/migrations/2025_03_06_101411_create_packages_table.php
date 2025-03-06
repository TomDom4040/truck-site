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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Убрали ->unsigned()
            $table->integer('posts_count')->unsigned();
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};