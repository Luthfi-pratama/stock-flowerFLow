<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\produk;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Fetch dashboard statistics
        $totalUsers = User::count();
        $totalProducts = Produk::count();
        
        $recentUsers = User::latest()->take(5)->get(['name', 'created_at']);
        $recentProducts = produk::latest()->take(5)->get(['nama_bunga', 'created_at']);

        $recentActivities = $recentUsers->map(function ($user) {
            return (object)[
                'description' => "New user registered: {$user->name}",
                'created_at' => $user->created_at
            ];
        })->merge(
            $recentProducts->map(function ($product) {
                return (object)[
                    'description' => "Flower added: {$product->nama_bunga}",
                    'created_at' => $product->created_at
                ];
            })
        )->sortByDesc('created_at')->take(10);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'recentActivities' => $recentActivities
        ]);
    }
}
