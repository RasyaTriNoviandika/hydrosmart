<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydro Smart - Pilih Volume Air</title>
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
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Hydro Smart</h1>
                </div>
                <a href="{{ route('history') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Riwayat</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-5xl mx-auto">
            <!-- Title Section -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-3">Pilih Volume Air</h2>
                <p class="text-slate-300 text-lg">Pilih ukuran yang sesuai dengan kebutuhan Anda</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <a href="{{ route('detail', $product->id) }}" class="group">
                    <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl p-6 border-2 border-slate-700 hover:border-cyan-500 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/20 hover:-translate-y-1">
                        <!-- Icon/Image -->
                        <div class="mb-4 flex justify-center">
                            <div class="w-20 h-24 bg-gradient-to-br from-cyan-400/20 to-blue-500/20 rounded-lg flex items-center justify-center group-hover:from-cyan-400/30 group-hover:to-blue-500/30 transition-all">
                                <svg class="w-12 h-12 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Volume -->
                        <div class="text-center mb-3">
                            <h3 class="text-2xl font-bold text-white mb-1">{{ $product->volume }} ml</h3>
                            <p class="text-slate-400 text-sm">{{ $product->name }}</p>
                        </div>

                        <!-- Price -->
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg px-4 py-2 text-center">
                            <p class="text-white font-bold text-lg">{{ $product->formatted_price }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            @if($products->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-slate-400 text-lg">Belum ada produk tersedia</p>
            </div>
            @endif
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