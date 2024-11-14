<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Galleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PDF;
use App\Exports\ProductExport;
use App\Models\customer;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Produk";
        if (Auth::user()->role == 'customer') {
            $data = Product::where('customer_id', Auth::user()->customer->id)->orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return view('pages-customer.produk.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Data Produk';
        $customer = customer::orderBy('created_at', 'desc')->get();
        return view('pages-customer.produk.create', compact('title', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);


        if (Auth::user()->role == 'customer') {
            $customer_id = Auth::user()->customer->id;
        } else {
            $customer_id = $request->customer_id;
        }

        $id = mt_rand(1000, 99999);
        $data = Product::create([
            'id' => $id,
            'nama' => $request->nama,
            'jenis' =>  $request->jenis,
            'price' => $request->price,
            'stok' => $request->stok,
            'deskripsi_barang' => $request->deskripsi_barang,
            'customer_id' => $customer_id
        ]);

        if ($request->hasFile('foto')) {
            $example = $request->file('foto');
            foreach ($example as $fileExample) {
                $extension = $fileExample->getClientOriginalExtension();
                $rand = Str::random(5);
                $rand1 = Str::random(3);
                $fileExampleName = $rand . "-" . date('Ymd-his') . "-" . $rand1 . "." . $extension;
                $destinationPath = 'assets/produk' . '/';
                $fileExample->move($destinationPath, $fileExampleName);

                Product_Galleries::create([
                    'product_id' =>  $id,
                    'foto' =>  $fileExampleName,
                ]);
            }
        }

        if ($data) {
            return redirect('produk')->with('success', 'Data Produk Berhasil Di Tambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data Produk';
        $data = Product::find($id);
        $customer = customer::orderBy('created_at', 'desc')->get();
        $product_gallery = Product_Galleries::where('product_id', $id)->orderBy('created_at', 'desc')->get();
        return view('pages-customer.produk.update', compact('title', 'data', 'product_gallery', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = Product::find($id);
        $data->nama = $request->nama;
        $data->jenis = $request->jenis;
        $data->price = $request->price;
        $data->stok =  $data->stok + $request->tambah_stok - $request->kurang_stok;
        $data->deskripsi_barang = $request->deskripsi_barang;

        if (Auth::user()->role == 'merchant') {
            $customer_id = $request->customer_id;
        }

        if ($request->hasFile('foto')) {
            $example = $request->file('foto');
            foreach ($example as $fileExample) {
                $extension = $fileExample->getClientOriginalExtension();
                $rand = Str::random(5);
                $rand1 = Str::random(3);
                $fileExampleName = $rand . "-" . date('Ymd-his') . "-" . $rand1 . "." . $extension;
                $destinationPath = 'assets/produk' . '/';
                $fileExample->move($destinationPath, $fileExampleName);

                Product_Galleries::create([
                    'product_id' =>  $id,
                    'foto' =>  $fileExampleName,
                ]);
            }
        }
        $data->update();

        if ($data) {
            return redirect('produk')->with('success', 'Data Produk Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Product::find($id);
        $galleries = Product_Galleries::where('product_id', $id)->get();
        foreach ($galleries as $gallery) {
            $location = 'assets/produk/' . $gallery->foto;
            if (File::exists($location)) {
                File::delete($location);
            }
        }
        $data->delete();

        if ($data) {
            return redirect('produk')->with('success', 'Data Produk Berhasil Dihapus');
        }
    }



    public function hapus_gallery($id)
    {
        $id = explode('-', $id);
        $data = Product_Galleries::find($id[0]);
        $location_example = 'assets/produk/' . $data->foto;
        if (File::exists($location_example)) {
            File::delete($location_example);
        }
        $data->delete();
        return redirect()->route('produk-edit', $id[1]);
    }


    public function halaman_awal()
    {
        $title = "Dashboard";
        $produk = Product::withCount('detail_transaksi')
            ->with(['product_galleries'])
            ->orderByDesc('detail_transaksi_count')
            ->take(4)
            ->get();
        $rekomendasi =  Product::with(['product_galleries'])
            ->leftJoin('product_galleries', 'product.id', '=', 'product_galleries.product_id')
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->take(8)
            ->get();

        return view('pages-user.dashboard', compact('title', 'produk', 'rekomendasi'));
    }

    public function pdf()
    {
        $data = Product::where('customer_id', Auth::user()->customer->id)->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('pages-customer.produk.product_pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function excel()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }
}
