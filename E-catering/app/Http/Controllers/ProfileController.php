<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Detail Profile";
        return view('pages-user.profile', compact('title'));
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
        //
        $title = 'Edit Profile';
        $user = User::find($id);

        return view('pages-user.profile-edit', compact('user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $title = 'Edit Profile';
        $user = User::find($id);

        return view('profile.index', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = ($request->password != null) ? Hash::make($request->password) : $user->password;

        $profile = Profile::find($user->profile->id);
        $profile->nama = $request->nama;
        $profile->no_telp = $request->no_telp;
        $profile->alamat = $request->alamat;

        if ($request->hasfile('foto')) {
            $image = $request->file('foto');
            $destination = 'assets/profile/' . $profile->foto;

            if ($profile && in_array($profile->foto, ['avatar5.png', 'avatar.png', 'avatar.png'])) {
                // File tidak akan dihapus
            } else {
                // Hapus file jika nama file bukan 'avatar5.png', 'avatar.png', atau 'avatar.png'
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            
            $file_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/profile/'), $file_image);
            $profile->foto = $file_image;
        }

        if (Auth::user()->role == 'customer') {
            $customer = customer::find($user->customer->id);
            $customer->nama_toko = $request->nama;
            $customer->deskripsi_toko = $request->deskripsi_toko;
            $customer->update();
        }

        $user->update();
        $profile->update();

        return back()->with('success', 'Data Profile Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
