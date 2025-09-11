<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $creds = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);


        $usuario = Usuario::where('email', $creds['email'])->first();
        if(!$usuario || !Hash::check($creds['senha'],$usuario->senha)){
            return back()->withErrors('Acesso negado')->onlyInput('email');
        }

            return redirect()->intended(route('cars.index'));
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout realizado.');
    }

    
}
