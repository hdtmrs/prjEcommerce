@extends('layouts.app')
@section('title','Entrar')

@section('content')
<h2>Entrar</h2>

@if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('login') }}" class="form-card" style="max-width:600px">
  @csrf

  <label>E-mail
    <input name="email" type="email" value="{{ old('email') }}" required>
  </label>

  <label>Senha
    <input name="password" type="password" required>
  </label>

  <label style="display:flex;align-items:center;gap:.5rem">
    <input type="checkbox" name="remember" {{ old('remember') ? 'checked':'' }}> Lembrar de mim
  </label>

  <button class="btn" style="grid-column:span 2" type="submit">Entrar</button>

  <p style="grid-column:span 2;color:var(--muted)">Não tem conta? <a href="{{ route('register') }}" style="color:var(--text)">Cadastre-se</a></p>
</form>
@endsection
