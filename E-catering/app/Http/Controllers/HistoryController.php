<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "diproses";
        $history = Transaksi::where('transaksi.user_id', Auth::user()->id)->where('payment_status', '!=', 'waiting')->where('payment_status', '!=', 'pending')->where('status', 'Diproses')->orderBy('transaksi.created_at', 'desc')->get();

        // dd($history->detail_transaksi[0]);
        return view('pages-user.history', compact('title', 'history'));
    }

    public function dikirim()
    {
        $title = "dikirim";
        $history = Transaksi::where('transaksi.user_id', Auth::user()->id)->where('payment_status', '!=', 'waiting')->where('payment_status', '!=', 'pending')->where('status', 'Dikirim')->orderBy('transaksi.created_at', 'desc')->get();

        // dd($history->detail_transaksi[0]);
        return view('pages-user.history', compact('title', 'history'));
    }

    public function diterima()
    {
        $title = "diterima";
        $history = Transaksi::where('transaksi.user_id', Auth::user()->id)->where('payment_status', '!=', 'waiting')->where('payment_status', '!=', 'pending')->where('status', 'Diterima')->orderBy('transaksi.created_at', 'desc')->get();

        // dd($history->detail_transaksi[0]);
        return view('pages-user.history', compact('title', 'history'));
    }


    public function belum_dibayar()
    {
        $title = "Belum Dibayar";
        $history = Transaksi::where('transaksi.user_id', Auth::user()->id)->whereRaw('payment_status = "waiting"  OR payment_status ="pending"')->orderBy('transaksi.created_at', 'desc')->get();

        // dd($history->detail_transaksi[0]);
        return view('pages-user.history', compact('title', 'history'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "History";
        $detail = Transaksi::find($id);

        // dd($history->detail_transaksi[0]);
        return view('pages-user.history-detail', compact('title', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order =  Transaksi::find($id);
        $order->status = 'Diterima';
        $order->update();
        return redirect('history/diterima')->with('success', 'Produk Telah Diterima');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
