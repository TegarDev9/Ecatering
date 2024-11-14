<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;
use Midtrans;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
    //     Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
    //     Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
    //     Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    // }

    // public function index()
    // {
    //     $title = "Checkout";
    //     $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
    //     return view('pages-user.checkout', compact('title', 'data'));
    // }



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
    // public function store(Request $request)
    // {
    //     $id_order = mt_rand(1000, 99999);
    //     $order1 = Transaksi::create([
    //         'id' => $id_order,
    //         'total' => $request->total,
    //         'status_transaksi' => 'Lunas',
    //         'status' => 'Diproses',
    //         'user_id' => Auth::user()->id,
    //         'tanggal' => date('Y-m-d'),
    //         'lokasi'   => $request->lokasi
    //     ]);

    //     $pesanan = Pesanan::where('user_id', Auth::user()->id)->get();
    //     foreach ($pesanan as $pesanan) {
    //         DetailTransaksi::create([
    //             'quantity'          => $pesanan->quantity,
    //             'transaksi_id'      => $id_order,
    //             'product_id'        => $pesanan->product_id,
    //         ]);
    //         $pesanan->delete();
    //     }

    //     $this->getSnapRedirect($id_order);
    //     $order = Transaksi::find($id_order);
    //     echo '<meta http-equiv="refresh" content="0; URL=' . $order->midtrans_url . '">';
    // }

    public function store(Request $request)
    {
        $id_order = mt_rand(1000, 99999);
        $order1 = Transaksi::create([
            'id' => $id_order,
            'total' => $request->total,
            'status_transaksi' => 'Lunas',
            'status' => 'Diproses',
            'user_id' => Auth::user()->id,
            'tanggal' => date('Y-m-d'),
            'lokasi'   => $request->lokasi
        ]);
        if ($order1){
            return redirect()->route('bayar');
        }

    }

    public function index()
    {
        $title = "Checkout";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
    
        // Hitung total harga
        $total = 0;
        foreach ($data as $ps) {
            $total += $ps->product->price * $ps->quantity;
        }
    
        return view('pages-user.checkout', compact('title', 'data', 'total'));
    }
    
    public function pay(Request $request)
    {
        $title = "Pay";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        
        // Hitung total harga
        $total = 0;
        foreach ($data as $ps) {
            $total += $ps->product->price * $ps->quantity;
        }
    
        return view('pages-user.bayar', compact('title', 'data', 'total'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Checkout";
        $data = Pesanan::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages-user.checkout', compact('title', 'data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // public function getSnapRedirect($id_order)
    // {
    //     $order = Transaksi::find($id_order);
    //     $orderId = $order->id . '-' . Str::random(5);
    //     $price = $order->total;
    //     $order->midtrans_booking_code = $orderId;
    //     $transaction_detail = [
    //         'order_id' => $orderId,
    //         'gross_amount' => $price,
    //     ];

    //     $item_details[] = [
    //         'id' => $orderId,
    //         'price' =>  $price,
    //         'quantity' =>  1,
    //         'name' =>  'Payment for product', // tambahakan title product
    //     ];

    //     $userData = [
    //         "first_name" => $order->user->profile->nama,
    //         "last_name" => "",
    //         "address" => $order->user->profile->alamat,
    //         "phone" => $order->user->profile->no_telp,
    //         "country_code" => "IDN"
    //     ];

    //     $customer_details = [
    //         "first_name" => $order->user->profile->nama,
    //         "last_name" => "",
    //         "email" => $order->user->email,
    //         "phone" => $order->user->profile->no_telp,
    //         "billing_address" => $userData,
    //         "shipping_address" => $userData,
    //     ];

    //     $midtrans_params = [
    //         'transaction_details' => $transaction_detail,
    //         'customer_details' => $customer_details,
    //         'item_details' => $item_details
    //     ];

    //     try {
    //         //code...
    //         $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
    //         $order->midtrans_url = $paymentUrl;
    //         $order->save();

    //         return redirect()->to($paymentUrl);
    //     } catch (Exception $e) {
    //         //throw $th;
    //     }
    // }

    // public function midtransCallBack(Request $request)
    // {
    //     if ($request->method() == 'POST') {
    //         $notif = new Midtrans\Notification();
    //     } else {
    //         $transaksi = new Midtrans\Transaction();
    //         $notif = $transaksi->status($request->order_id);
    //     }

    //     $transaction_status = $notif->transaction_status;
    //     $fraud = $notif->fraud_status;

    //     $order_id = explode('-', $notif->order_id)[0];
    //     $order = Transaksi::find($order_id);

    //     if ($transaction_status == 'capture') {
    //         if ($fraud == 'challenge') {
    //             // TODO Set payment status in merchant's database to 'challenge'
    //             $order->payment_status = 'pending';
    //         } else if ($fraud == 'accept') {
    //             // TODO Set payment status in merchant's database to 'success'
    //             $order->payment_status = 'Lunas';
    //         }
    //     } else if ($transaction_status == 'cancel') {
    //         if ($fraud == 'challenge') {
    //             // TODO Set payment status in merchant's database to 'failure'
    //             $order->payment_status = 'failed';
    //         } else if ($fraud == 'accept') {
    //             // TODO Set payment status in merchant's database to 'failure'
    //             $order->payment_status = 'failed';
    //         }
    //     } else if ($transaction_status == 'deny') {
    //         // TODO Set payment status in merchant's database to 'failure'
    //         $order->payment_status = 'failed';
    //     } else if ($transaction_status == 'settlement') {
    //         // TODO set payment status in merchant's database to 'Settlement'
    //         $order->payment_status = 'Lunas';
    //     } else if ($transaction_status == 'pending') {
    //         // TODO set payment status in merchant's database to 'Pending'
    //         $order->payment_status = 'pending';
    //     } else if ($transaction_status == 'expire') {
    //         // TODO set payment status in merchant's database to 'expire'
    //         $order->payment_status = 'failed';
    //     }

    //     $order->save();
    //     return redirect('/history')->with('success', 'Transaksi Berhasil');
    // }
}
