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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk (contoh: "Air Mineral 300ml")
            $table->integer('volume'); // Volume dalam ml
            $table->decimal('price', 10, 2); // Harga
            $table->string('image')->nullable(); // Gambar produk
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->text('description')->nullable(); // Deskripsi produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};