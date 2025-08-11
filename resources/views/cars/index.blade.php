@extends('layouts.app')
@section('title','Comprar carros')

@section('content')
<section class="hero">
  <h1>Encontre seu próximo carro</h1>
  <p>Filtre por marca, condição ou busque algo específico.</p>

  <form method="GET" class="search-form">
    <input name="search" placeholder="Ex: Civic, Corolla, Gol..." value="{{ request('search') }}">
    <select name="condition">
      <option value="">Todos</option>
      <option value="new" {{ request('condicao')=='new' ? 'selected':'' }}>Novo</option>
      <option value="used" {{ request('condicao')=='used' ? 'selected':'' }}>Usado</option>
    </select>
    <button>Pesquisar</button>
  </form>
</section>

<section class="grid">
  @forelse($cars as $car)
    <article class="card">
      <div class="thumb" style="background-image:url('{{ $car->imagem ? asset('storage/'.$car->imagem) : asset('images/placeholder-car.jpg') }}')"></div>
      <div class="card-body">
        <h3>{{ $car->title }}</h3>
        <p class="meta">{{ $car->marca }} • {{ $car->modelo }} • {{ $car->ano }} • {{ $car->condicao == 'new' ? 'Novo' : 'Usado' }}</p>
        <p class="price">R$ {{ number_format($car->preco,2,',','.') }}</p>
        <a href="{{ route('cars.show', $car) }}" class="btn small">ver anúncio</a>
      </div>
    </article>
  @empty
    <p>Nenhum carro encontrado.</p>
  @endforelse
</section>

<div class="pagination">
  {{ $cars->links() }}
</div>
@endsection
