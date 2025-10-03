<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Hydro Smart</title>
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
                <h1 class="text-xl font-bold text-white">Riwayat Transaksi</h1>
                <div class="w-20"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            
            <!-- Filter & Search Bar -->
            <div class="mb-6 bg-slate-800/50 backdrop-blur-lg rounded-xl p-4 border-2 border-slate-700">
                <form method="GET" action="{{ route('history') }}" class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari kode transaksi..." 
                                   class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 pl-10 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <select name="status" 
                                class="bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="">Semua Status</option>
                            <option value="Success" {{ request('status') == 'Success' ? 'selected' : '' }}>Berhasil</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Failed" {{ request('status') == 'Failed' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>

                    <!-- Filter Payment Method -->
                    <div>
                        <select name="payment_method" 
                                class="bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="">Semua Metode</option>
                            <option value="QRIS" {{ request('payment_method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Cash" {{ request('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="E-Wallet" {{ request('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="Transfer" {{ request('payment_method') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>

                    <!-- Button Group -->
                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded-lg transition">
                            Filter
                        </button>
                        <a href="{{ route('history') }}" class="px-6 py-2 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-lg transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            @if($transactions->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden md:block bg-slate-800/50 backdrop-blur-lg rounded-2xl border-2 border-slate-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Waktu</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Kode Transaksi</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Volume</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Harga</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Metode</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            @foreach($transactions as $transaction)
                            <tr class="hover:bg-slate-700/30 transition">
                                <td class="px-6 py-4 text-sm text-slate-300">
                                    {{ $transaction->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm text-cyan-400">{{ $transaction->transaction_code }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-white font-semibold">
                                    {{ $transaction->volume }} ml
                                </td>
                                <td class="px-6 py-4 text-sm text-white font-semibold">
                                    {{ $transaction->formatted_amount }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-700 text-slate-300">
                                        {{ $transaction->payment_method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($transaction->status == 'Success')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400 border border-green-500/50">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Berhasil
                                        </span>
                                    @elseif($transaction->status == 'Pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400 border border-yellow-500/50">
                                            <svg class="w-3 h-3 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Menunggu
                                        </span>
                                    @elseif($transaction->status == 'Failed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/50">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Gagal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-700 text-slate-400">
                                            {{ $transaction->status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @foreach($transactions as $transaction)
                <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-5 border-2 border-slate-700">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="text-slate-400 text-xs mb-1">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                            <p class="font-mono text-sm text-cyan-400">{{ $transaction->transaction_code }}</p>
                        </div>
                        @if($transaction->status == 'Success')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                Berhasil
                            </span>
                        @elseif($transaction->status == 'Pending')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">
                                Menunggu
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                Gagal
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-white font-bold text-lg">{{ $transaction->volume }} ml</p>
                            <p class="text-slate-400 text-sm">{{ $transaction->payment_method }}</p>
                        </div>
                        <p class="text-white font-bold text-xl">{{ $transaction->formatted_amount }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl p-12 border-2 border-slate-700 text-center">
                <svg class="w-20 h-20 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-white font-bold text-xl mb-2">Belum Ada Transaksi</h3>
                <p class="text-slate-400 mb-6">Mulai pesan air Hydro Smart sekarang!</p>
                <a href="{{ route('index') }}" class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold px-6 py-3 rounded-xl transition">
                    Pesan Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>