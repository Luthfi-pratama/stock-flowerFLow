<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;

class ProdukController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->search??null;
        $length = $request->length??10;

        $produks = produk::when($search, function ($query) use ($search) {
            $query->where('nama_bunga', 'like', "%$search%");
        })->paginate($length);

        return view('admin.produk.index', compact('produks', 'search', 'length'));
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
            'rating' => 3,
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Flower product created successfully');
    }

    public function edit($id)
    {
        $produk = produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($produk->image_path) {
                \Storage::disk('public')->delete($produk->image_path);
            }

            $imagePath = $request->file('image')->store('flowers', 'public');
            $produk->image_path = $imagePath;
        }

        $produk->update([
            'nama_bunga' => $validated['nama_bunga'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'] ?? $produk->deskripsi, 
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Flower product updated successfully.');
    }


    public function destroy($id)
    {
        $produk = produk::findOrFail($id);

        if ($produk->image_path) {
            Storage::disk('public')->delete($produk->image_path);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Flower product deleted successfully');
    }
}
