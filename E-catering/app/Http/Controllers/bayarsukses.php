<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class bayarsukses extends Controller
{
    public function index()
    {
        $title = "Bayar Sukses";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages-user.bayarsukses', compact('title', 'data'));
    }
}
