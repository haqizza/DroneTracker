<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register()
    {
        return view('pages.auth.register');
    }

    public function registerproccess(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:users,email|email',
                'password' => [
                    'required',
                    Password::min(8)->mixedCase()->numbers()->symbols(),
                ]
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Berhasil Register Akun');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginproccess(Request $request)
    {
        $login = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $remember = $request->remember ? true : false;
        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();
            $code = Hash::make($user->id);
            $log = new Log();
            $log->user_id = $user->id;
            $log->name = $user->name;
            $log->email = $user->email;
            $log->login = Carbon::now();
            $log->code = $code;
            Session::put('id', $code);
            $log->save();

            return redirect()->route('dashboard')->with('success', 'Welcome ' . $user->name);
        }

        return back()->with('danger', 'Username Atau Password Salah');
    }

    public function logout()
    {
        $log = Log::where('user_id', auth()->user()->id)->where('code', Session::get('id'))->whereNull('logout')->first();
        if ($log) {
            $log->logout = Carbon::now();
            $log->duration = strtotime($log->logout) - strtotime($log->login);
            $log->save();
        } else {
            $data = new Log();
            $data->name = auth()->user()->name;
            $data->email = auth()->user()->email;
            $data->logout = Carbon::now();
            $data->user_id = auth()->user()->id;
            $data->code = 'Not Loged In Account';
            $data->save();
        }
        auth()->logout();
        return redirect()->route('login');
    }
}
