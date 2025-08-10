<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cars;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        $query = Cars::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('brand', 'like', "%{$s}%")
                  ->orWhere('model', 'like', "%{$s}%");
            });
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
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
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'condition' => 'required|in:new,used',
            'mileage' => 'nullable|integer',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120', // 5MB
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars','public');
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('success','Carro cadastrado com sucesso!');
    }

    public function show(Cars $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Cars $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Cars $car)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'condition' => 'required|in:new,used',
            'mileage' => 'nullable|integer',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // opcional: remover imagem antiga
            $data['image'] = $request->file('image')->store('cars','public');
        }

        $car->update($data);

        return redirect()->route('cars.show', $car)->with('success','Carro atualizado!');
    }

    public function destroy(Cars $car)
    {
        // opcional: apagar imagem do storage
        $car->delete();
        return redirect()->route('cars.index')->with('success','Carro removido');
    }
}


