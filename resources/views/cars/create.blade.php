@extends('layouts.app')
@section('content')
<h2>Publicar um anúncio</h2>

<form method="POST" action="{{ isset($car) ? route('cars.update',$car) : route('cars.store') }}" enctype="multipart/form-data" class="form-card">
  @csrf
  @if(isset($car)) @method('PUT') @endif

  <label>Título <input name="title" value="{{ old('title', $car->title ?? '') }}"></label>
  <label>Marca <input name="brand" value="{{ old('brand', $car->brand ?? '') }}"></label>
  <label>Modelo <input name="model" value="{{ old('model', $car->model ?? '') }}"></label>
  <label>Ano <input name="year" type="number" value="{{ old('year', $car->year ?? '') }}"></label>
  <label>Condição
    <select name="condition">
      <option value="used" {{ old('condition', $car->condition ?? '') == 'used' ? 'selected':'' }}>Usado</option>
      <option value="new" {{ old('condition', $car->condition ?? '') == 'new' ? 'selected':'' }}>Novo</option>
    </select>
  </label>
  <label>Quilometragem <input name="mileage" value="{{ old('mileage', $car->mileage ?? '') }}"></label>
  <label>Preço <input name="price" value="{{ old('price', $car->price ?? '') }}"></label>
  <label>Imagem <input type="file" name="image"></label>
  <label>Descrição <textarea name="description">{{ old('description', $car->description ?? '') }}</textarea></label>

  <button class="btn">Salvar anúncio</button>
</form>
@endsection
