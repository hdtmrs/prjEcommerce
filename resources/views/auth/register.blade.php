@extends('layouts.app')
@section('title','Cadastre-se')

@section('content')
<h2>Cadastrar conta</h2>

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="form-card">
  @csrf

  <label>Nome completo
    <input name="name" value="{{ old('name') }}" required>
  </label>

  <label>E-mail
    <input name="email" type="email" value="{{ old('email') }}" required>
  </label>

  <label>Senha
    <input name="password" type="password" required>
  </label>

  <label>Confirmar senha
    <input name="password_confirmation" type="password" required>
  </label>

  <label>Telefone (celular)
    <input name="phone" value="{{ old('phone') }}" required>
  </label>

  <label>CPF
    <input name="cpf" value="{{ old('cpf') }}" required>
  </label>

  <label>Tipo de conta
    <select name="type_account" required>
      <option value="buyer" {{ old('type_account')=='buyer' ? 'selected':'' }}>Comprador</option>
      <option value="seller" {{ old('type_account')=='seller' ? 'selected':'' }}>Vendedor</option>
      <option value="both" {{ old('type_account')=='both' ? 'selected':'' }}>Ambos</option>
    </select>
  </label>

  <label>Foto de perfil (opcional)
    <input type="file" name="profile_image">
  </label>

  <hr style="grid-column:span 2;border:none;height:1px;background:rgba(255,255,255,0.03);margin:8px 0">

  <p style="grid-column:span 2;color:var(--muted)">Dados opcionais (preencha depois no perfil se preferir)</p>

  <label>Rua
    <input name="street" value="{{ old('street') }}">
  </label>

  <label>Número
    <input name="number" value="{{ old('number') }}">
  </label>

  <label>Bairro
    <input name="neighborhood" value="{{ old('neighborhood') }}">
  </label>

  <label>Cidade
    <input name="city" value="{{ old('city') }}">
  </label>

  <label>Estado
    <input name="state" value="{{ old('state') }}">
  </label>

  <label>CEP
    <input name="cep" value="{{ old('cep') }}">
  </label>

  <label>Data de nascimento
    <input name="birthdate" type="date" value="{{ old('birthdate') }}">
  </label>

  <label>CNH (opcional)
    <input name="cnh" value="{{ old('cnh') }}">
  </label>

  <label>CNPJ (se empresa)
    <input name="cnpj" value="{{ old('cnpj') }}">
  </label>

  <label>Nome da empresa (opcional)
    <input name="company_name" value="{{ old('company_name') }}">
  </label>

  <label style="grid-column:span 2">Biografia / apresentação (opcional)
    <textarea name="bio">{{ old('bio') }}</textarea>
  </label>

  <button class="btn" type="submit" style="grid-column:span 2">Criar conta</button>

  <p style="grid-column:span 2;color:var(--muted)">Já tem conta? <a href="{{ route('login') }}" style="color:var(--text)">Entrar</a></p>
</form>
@endsection
