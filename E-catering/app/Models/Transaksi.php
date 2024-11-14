<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'id', 'total', 'payment_status', 'midtrans_url', 'midtrans_booking_code', 'status', 'user_id', 'tanggal', 'lokasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
