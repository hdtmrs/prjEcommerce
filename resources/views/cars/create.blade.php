@extends('layouts.app')
@section('content')
<h2>Publicar um anúncio</h2>

<form method="POST" action="{{ isset($car) ? route('cars.update',$car) : route('cars.store') }}" enctype="multipart/form-data" class="form-card">
  @csrf
  @if(isset($car)) @method('PUT') @endif

  <label>Título <input name="titulo" value="{{ old('titulo', $car->titulo ?? '') }}"></label>
  <label>Marca <input name="marca" value="{{ old('marca', $car->marca ?? '') }}"></label>
  <label>Modelo <input name="modelo" value="{{ old('modelo', $car->modelo ?? '') }}"></label>
  <label>Ano <input name="ano" type="number" value="{{ old('ano', $car->ano ?? '') }}"></label>
  <label>Condição
    <select name="condicao">
      <option value="used" {{ old('condicao', $car->condicao ?? '') == 'used' ? 'selected':'' }}>Usado</option>
      <option value="new" {{ old('condicao', $car->condicao ?? '') == 'new' ? 'selected':'' }}>Novo</option>
    </select>
  </label>
  <label>Quilometragem <input name="quilometragem" value="{{ old('quilometragem', $car->quilometragem ?? '') }}"></label>
  <label>Preço <input name="preco" value="{{ old('preco', $car->preco ?? '') }}"></label>
  <label>Imagem <input type="file" name="imagem"></label>
  <label>Descrição <textarea name="descricao">{{ old('descricao', $car->descricao ?? '') }}</textarea></label>

  <button class="btn">Salvar anúncio</button>
</form>
@endsection
