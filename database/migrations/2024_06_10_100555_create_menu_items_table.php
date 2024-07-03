<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Название пункта меню
            $table->string('url'); // URL пункта меню
            $table->boolean('is_mobile')->nullable();
            $table->integer('order')->default(0); // Порядок отображения
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade'); // Родительский пункт меню для вложенных меню
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
