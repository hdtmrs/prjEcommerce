@extends('layouts.app')
@section('title',$car->title)

@section('content')
<article class="details">
  <div class="gallery">
    <img src="{{ $car->image ? asset('storage/'.$car->image) : asset('images/placeholder-car.jpg') }}" alt="{{ $car->title }}">
  </div>
  <div class="info">
    <h2>{{ $car->title }}</h2>
    <p class="price">R$ {{ number_format($car->price,2,',','.') }}</p>
    <ul class="specs">
      <li><strong>Marca:</strong> {{ $car->brand }}</li>
      <li><strong>Modelo:</strong> {{ $car->model }}</li>
      <li><strong>Ano:</strong> {{ $car->year }}</li>
      <li><strong>Quilometragem:</strong> {{ $car->mileage ?? '—' }} km</li>
      <li><strong>Condição:</strong> {{ ucfirst($car->condition) }}</li>
    </ul>
    <p class="desc">{{ $car->description }}</p>

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
