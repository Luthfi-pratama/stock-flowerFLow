<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum('quantity');
        $total_spend = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->harga;
        });
        return view('authenticatedUser.cart.index', compact('cartItems', 'total' ,'total_spend'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'produks_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = produk::findOrFail($request->produks_id);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('produks_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'produks_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('user.cart.index')->with('success', 'Product added to cart');
    }

    public function remove($cartId)
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('user.cart.index')->with('success', 'Product removed from cart');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::find($request->id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        $subTotal = $cartItem->quantity * $cartItem->product->harga;
        
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->harga;
        });
        
        return response()->json([
            'success' => true,
            'subTotal' => number_format($subTotal, 2),
            'total_spend' => number_format($total, 2)
        ]);
    }


}
