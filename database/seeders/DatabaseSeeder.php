<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        // Clear existing data (optional)
        Transaction::truncate();
        Product::truncate();

        // 1. Seed Products
        $this->seedProducts();

        // 2. Seed Transactions (data dummy untuk testing)
        $this->seedTransactions();

        $this->command->info('✅ Database seeding completed!');
    }

    /**
     * Seed Products
     */
    private function seedProducts()
    {
        $products = [
            [
                'name' => 'Air Mineral 300ml',
                'volume' => 300,
                'price' => 1000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 300ml - Perfect untuk sekali minum'
            ],
            [
                'name' => 'Air Mineral 500ml',
                'volume' => 500,
                'price' => 1500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 500ml - Standar botol air mineral'
            ],
            [
                'name' => 'Air Mineral 800ml',
                'volume' => 800,
                'price' => 2000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 800ml - Untuk aktivitas ringan'
            ],
            [
                'name' => 'Air Mineral 1000ml',
                'volume' => 1000,
                'price' => 2500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1000ml - 1 Liter penuh'
            ],
            [
                'name' => 'Air Mineral 1500ml',
                'volume' => 1500,
                'price' => 3000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1500ml - 1.5 Liter untuk olahraga'
            ],
            [
                'name' => 'Air Mineral 1800ml',
                'volume' => 1800,
                'price' => 3500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1800ml - 1.8 Liter jumbo'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('✅ Products seeded: ' . count($products) . ' items');
    }

    /**
     * Seed Transactions (Data Dummy untuk Testing)
     */
    private function seedTransactions()
    {
        $products = Product::all();
        $statuses = ['Success', 'Pending', 'Failed'];
        $paymentMethods = ['QRIS', 'Cash', 'E-Wallet', 'Transfer'];

        // Buat 30 transaksi dummy
        for ($i = 1; $i <= 30; $i++) {
            $product = $products->random();
            $status = $statuses[array_rand($statuses)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            Transaction::create([
                'transaction_code' => 'TRX-' . strtoupper(Str::random(10)),
                'product_id' => $product->id,
                'user_id' => null, // Set null jika tidak ada sistem login
                'volume' => $product->volume,
                'amount' => $product->price,
                'payment_method' => $paymentMethod,
                'status' => $status,
                'qr_code' => $paymentMethod === 'QRIS' ? $this->generateDummyQR() : null,
                'paid_at' => $status === 'Success' ? now()->subDays(rand(0, 30)) : null,
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        $this->command->info('✅ Transactions seeded: 30 items');
    }

    /**
     * Generate dummy QR code (base64)
     */
    private function generateDummyQR()
    {
        // Ini dummy QR code kecil dalam base64
        // Di production, akan di-generate oleh library QR Code
        return 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
    }
}