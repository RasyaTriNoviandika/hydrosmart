<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HydroSmartController extends Controller
{
    public function showQR() {
    $qrCode = base64_encode(QrCode::format('svg')->size(300)->generate($qrData));
    return view ('qr', compact('qr'));
}
    /**
     * Tampilan halaman utama - Pilih Volume Air
     */
    public function index()
    {
        $products = Product::active()->orderBy('volume', 'asc')->get();
        return view('index', compact('products'));
    }

    /**
     * Halaman detail pembelian
     */
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('detail', compact('product'));
    }

    /**
     * Proses pembelian dan generate QR Code
     */
    public function purchase(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:QRIS,Cash,E-Wallet,Transfer'
        ]);

        $product = Product::findOrFail($id);

        // Buat transaksi baru
        $transaction = Transaction::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(), // Jika ada sistem login
            'volume' => $product->volume,
            'amount' => $product->price,
            'payment_method' => $request->payment_method,
            'status' => 'Pending'
        ]);

        // Generate QR Code jika metode QRIS
        if ($request->payment_method == 'QRIS') {
            $qrData = json_encode([
                'transaction_code' => $transaction->transaction_code,
                'amount' => $transaction->amount,
                'merchant' => 'Hydro Smart'
            ]);
            
            $qrCode = base64_encode(QrCode::format('png')->size(300)->generate($qrData));
            $transaction->update(['qr_code' => $qrCode]);
        }

        return redirect()->route('payment', $transaction->id);
    }

    /**
     * Halaman pembayaran dengan QR Code
     */
    public function payment($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);
        return view('payment', compact('transaction'));
    }

    /**
     * Konfirmasi pembayaran
     */
    public function confirmPayment($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $transaction->update([
            'status' => 'Success',
            'paid_at' => now()
        ]);

        return redirect()->route('success', $transaction->id);
    }

    /**
     * Halaman sukses pembayaran
     */
    public function success($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);
        return view('success', compact('transaction'));
    }

    /**
     * Halaman riwayat transaksi dengan FILTER & SEARCH
     */
    public function history(Request $request)
    {
        $query = Transaction::with('product')->orderBy('created_at', 'desc');

        // Filter berdasarkan search (transaction_code)
        if ($request->filled('search')) {
            $query->where('transaction_code', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan payment_method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $transactions = $query->paginate(10);
        
        return view('history', compact('transactions'));
    }

    /**
     * API untuk cek status transaksi (untuk auto-refresh)
     */
    public function checkStatus($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json([
            'status' => $transaction->status,
            'paid_at' => $transaction->paid_at
        ]);
    }
}