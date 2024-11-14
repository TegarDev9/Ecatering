<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomemerchantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomecustomerController;
use App\Http\Controllers\KatalogProdukController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\bayarsukses;
use App\Http\Controllers\bayar;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [ProductController::class, 'halaman_awal'])->name('halaman_awal');

Route::get('/katalog_produk', [KatalogProdukController::class, 'index'])->name('katalog_produk');
Route::post('/filter_produk', [KatalogProdukController::class, 'filter_produk'])->name('filter_produk');
Route::post('/search_produk', [KatalogProdukController::class, 'store'])->name('search_produk');
Route::get('/detail_produk/{id}', [KatalogProdukController::class, 'show'])->name('detail_produk');

Route::get('/about_us', function () {
    $title = "About Us";
    return view('pages-user.aboutUs', compact('title'));
})->name('about_us');

Route::get('/contact_us', function () {
    $title = "Contact Us";
    return view('pages-user.contactUs', compact('title'));
})->name('contact_us');

Auth::routes();

// menu yang dapat di akses hanya user dengan role merchant
Route::group(['middleware' => ['auth', 'role:merchant']], function () {
    Route::get('/home_merchant', [HomemerchantController::class, 'index'])->name('home_merchant');

    Route::prefix('customer')->group(function () {
        Route::get('/', [customerController::class, 'index'])->name('customer');
        Route::get('/create', [customerController::class, 'create'])->name('customer-create');
        Route::get('/{id}', [customerController::class, 'show'])->name('customer-detail');
        Route::get('/{id}/edit', [customerController::class, 'edit'])->name('customer-edit');
        Route::post('/store', [customerController::class, 'store'])->name('customer-store');
        Route::put('/{id}/update', [customerController::class, 'update'])->name('customer-update');
        Route::delete('/{id}/destroy', [customerController::class, 'destroy'])->name('customer-hapus');
    });
});

// menu yang dapat di akses hanya user dengan role customer
Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/home_customer', [HomecustomerController::class, 'index'])->name('home_customer');
    Route::get('/product_pdf', [ProductController::class, 'pdf'])->name('produk-pdf');
    Route::get('/transaksi_pdf', [TransaksiController::class, 'pdf'])->name('transaksi-pdf');
    Route::get('/product_excel', [ProductController::class, 'excel'])->name('produk-excel');

    Route::prefix('produk')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('produk');
        Route::get('/create', [ProductController::class, 'create'])->name('produk-create');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('produk-edit');
        Route::post('/store', [ProductController::class, 'store'])->name('produk-store');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('produk-update');
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('produk-hapus');
        Route::get('/hapus_gallery/{id}', [ProductController::class, 'hapus_gallery'])->name('hapus_gallery');
    });


    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi-create');
        Route::get('/{id}', [TransaksiController::class, 'show'])->name('transaksi-detail');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi-edit');
        Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi-store');
        Route::put('/{id}/update', [TransaksiController::class, 'update'])->name('transaksi-update');
        Route::delete('/{id}/destroy', [TransaksiController::class, 'destroy'])->name('transaksi-hapus');
    });
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/edit_profile/{id}', [ProfileController::class, 'edit']);
    Route::put('/edit_profile/{id}/update', [ProfileController::class, 'update'])->name('profile-update');
});

// menu yang dapat di akses hanya user dengan role User
Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('favorit')->group(function () {
        Route::get('/', [FavoritController::class, 'index'])->name('favorit');
        Route::get('/{id}', [FavoritController::class, 'show'])->name('favorit-create');
        Route::delete('/{id}/destroy', [FavoritController::class, 'destroy'])->name('favorit-hapus');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/{id}', [ProfileController::class, 'show'])->name('profile-edit');
    });

    Route::prefix('pesanan')->group(function () {
        Route::get('/', [PesananController::class, 'index'])->name('pesanan');
        Route::get('/{id}', [PesananController::class, 'show'])->name('pesanan-create');
        Route::post('/store', [PesananController::class, 'store'])->name('pesanan-store');
        Route::delete('/{id}/destroy', [PesananController::class, 'destroy'])->name('pesanan-hapus');
        Route::post('/update-quantity',  [PesananController::class, 'edit'])->name('update-quantity');
    });

    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
        Route::get('/{id}', [CheckoutController::class, 'show'])->name('change-status');
        Route::post('/store', [CheckoutController::class, 'store'])->name('checkout-store');
        Route::get('/pay', [CheckoutController::class, 'pay'])->name('checkout-pay');
    });

    Route::prefix('bayar')->group(function () {
        Route::get('/', [bayar::class, 'index'])->name('bayar');
        Route::get('/pay', [bayar::class, 'pay'])->name('bayar-pay');
    });


    
    Route::prefix('bayarsukses')->group(function () {
        Route::get('/', [bayarsukses::class, 'index'])->name('bayarsukses');
    });

    Route::prefix('profile')->group(function () {
        Route::post('/store', [CheckoutController::class, 'store'])->name('checkout-store');
    });

    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('history');
        Route::get('/dikirim', [HistoryController::class, 'dikirim'])->name('dikirim');
        Route::get('/diterima', [HistoryController::class, 'diterima'])->name('diterima');
        Route::get('/belum_dibayar', [HistoryController::class, 'belum_dibayar'])->name('belum_dibayar');
        Route::get('/{id}', [HistoryController::class, 'show'])->name('history-show');
        Route::get('/{id}/edit', [HistoryController::class, 'edit'])->name('history-edit');
        Route::put('/{id}/update', [HistoryController::class, 'update'])->name('history-update');
    });

    Route::prefix('rating')->group(function () {
        Route::get('/{id}', [RatingController::class, 'show'])->name('rating-show');
        Route::post('/store', [RatingController::class, 'store'])->name('rating-store');
    });



    //midtrans gateway
    Route::get('payment/success', [CheckoutController::class, 'midtransCallBack']);
    Route::post('payment/success', [CheckoutController::class, 'midtransCallBack']);
});
