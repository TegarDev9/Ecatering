<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pesanan Produk";
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages-user.cart', compact('title', 'pesanan'));
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
        $pesanan = Pesanan::where('product_id', $request->id)->first();

        if ($pesanan == null) {
            $data  = Pesanan::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
                'quantity' => $request->quantity
            ]);
        } else {
            $pesanan->quantity =  $pesanan->quantity + $request->quantity;
            $pesanan->update();
        }

        return redirect('pesanan')->with('success', 'Pesanan Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = Pesanan::where('product_id', $id)->first();

        if ($pesanan == null) {
            $data  = Pesanan::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'quantity' => 1
            ]);
        } else {
            $pesanan->quantity =  $pesanan->quantity + 1;
            $pesanan->update();
        }

        return redirect('pesanan')->with('success', 'Pesanan Berhasil Di Tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $action = $request->action;

        // Ambil data pesanan dari database berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);

        // Periksa tindakan (increase atau decrease)
        if ($action == 'increase') {
            $pesanan->quantity += 1;
        } elseif ($action == 'decrease' && $pesanan->quantity > 1) {
            $pesanan->quantity -= 1;
        }
        // hitung sub total
        $sub_total =  $pesanan->quantity * $pesanan->product->price;

        // Simpan perubahan
        $pesanan->save();

        $total_all = Pesanan::join('product', 'pesanan.product_id', '=', 'product.id')
            ->sum(DB::raw('pesanan.quantity * product.price'));

        // Kirim response JSON
        return response()->json([
            'quantity' => $pesanan->quantity,
            'total_all' => $total_all,
            'sub_total' => $sub_total
        ]);
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
        $data  = Pesanan::find($id);
        $data->delete();
        return back()->with('success', 'Pesanan Berhasil Di Tambahkan');
    }
}
