<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rating', 'review', 'detail_transaksi_id'
    ];

    public function detail_transaksi()
    {
        return $this->belongsTo(DetailTransaksi::class);
    }
}
