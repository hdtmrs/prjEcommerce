<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.step1');
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

            'rua' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:30',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:20',

            'aniversario' => 'nullable|date',
            'cnh' => 'nullable|string|max:50',
            'imagemPerfil' => 'nullable|image|max:5120',
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

    private function requestSessionPut($campo, $valor)
    {
        session()->put("cadastro.$campo", $valor);
    }

    private function upSession(Request $request, array $campos)
    {
        foreach ($campos as $campo) {
            if($campo === 'senha') {
                $this->requestSessionPut($campo, Hash::make($request->$campo));
            } else {
                $this->requestSessionPut($campo, $request->$campo);
            }
        }
    }

    public function step1(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:100|string',
            'email' => 'required|email',
            'senha' => 'required',
            'senhaConfirmada' => 'same:senha',
            'telefone' => 'required',
            'cpf' => 'required',
            'tipoConta' => 'required|in:buyer,seller,both',
        ]);

        $this->upSession($request, [
            'nome','email','senha','telefone','cpf','tipoConta'
        ]);

        return redirect()->route('step2');

    }

    public function showStep2()
    {
        return view('auth.step2');
    }

    public function step2(Request $request)
    {
        $request->validate([
            'rua' => 'nullable|string|max:225',
            'numero' => 'nullable|string|max:30',
            'bairro' => 'nullable|string|max:225',
            'cidade' => 'nullable|string|max:225',
            'estado' => 'nullable|string|max:225',
            'cep' => 'nullable|string|max:20',
        ]);

        $this->upSession($request, [
            'rua','numero','bairro','cidade','estado','cep'
        ]);

        return redirect()->route('step3');
    }

    public function showStep3()
    {
        return view('auth.step3');
    }

    public function step3(Request $request)
    {
        $request->validate([
            'aniversario' => 'nullable|date',
            'cnh' => 'nullable|max:50|string',
            'imagemPerfil' => 'nullable|image|max:5120',
            'cnpj' => 'nullable|string|max:50',
            'nomeCompanhia' => 'nullable|string|max:225',
            'bio' => 'nullable|string|max:1000',
        ]);

        $this->upSession($request, [
            'aniversario','cnh','cnpj','nomeCompanhia','bio',
        ]);

        $usuario = $request->session()->get('cadastro');

        Usuario::create($usuario);

        $request->session()->forget('cadastro');

        $query = Cars::query();
        $cars = $query->orderBy('created_at','desc')->paginate(9)->withQueryString();
        return view('cars.index', compact('cars'))->with('success','cadastro realizado com sucesso');
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

