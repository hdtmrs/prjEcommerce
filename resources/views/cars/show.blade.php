@extends('layouts.app')
@section('title',$car->title)

@section('content')
<article class="details">
  <div class="gallery">
    <img src="{{ $car->imagem ? asset('storage/'.$car->imagem) : asset('images/placeholder-car.jpg') }}" alt="{{ $car->titulo }}">
  </div>
  <div class="info">
    <h2>{{ $car->titulo}}</h2>
    <p class="price">R$ {{ number_format($car->preco,2,',','.') }}</p>
    <ul class="specs">
      <li><strong>Marca:</strong> {{ $car->marca }}</li>
      <li><strong>Modelo:</strong> {{ $car->modelo }}</li>
      <li><strong>Ano:</strong> {{ $car->ano }}</li>
      <li><strong>Quilometragem:</strong> {{ $car->quilometragem ?? '—' }} km</li>
      <li><strong>Condição:</strong> {{ ucfirst($car->condicao) }}</li>
    </ul>
    <p class="desc">{{ $car->descricao }}</p>

    <div class="actions">
      <a href="#" class="btn big">Agendar test-drive</a>
      <a href="{{ route('cars.edit', $car) }}" class="btn outline">Editar</a>

      <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Remover anúncio?');" style="display:inline">
        @csrf @method('DELETE')
        <button class="btn danger">Remover</button>
      </form>
    </div>
  </div>
</article>
@endsection
