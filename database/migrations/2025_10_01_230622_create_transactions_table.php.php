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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique(); // Kode transaksi unik
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('volume'); // Volume yang dibeli
            $table->decimal('amount', 10, 2); // Total harga
            $table->enum('payment_method', ['QRIS', 'Cash', 'E-Wallet', 'Transfer']); // Metode pembayaran
            $table->enum('status', ['Pending', 'Success', 'Failed', 'Cancelled'])->default('Pending'); // Status transaksi
            $table->text('qr_code')->nullable(); // QR Code untuk pembayaran
            $table->timestamp('paid_at')->nullable(); // Waktu pembayaran
            $table->timestamps();
            
            // Index untuk performa
            $table->index('transaction_code');
            $table->index('status');
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