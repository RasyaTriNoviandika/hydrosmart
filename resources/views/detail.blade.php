<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian - Hydro Smart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">
    <!-- Header -->
    <nav class="bg-slate-800/50 backdrop-blur-lg border-b border-slate-700">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('index') }}" class="flex items-center space-x-2 text-slate-300 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Kembali</span>
                </a>
                <h1 class="text-xl font-bold text-white">Detail Pembelian</h1>
                <div class="w-20"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto">
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl p-8 border-2 border-slate-700 shadow-2xl">
                <!-- Product Display -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-40 bg-gradient-to-br from-cyan-400/20 to-blue-500/20 rounded-2xl mb-6">
                        <svg class="w-20 h-20 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-2">{{ $product->volume }} ml</h2>
                    <p class="text-slate-300 text-lg mb-6">{{ $product->name }}</p>
                    <div class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl px-8 py-3">
                        <p class="text-white font-bold text-2xl">{{ $product->formatted_price }}</p>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <form action="{{ route('purchase', $product->id) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-white font-semibold mb-4 text-lg">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="QRIS" class="peer sr-only" required>
                                <div class="bg-slate-700/50 border-2 border-slate-600 rounded-xl p-4 text-center transition-all peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 hover:border-slate-500">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-slate-600 rounded-lg flex items-center justify-center peer-checked:bg-cyan-500/20">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white font-semibold">QRIS</p>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="Cash" class="peer sr-only">
                                <div class="bg-slate-700/50 border-2 border-slate-600 rounded-xl p-4 text-center transition-all peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 hover:border-slate-500">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-slate-600 rounded-lg flex items-center justify-center peer-checked:bg-cyan-500/20">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white font-semibold">Cash</p>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="E-Wallet" class="peer sr-only">
                                <div class="bg-slate-700/50 border-2 border-slate-600 rounded-xl p-4 text-center transition-all peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 hover:border-slate-500">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-slate-600 rounded-lg flex items-center justify-center peer-checked:bg-cyan-500/20">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white font-semibold">E-Wallet</p>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="Transfer" class="peer sr-only">
                                <div class="bg-slate-700/50 border-2 border-slate-600 rounded-xl p-4 text-center transition-all peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 hover:border-slate-500">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-slate-600 rounded-lg flex items-center justify-center peer-checked:bg-cyan-500/20">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white font-semibold">Transfer</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    @error('payment_method')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Product Info -->
                    <div class="bg-slate-700/30 rounded-xl p-4 border border-slate-600">
                        <div class="flex justify-between items-<div class="flex justify-between items-center mb-2">
                            <span class="text-slate-400">Volume</span>
                            <span class="text-white font-semibold">{{ $product->volume }} ml</span>
                        </div>
                        <div class="h-px bg-slate-600 my-2"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Harga</span>
                            <span class="text-white font-bold text-lg">{{ $product->formatted_price }}</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-cyan-500/50 transform hover:scale-[1.02]">
                        Lanjutkan Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-800/50 backdrop-blur-lg border-t border-slate-700 mt-12">
        <div class="container mx-auto px-6 py-6 text-center text-slate-400">
            <p>&copy; {{ date('Y') }} Hydro Smart | SMKN 9 KOTA BEKASI.</p>
        </div>
    </footer>
</body>
</html>