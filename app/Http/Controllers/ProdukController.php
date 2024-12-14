<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produks = produk::paginate(10);
        return view('admin.produk.index', compact('produks'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string',
            'harga' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'deskripsi' => 'nullable|string'
        ]);

        $imagePath = $request->file('image')->store('flowers', 'public');

        $produk = Produk::create([
            'nama_bunga' => $validated['nama_bunga'],
            'rating' => 0,
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Flower product created successfully');
    }

    public function edit(Produk $produk)
    {
        dd($produk);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request,  $id)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);
        $produk = produk::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($produk->image) {
                Storage::disk('public')->delete($produk->image);
            }
            
            $imagePath = $request->file('image')->store('flowers', 'public');
            $produk->image_path = $imagePath;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Flower product updated successfully');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Flower product deleted successfully');
    }
}
