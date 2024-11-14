<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function index()
    {
        $produk =  Product::with(['product_galleries'])
            ->leftJoin('product_galleries', 'product.id', '=', 'product_galleries.product_id')
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.custumor_id', 'product.created_at', 'product.updated_at')
            ->get();
        return new ProductResource(true, 'Data Product', $produk);
    }

    public function show(string $id)
    {
        $produk =  Product::with(['product_galleries', 'customer'])
            ->leftJoin('detail_transaksi', 'product.id', '=', 'detail_transaksi.product_id')
            ->leftJoin('rating', 'detail_transaksi.id', '=', 'rating.detail_transaksi_id')
            ->select('product.*', DB::raw('AVG(rating.rating) as nilai'))
            ->orderBy('nilai', 'DESC')
            ->groupBy('product.id', 'product.nama', 'product.jenis', 'product.price', 'product.stok', 'product.deskripsi_barang', 'product.customer_id', 'product.created_at', 'product.updated_at')
            ->find($id);

        return new ProductResource(true, 'Detail Product', $produk);
    }
}
