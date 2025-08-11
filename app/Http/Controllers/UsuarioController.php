<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'cpf' => ['required','string','max:20', Rule::unique('users','cpf')],
            'type_account' => 'required|in:buyer,seller,both',

            // opcionais
            'profile_image' => 'nullable|image|max:5120',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:30',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'cnh' => 'nullable|string|max:50',
            'cnpj' => 'nullable|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles','public');
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

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
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($creds, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('cars.index'));
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout realizado.');
    }
}

