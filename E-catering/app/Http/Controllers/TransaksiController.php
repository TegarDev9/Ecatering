<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manajemen Transaksi';
        if (Auth::user()->role == 'customer') {
            $diproses = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Diproses')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $dikirim = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Dikirim')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $diterima = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Diterima')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
        } else {
            $diproses = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->where('transaksi.status', 'Diproses')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $dikirim = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->where('transaksi.status', 'Dikirim')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $diterima = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->select('transaksi.*', 'profile.nama')
                ->where('transaksi.status', 'Diterima')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
        }
        return view('pages-customer.transaksi.index', compact('title', 'diproses', 'dikirim', 'diterima'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $data = Transaksi::find($id);
        return view('pages-customer.transaksi.transaksi-detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order =  Transaksi::find($id);
        if ($order->status == 'Diproses') {
            $order->status = 'Dikirim';
            $order->update();
            return redirect('transaksi')->with('success', 'Produk Telah Dikirim');
        } else {
            $order->status = 'Diterima';
            $order->update();
            return redirect('transaksi')->with('success', 'Produk Telah Diterima');
        }
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

    public function pdf()
    {

        if (Auth::user()->role == 'customer') {
            $diproses = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Diproses')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $dikirim = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Dikirim')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $diterima = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->whereHas('detail_transaksi.product', function ($query) {
                    $query->where('customer_id', Auth::user()->customer->id);
                })
                ->where('transaksi.status', 'Diterima')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
        } else {
            $diproses = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->where('transaksi.status', 'Diproses')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $dikirim = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->where('transaksi.status', 'Dikirim')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
            $diterima = Transaksi::with('detail_transaksi.product')
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->join('profile', 'users.id', '=', 'profile.user_id')
                ->where('transaksi.status', 'Diterima')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();
        }
        $pdf = PDF::loadView('pages-customer.transaksi.transaksi_pdf', compact('diproses', 'dikirim', 'diterima'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
