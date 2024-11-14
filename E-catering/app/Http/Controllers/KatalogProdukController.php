<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Favorit;
use App\Models\customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KatalogProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Produk";
        $total_makanan =  Product::where('jenis', 'Makanan')->count();
        $total_minuman =  Product::where('jenis', 'Minuman')->count();
        $customer = customer::withCount('product')
            ->orderByDesc('created_at')
            ->get();
        $produk =  Product::with(['product_galleries'])
            ->leftJoin('product_galleries', 'product.id', '=', 'product_galleries.product_id')
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->get();
        return view('pages-user.produk', compact('title', 'produk', 'total_makanan', 'total_minuman', 'customer'));
    }

    public function filter_produk(Request $request)
    {
        $title = "Produk";
        $jenisMakanan = $request->jenis_makanan;
        $namacustomer = $request->nama_customer;
        $hargaMin = $request->harga_min;
        $hargaMax = $request->harga_max;

        $total_makanan =  Product::where('jenis', 'Makanan')->count();
        $total_minuman =  Product::where('jenis', 'Minuman')->count();
        $customer = customer::withCount('product')
            ->orderByDesc('created_at')
            ->get();

        $query = Product::with(['product_galleries'])
            ->leftJoin('product_galleries', 'product.id', '=', 'product_galleries.product_id')
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'));


        if ($jenisMakanan) {
            $query->whereIn('jenis', $jenisMakanan);
        }

        if ($namacustomer) {
            $query->whereIn('customer_id', $namacustomer);
        }

        if ($hargaMin && $hargaMax) {
            $query->whereBetween('price', [$hargaMin, $hargaMax]);
        } elseif ($hargaMin) {
            $query->where('price', '>=', $hargaMin);
        } elseif ($hargaMax) {
            $query->where('price', '<=', $hargaMax);
        }

        $produk = $query->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->get(['product.*', DB::raw('AVG(rating.rating) as nilai')]);

        if (count($produk) != 0) {
            return view('pages-user.produk', compact('title', 'produk', 'total_makanan', 'total_minuman', 'customer'));
        } else {
            return redirect('katalog_produk')->with('warning', 'Data produk Tidak Ditemukan');
        }
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
        $title = "Produk";
        $produk =  Product::with(['product_galleries'])
            ->leftJoin('product_galleries', 'product.id', '=', 'product_galleries.product_id')
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->where('nama', 'like', '%' . $request->search . '%')
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->get();
        $total_makanan =  Product::where('jenis', 'Makanan')->count();
        $total_minuman =  Product::where('jenis', 'Minuman')->count();
        $customer = customer::withCount('product')
            ->orderByDesc('created_at')
            ->get();

        if (count($produk) != 0) {
            return view('pages-user.produk', compact('title', 'produk', 'total_makanan', 'total_minuman', 'customer'));
        } else {
            return redirect('katalog_produk')->with('warning', 'Data produk Tidak Ditemukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detail Produk";
        if (Auth::user()) {
            $favorit = Favorit::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        } else {
            $favorit = null;
        }
        $produk =  Product::with(['product_galleries', 'customer'])
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->find($id);
        $ratings = DetailTransaksi::where('product_id', $id)
            ->whereHas('ratings', function ($query) {
                $query->where('review', '!=', null);
            })->get();

        return view('pages-user.detail_produk', compact('title', 'produk', 'ratings', 'favorit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
