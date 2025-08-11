<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cars;

class CarsController extends Controller
{


    public function show(Cars $car)
    {
        return view('cars.show', compact('car'));
    }

    public function index(Request $request)
    {
        $query = Cars::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('titulo', 'like', "%{$s}%")
                  ->orWhere('marca', 'like', "%{$s}%")
                  ->orWhere('modelo', 'like', "%{$s}%");
            });
        }

        if ($request->filled('condicao')) {
            $query->where('condicao', $request->condition);
        }

        $cars = $query->orderBy('created_at','desc')->paginate(9)->withQueryString();
        return view('cars.index', compact('cars'));
    }




    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'condicao' => 'required|in:new,used',
            'quilometragem' => 'nullable|integer',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:5120', // 5MB
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('tbCars','public');
        }

        Cars::create($data);

        return redirect()->route('cars.index')->with('success','Carro cadastrado com sucesso!');
    }



    public function edit(Cars $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Cars $car)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'condicao' => 'required|in:new,used',
            'quilometragem' => 'nullable|integer',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('imagem')) {
            
            $data['imagem'] = $request->file('imagem')->store('tbCars','public');
        }

        $car->update($data);

        return redirect()->route('cars.show', $car)->with('success','Carro atualizado!');
    }




    public function destroy(Cars $car)
    {
        
        $car->delete();
        return redirect()->route('cars.index')->with('success','Carro removido');
    }
}


