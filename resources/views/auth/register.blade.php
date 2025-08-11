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
    <input name="nome" value="{{ old('nome') }}" required>
  </label>

  <label>E-mail
    <input name="email" type="email" value="{{ old('email') }}" required>
  </label>

  <label>Senha
    <input name="senha" type="password" required>
  </label>

  <label>Confirmar senha
    <input name="senhaConfirmada" type="password" required>
  </label>

  <label>Telefone (celular)
    <input name="telefone" value="{{ old('telefone') }}" required>
  </label>

  <label>CPF
    <input name="cpf" value="{{ old('cpf') }}" required>
  </label>

  <label>Tipo de conta
    <select name="tipoConta" required>
      <option value="buyer" {{ old('tipoConta')=='buyer' ? 'selected':'' }}>Comprador</option>
      <option value="seller" {{ old('tipoConta')=='seller' ? 'selected':'' }}>Vendedor</option>
      <option value="both" {{ old('tipoConta')=='both' ? 'selected':'' }}>Ambos</option>
    </select>
  </label>

  <label>Foto de perfil (opcional)
    <input type="file" name="imagemPerfil">
  </label>

  <hr style="grid-column:span 2;border:none;height:1px;background:rgba(255,255,255,0.03);margin:8px 0">

  <p style="grid-column:span 2;color:var(--muted)">Dados opcionais (preencha depois no perfil se preferir)</p>

  <label>Rua
    <input name="rua" value="{{ old('rua') }}">
  </label>

  <label>Número
    <input name="numero" value="{{ old('numero') }}">
  </label>

  <label>Bairro
    <input name="neighborhood" value="{{ old('neighborhood') }}">
  </label>

  <label>Cidade
    <input name="cidade" value="{{ old('cidade') }}">
  </label>

  <label>Estado
    <input name="stado" value="{{ old('estado') }}">
  </label>

  <label>CEP
    <input name="cep" value="{{ old('cep') }}">
  </label>

  <label>Data de nascimento
    <input name="aniversario" type="date" value="{{ old('aniversario') }}">
  </label>

  <label>CNH (opcional)
    <input name="cnh" value="{{ old('cnh') }}">
  </label>

  <label>CNPJ (se empresa)
    <input name="cnpj" value="{{ old('cnpj') }}">
  </label>

  <label>Nome da empresa (opcional)
    <input name="nomeCompania" value="{{ old('nomeCompania') }}">
  </label>

  <label style="grid-column:span 2">Biografia / apresentação (opcional)
    <textarea name="bio">{{ old('bio') }}</textarea>
  </label>

  <button class="btn" type="submit" style="grid-column:span 2">Criar conta</button>

  <p style="grid-column:span 2;color:var(--muted)">Já tem conta? <a href="{{ route('login') }}" style="color:var(--text)">Entrar</a></p>
</form>
@endsection
