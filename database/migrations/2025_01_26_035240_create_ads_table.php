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
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с пользователем
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Связь с категорией
        $table->string('title'); // Заголовок объявления
        $table->text('description'); // Текст объявления
        $table->string('city'); // Город
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Статус модерации
        $table->decimal('price', 10, 2); // Стоимость объявления
        $table->json('media')->nullable(); // Мультимедиа (фото/видео)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
