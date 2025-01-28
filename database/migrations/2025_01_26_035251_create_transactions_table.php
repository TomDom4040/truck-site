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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с пользователем
            $table->foreignId('ad_id')->constrained()->onDelete('cascade'); // Связь с объявлением
            $table->decimal('amount', 10, 2); // Сумма транзакции
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Статус транзакции
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
