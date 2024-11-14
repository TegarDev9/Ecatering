<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $rating = Transaksi::find($request->id);

        foreach ($rating->detail_transaksi as $data) {
            $nilai = 'rating_' . $data->id;
            $review = 'review_' . $data->id;

            Ratings::create([
                'rating' => $request->$nilai,
                'review' => $request->$review,
                'detail_transaksi_id' => $data->id
            ]);
        }
        return redirect('history/diterima')->with('success','Review Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "History";
        $rating = Transaksi::find($id);

        // dd($history->detail_transaksi[0]);
        return view('pages-user.rating', compact('title', 'rating'));
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
