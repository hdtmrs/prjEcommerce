<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','AutoMercado')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <a class="brand" href="{{ route('cars.index') }}">Auto<span>Mercado</span></a>
      <nav>
        <a href="{{ route('cars.create') }}" class="btn">Anunciar carro</a>
        <a href="{{ route('login') }}" class="btn">
          <span class="material-symbols-outlined iconLogin">person</span>
        </a>
      </nav>

    </div>
  </header>

  <main class="container">
    @if(session('success'))
      <div class="alert success">{{ session('success') }}</div>
    @endif

    @yield('content')
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>© {{ date('Y') }} AutoMercado — Seu destino para carros novos e usados</p>
    </div>
  </footer>
</body>
</html>
