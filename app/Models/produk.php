<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama_bunga', 'rating', 'harga', 'image_path', 'deskripsi'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'produks_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
}
