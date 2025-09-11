@extends('layouts.app')
@section('title','Perfil')

@section('content')
<h2>Meu Perfil</h2>

@if(session('success'))
  <div class="alert success">{{ session('success') }}</div>
@endif

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<div class="details">
  <div>
    <div class="gallery">
      @if($user->imagemPerfil)
        <img src="{{ asset('storage/' . $user->imagemPerfil) }}" alt="Foto de perfil">
      @else
        <img src="{{ asset('images/default-profile.png') }}" alt="Foto padrão">
      @endif
    </div>

    <h3 style="margin-top:1rem">{{ $user->nome }}</h3>
    <p class="meta">{{ $user->email }}</p>
    <p class="meta">{{ ucfirst($user->tipoConta) }}</p>

    <a href="{{ route('logout') }}" class="btn outline small" style="margin-top:1rem">Sair</a>
  </div>

  <div class="info">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-card">
      @csrf
      @method('PUT')

      <label>Nome
        <input name="nome" value="{{ old('nome', $user->nome) }}" required>
      </label>

      <label>Email
        <input name="email" type="email" value="{{ old('email', $user->email) }}" required>
      </label>

      <label>Telefone
        <input name="telefone" value="{{ old('telefone', $user->telefone) }}">
      </label>

      <label>CPF
        <input name="cpf" value="{{ old('cpf', $user->cpf) }}">
      </label>

      <label>Data de nascimento
        <input name="aniversario" type="date" value="{{ old('aniversario', $user->aniversario) }}">
      </label>

      <label>Tipo de conta
        <select name="tipoConta">
          <option value="buyer" {{ $user->tipoConta == 'buyer' ? 'selected' : '' }}>Comprador</option>
          <option value="seller" {{ $user->tipoConta == 'seller' ? 'selected' : '' }}>Vendedor</option>
          <option value="both" {{ $user->tipoConta == 'both' ? 'selected' : '' }}>Ambos</option>
        </select>
      </label>

      <label>Rua
        <input name="rua" value="{{ old('rua', $user->rua) }}">
      </label>

      <label>Número
        <input name="numero" value="{{ old('numero', $user->numero) }}">
      </label>

      <label>Bairro
        <input name="neighborhood" value="{{ old('neighborhood', $user->neighborhood) }}">
      </label>

      <label>Cidade
        <input name="cidade" value="{{ old('cidade', $user->cidade) }}">
      </label>

      <label>Estado
        <input name="estado" value="{{ old('estado', $user->estado) }}">
      </label>

      <label>CEP
        <input name="cep" value="{{ old('cep', $user->cep) }}">
      </label>

      <label>CNPJ
        <input name="cnpj" value="{{ old('cnpj', $user->cnpj) }}">
      </label>

      <label>Nome da empresa
        <input name="nomeCompania" value="{{ old('nomeCompania', $user->nomeCompania) }}">
      </label>

      <label style="grid-column:span 2">Biografia
        <textarea name="bio">{{ old('bio', $user->bio) }}</textarea>
      </label>

      <label style="grid-column:span 2">Foto de perfil
        <input type="file" name="imagemPerfil">
      </label>

      <button type="submit" class="btn" style="grid-column:span 2">Salvar alterações</button>
    </form>
  </div>
</div>
@endsection
