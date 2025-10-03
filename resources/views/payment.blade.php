<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Hydro Smart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .qr-code-dots {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">
    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3"></div>

    <!-- Header -->
    <nav class="bg-slate-800/50 backdrop-blur-lg border-b border-slate-700">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-center">
                <h1 class="text-xl font-bold text-white">Pembayaran</h1>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-lg mx-auto">
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl p-8 border-2 border-slate-700 shadow-2xl">
                
                <!-- Timer Countdown -->
                <div id="timer-container" class="bg-gradient-to-r from-red-500/20 to-orange-500/20 border border-red-500/50 rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-red-400 font-semibold text-sm">Batas Waktu Pembayaran</p>
                                <p class="text-slate-300 text-xs">Selesaikan dalam waktu yang ditentukan</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p id="countdown-timer" class="text-2xl font-bold text-white"></p>
                            <p class="text-slate-400 text-xs">menit</p>
                        </div>
                    </div>
                </div>

                <!-- Transaction Info -->
                <div class="text-center mb-6">
                    <div class="inline-block bg-slate-700/50 rounded-xl px-4 py-2 mb-4">
                        <p class="text-slate-400 text-sm">Kode Transaksi</p>
                        <p class="text-white font-mono font-bold">{{ $transaction->transaction_code }}</p>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $transaction->volume }} ml</h2>
                    <p class="text-slate-300">{{ $transaction->product->name }}</p>
                </div>

                <!-- QR Code Display (if QRIS) -->
                @if($transaction->payment_method == 'QRIS' && $transaction->qr_code)
                <div class="bg-white rounded-2xl p-6 mb-6">
                    <div class="text-center mb-4">
                        <p class="text-slate-900 font-semibold text-lg mb-2">Scan QR Code</p>
                        <p class="text-slate-600 text-sm">Gunakan aplikasi pembayaran Anda</p>
                    </div>
                    <div class="flex justify-center">
                        <img src="data:image/png;base64,{{ $transaction->qr_code }}" alt="QR Code" class="w-64 h-64 qr-code-dots">
                    </div>
                </div>
                @else
                <!-- Non-QRIS Payment Info -->
                <div class="bg-slate-700/50 rounded-xl p-6 mb-6 text-center">
                    <svg class="w-16 h-16 text-cyan-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-white font-bold text-xl mb-2">Pembayaran {{ $transaction->payment_method }}</h3>
                    <p class="text-slate-300 mb-4">Silakan lakukan pembayaran sesuai metode yang dipilih</p>
                </div>
                @endif

                <!-- Amount -->
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl p-6 mb-6 text-center">
                    <p class="text-white/80 text-sm mb-1">Total Pembayaran</p>
                    <p class="text-white font-bold text-3xl">{{ $transaction->formatted_amount }}</p>
                </div>

                <!-- Payment Instructions -->
                <div class="bg-slate-700/30 rounded-xl p-4 mb-6 border border-slate-600">
                    <p class="text-slate-300 text-sm mb-2">
                        <span class="inline-block w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>
                        Pastikan nominal pembayaran sudah sesuai
                    </p>
                    <p class="text-slate-300 text-sm mb-2">
                        <span class="inline-block w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>
                        Jangan tutup halaman ini sampai pembayaran selesai
                    </p>
                    <p class="text-slate-300 text-sm">
                        <span class="inline-block w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>
                        Transaksi akan otomatis terverifikasi
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <form action="{{ route('confirm', $transaction->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-green-500/50">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                    
                    <a href="{{ route('index') }}" class="block w-full bg-slate-700 hover:bg-slate-600 text-white font-semibold py-4 rounded-xl transition text-center">
                        Batal
                    </a>
                </div>

                <!-- Status Check -->
                <div class="mt-6 text-center">
                    <div class="inline-flex items-center space-x-2 text-slate-400 text-sm">
                        <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                        <span id="status-text">Menunggu pembayaran...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Notification System
        class NotificationSystem {
            constructor() {
                this.container = document.getElementById('notification-container');
            }

            show(message, type = 'info') {
                const colors = {
                    success: 'bg-green-500',
                    error: 'bg-red-500',
                    warning: 'bg-yellow-500',
                    info: 'bg-cyan-500'
                };

                const notification = document.createElement('div');
                notification.className = `${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-300 translate-x-full opacity-0`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <p class="font-medium">${message}</p>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 hover:bg-white/20 rounded p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `;

                this.container.appendChild(notification);
                setTimeout(() => {
                    notification.classList.remove('translate-x-full', 'opacity-0');
                }, 100);

                setTimeout(() => {
                    notification.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            }
        }

        const notify = new NotificationSystem();

        // Timer Countdown (5 menit = 300 detik)
        let timeLeft = 300;
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('countdown-timer').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            // Warning saat 1 menit tersisa
            if (timeLeft === 60) {
                notify.show('⚠️ Sisa waktu pembayaran 1 menit!', 'warning');
                document.getElementById('timer-container').classList.add('animate-pulse');
            }
            
            if (timeLeft <= 0) {
                notify.show('⏰ Waktu pembayaran habis!', 'error');
                setTimeout(() => {
                    window.location.href = '{{ route("index") }}';
                }, 2000);
            }
            
            timeLeft--;
        }
        
        updateTimer();
        setInterval(updateTimer, 1000);

        // Auto-check payment status every 3 seconds
        let checkCount = 0;
        const statusInterval = setInterval(function() {
            checkCount++;
            
            fetch('{{ route("check-status", $transaction->id) }}')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        clearInterval(statusInterval);
                        notify.show('✅ Pembayaran berhasil! Mengalihkan...', 'success');
                        document.getElementById('status-text').textContent = 'Pembayaran berhasil!';
                        setTimeout(() => {
                            window.location.href = '{{ route("success", $transaction->id) }}';
                        }, 1500);
                    } else if (data.status === 'Failed') {
                        clearInterval(statusInterval);
                        notify.show('❌ Pembayaran gagal!', 'error');
                        document.getElementById('status-text').textContent = 'Pembayaran gagal!';
                    }
                })
                .catch(error => {
                    console.error('Error checking status:', error);
                });

            // Notifikasi setiap 30 detik
            if (checkCount % 10 === 0) {
                notify.show('🔄 Memeriksa status pembayaran...', 'info');
            }
        }, 3000);

        // Show initial notification
setTimeout(() => {
    @if($transaction->payment_method == 'QRIS')
        notify.show('📱 Silakan scan QR Code untuk melakukan pembayaran', 'info');
    @else
        notify.show('💳 Silakan lakukan pembayaran sesuai metode yang dipilih', 'info');
    @endif
}, 1000);
    </script>
</body>
</html>