<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bayar extends Controller
{

    public function index()
    {
        $title = "Bayar";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages-user.bayar', compact('title', 'data'));
    }

    public function pay(Request $request){
        $title = "Pay";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return redirect('pages-user.bayar', compact('title', 'data'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $title = "Checkout";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages-user.bayar', compact('title', 'data'));
    }
}
