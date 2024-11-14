<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'id', 'nama', 'jenis', 'price', 'stok', 'deskripsi_barang', 'customer_id'
    ];

    public function product_galleries()
    {
        return $this->hasMany(Product_Galleries::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
