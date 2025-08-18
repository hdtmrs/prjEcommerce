<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('tbUsuario','email')],
            'senha' => 'required|string|min:8|',
            'senhaConfirmada' => 'same:senha',
            'telefone' => 'required|string|max:20',
            'cpf' => ['required','string','max:20', Rule::unique('tbUsuario','cpf')],
            'tipoConta' => 'required|in:buyer,seller,both',

            
            'imagemPerfil' => 'nullable|image|max:5120',
            'rua' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:30',
            'neighborhood' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'stado' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:20',
            'aniversario' => 'nullable|date',
            'cnh' => 'nullable|string|max:50',
            'cnpj' => 'nullable|string|max:50',
            'nomeCompania' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('imagemPerfil')) {
            $data['imagemPerfil'] = $request->file('imagemPerfil')->store('profiles','public');
        }

        $data['senha'] = Hash::make($data['senha']);

        $user = Usuario::create($data);

        Auth::login($user);

        return redirect()->route('cars.index')->with('success','Conta criada! Bem-vindo(a).');
    }



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

        $remember = $request->boolean('remember');

        $usuario = Usuario::where('email', $creds['email'])->first();
        if(!$usuario || !Hash::check($creds['senha'],$usuario->senha)){
            return back()->withErrors('Acesso negado')->onlyInput('email');
        }

        Auth::login($usuario, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('cars.indexs'));
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout realizado.');
    }
}

