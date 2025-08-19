@extends('layouts.app')
@section('title','Cadastre-se - Passo 3')

@section('content')
<h2>Cadastro - Passo 3</h2>

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('step3') }}" enctype="multipart/form-data" class="form-card">
  @csrf

  <label>Data de nascimento
    <input name="aniversario" type="date" value="{{ old('aniversario', session('cadastro.aniversario')) }}">
  </label>

  <label>CNH (opcional)
    <input name="cnh" value="{{ old('cnh', session('cadastro.cnh')) }}">
  </label>

  <label>Foto de perfil
    <input type="file" name="imagemPerfil">
  </label>

  <label>CNPJ (se empresa)
    <input name="cnpj" value="{{ old('cnpj', session('cadastro.cnpj')) }}">
  </label>

  <label>Nome da empresa (opcional)
    <input name="nomeCompanhia" value="{{ old('nomeCompanhia', session('cadastro.companhia')) }}">
  </label>

  <label style="grid-column:span 2">Biografia / apresentação (opcional)
    <textarea name="bio">{{ old('bio', session('cadastro.bio')) }}</textarea>
  </label>

  <button class="btn" type="submit">Finalizar cadastro</button>
</form>
@endsection
