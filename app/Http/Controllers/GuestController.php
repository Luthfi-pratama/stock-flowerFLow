<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\produk;
use Illuminate\Support\Facades\Auth; 

class GuestController extends Controller
{
    //
    function home(){
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $total = $cartItems->sum('quantity');
        } else {
            $cartItems = collect([]); 
            $total = 0;
        }
        
        return view('guest.home', compact('cartItems', 'total'));
    }

    function about(){
        return view('guest.aboutUs');
    }

    function shop(){
        $produk = produk::paginate(9);
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $total = $cartItems->sum('quantity');
        } else {
            $cartItems = collect([]);
            $total = 0;
        }

        return view('guest.shop.index', compact('cartItems', 'total', 'produk'));
    }
}
