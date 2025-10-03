<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Hydro Smart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .success-checkmark {
            animation: scaleIn 0.5s ease-out;
        }
        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">
    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12 min-h-screen flex items-center justify-center">
        <div class="max-w-lg w-full">
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl p-8 border-2 border-slate-700 shadow-2xl text-center">
                <!-- Success Icon -->
                <div class="mb-6">
                    <div class="success-checkmark w-24 h-24 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full mx-auto flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Success Message -->
                <h2 class="text-3xl font-bold text-white mb-3">Pembayaran Berhasil!</h2>
                <p class="text-slate-300 mb-8">Terima kasih telah menggunakan Hydro Smart</p>

                <!-- Transaction Details -->
                <div class="bg-slate-700/30 rounded-xl p-6 mb-6 border border-slate-600">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 text-sm">Kode Transaksi</span>
                            <span class="font-mono text-cyan-400 font-semibold">{{ $transaction->transaction_code }}</span>
                        </div>
                        <div class="h-px bg-slate-600"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 text-sm">Volume</span>
                            <span class="text-white font-semibold">{{ $transaction->volume }} ml</span>
                        </div>
                        <div class="h-px bg-slate-600"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 text-sm">Metode Pembayaran</span>
                            <span class="text-white font-semibold">{{ $transaction->payment_method }}</span>
                        </div>
                        <div class="h-px bg-slate-600"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 text-sm">Total Pembayaran</span>
                            <span class="text-white font-bold text-lg">{{ $transaction->formatted_amount }}</span>
                        </div>
                        <div class="h-px bg-slate-600"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 text-sm">Waktu</span>
                            <span class="text-white">{{ $transaction->paid_at ? $transaction->paid_at->format('d M Y, H:i') : $transaction->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Instruction -->
                <div class="bg-cyan-500/10 border border-cyan-500/30 rounded-xl p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="text-cyan-400 font-semibold text-sm mb-1">Instruksi Pengambilan</p>
                            <p class="text-slate-300 text-sm">Air Anda sedang diproses. Silakan ambil air pada dispenser dalam 5 menit.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="{{ route('index') }}" class="block w-full bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-cyan-500/50">
                        Pesan Lagi
                    </a>
                    
                    <a href="{{ route('history') }}" class="block w-full bg-slate-700 hover:bg-slate-600 text-white font-semibold py-4 rounded-xl transition">
                        Lihat Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>