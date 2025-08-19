@extends('layouts.app')
@section('title','Cadastre-se - Passo 2')

@section('content')
<h2>Cadastro - Passo 2</h2>

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('step2') }}" class="form-card">
  @csrf

  <label>Rua
    <input name="rua" value="{{ old('rua', session('cadastro.rua')) }}">
  </label>

  <label>Número
    <input name="numero" value="{{ old('numero', session('cadastro.numero')) }}">
  </label>

  <label>Bairro
    <input name="bairro" value="{{ old('bairro', session('cadastro.bairro')) }}">
  </label>

  <label>Cidade
    <input name="cidade" value="{{ old('cidade', session('cadastro.cidade')) }}">
  </label>

  <label>Estado
    <input name="estado" value="{{ old('estado', session('cadastro.estado')) }}">
  </label>

  <label>CEP
    <input name="cep" value="{{ old('cep', session('cadastro.cep')) }}">
  </label>

  <button class="btn" type="submit">Próximo</button>
</form>
@endsection
