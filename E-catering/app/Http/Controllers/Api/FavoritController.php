<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorit;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FavoritResource;
use Illuminate\Support\Facades\Validator;

class FavoritController extends Controller
{
    public function index(){
        $favorit = Favorit::join('users', 'users.id', '=', 'favorit.user_id')
        ->join('product', 'product.id', '=', 'favorit.product_id')
        ->select('favorit.*', 'users.id as user', 'product.nama as product')
        ->get();

        return new FavoritResource(true, 'Favorite', $favorit);
    }
    public function show($id){
        $favorit = Favorit::join('users', 'favorit.user_id', '=', 'users.id')
        ->join('product', 'favorit.product_id', '=', 'product.id')
        ->select('favorit.*', 'users.id as user', 'product.nama as product')
        ->where('favorit.id', $id)
        ->get();
        return new FavoritResource(true, 'Detail Favorite', $favorit);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        $favorit = Favorit::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        return new FavoritResource(true, 'Berhasil Menambah Favorit', $favorit);
    }
    public function destroy($id){
        $favorit = Favorit::whereId($id)->first();
        $favorit->delete();
        return new FavoritResource(true, 'Berhasil Menghapus Favorit', $favorit);
    }
}
