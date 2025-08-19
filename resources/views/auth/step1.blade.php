@extends('layouts.app')
@section('title','Cadastre-se - Passo 1')

@section('content')
<h2>Cadastro - Passo 1</h2>

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('step1') }}" class="form-card">
  @csrf

  <label>Nome completo
    <input name="nome" value="{{ old('nome', session('cadastro.nome')) }}" required>
  </label>

  <label>E-mail
    <input name="email" type="email" value="{{ old('email', session('cadastro.email')) }}" required>
  </label>

  <label>Senha
    <input name="senha" type="password" required>
  </label>

  <label>Confirmar senha
    <input name="senhaConfirmada" type="password" required>
  </label>

  <label>Telefone (celular)
    <input name="telefone" value="{{ old('telefone', session('cadastro.telefone')) }}" required>
  </label>

  <label>CPF
    <input name="cpf" value="{{ old('cpf', session('cadastro.cpf')) }}" required>
  </label>

  <label>Tipo de conta
    <select name="tipoConta" required>
      <option value="buyer" {{ old('tipoConta', session('cadastro.tipoConta'))=='buyer' ? 'selected':'' }}>Comprador</option>
      <option value="seller" {{ old('tipoConta', session('cadastro.tipoConta'))=='seller' ? 'selected':'' }}>Vendedor</option>
      <option value="both" {{ old('tipoConta', session('cadastro.tipoConta'))=='both' ? 'selected':'' }}>Ambos</option>
    </select>
  </label>

  <button class="btn" type="submit">Próximo</button>
</form>
@endsection
