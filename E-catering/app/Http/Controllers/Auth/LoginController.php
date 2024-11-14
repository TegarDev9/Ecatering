<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'username' : 'username';
        $data = User::where('username', $request->username)->first();

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (auth()->attempt($login)) {
            if ($data->role == 'merchant') {
                return redirect()->route('home_merchant');
            } else if ($data->role == 'customer') {
                return redirect()->route('home_customer');
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login')->with(['error' => 'Email/Password salah!']);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
