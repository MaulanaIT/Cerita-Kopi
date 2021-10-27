<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->to('/dashboard');
        }

        $page = 'Login';
        $title = "Cerita Kopi - Login";

        return view('login', compact('page', 'title'));
    }

    public function login(Request $request) {
        Auth::attempt([
            'name' => $request->input('username'), 
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ]);

        if (Auth::check()) {
            return redirect()->to('/dashboard');
        }
        
        return redirect()->route('login');
    }

    public function store(Request $request) {
        $check = AuthModel::where('email', $request->input('email'))->get();

        if (count($check) > 0) {
            $code = 407;
        } else {
            $register = AuthModel::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 'Admin'
            ]);
    
            if ($register) {
                $code = 200;
            } else {
                $code = 406;
            }
        }
        
        return response()->json(['code' => $code]);
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
