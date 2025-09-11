<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UsuarioController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.step1');
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
    
    public function showPerfil(Request $request) {
        $user = Auth::user();
        return view('auth.perfil', compact('user'));
    }
}

