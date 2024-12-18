<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\transaction;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class TransactionController extends Controller
{
    //

    public function placeOrder(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            \Log::warning('User cart is empty.');
            return redirect()->route('user.cart.index')->with('error', 'Your cart is empty');
        }

        try {
            DB::beginTransaction();

            $transactions = collect();

            foreach ($cartItems as $cartItem) {
                $transaction = Transaction::create([
                    'user_id' => Auth::id(),
                    'produks_id' => $cartItem->produks_id,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $cartItem->quantity * $cartItem->product->harga
                ]);

                // Explicitly load the product relation
                $transaction->load('product');
                $transactions->push($transaction);
            }

            // Clear cart after successful transaction
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            \Log::info('Order placed successfully for user ID: ' . Auth::id());
            
            // Double-check that products are loaded
            $transactions = Transaction::with('product')
                ->whereIn('id', $transactions->pluck('id'))
                ->get();

            // Debug log to verify data
            \Log::info('Transactions data:', $transactions->toArray());

            $pdf = PDF::loadView('authenticatedUser.transactions.invoice', [
                'transactions' => $transactions
            ]);
            
            return $pdf->download('transaction_invoice.pdf');  
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during checkout or placing order: ' . $e->getMessage());
            return redirect()->route('user.cart.index')->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }



    public function index()
    {
        $transactions = transaction::where('user_id', Auth::id())
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum('quantity');
        $total_spend = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->harga;
        });
        
        return view('authenticatedUser.transactions.index', compact('total_spend', 'cartItems', 'total'));
    }

    public function show(transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('authenticatedUser.transactions.show', compact('transaction'));
    }
}
