@extends('layouts.app')

@section('content')
<div class="hero">
    <div class="container">
        <h1 class="display-3"><i class="fas fa-heart"></i> Adote um Amigo</h1>
        <p class="lead">Dê uma segunda chance para um animal que precisa de amor e carinho</p>
        <a href="{{ route('animals') }}" class="btn btn-light btn-lg mt-3">Ver Animais Disponíveis</a>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-primary">{{ $stats['animals'] }}</h2>
                <p>Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-success">{{ $stats['adopted'] }}</h2>
                <p>Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-info">{{ $stats['events'] }}</h2>
                <p>Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-warning">{{ $stats['raffles'] }}</h2>
                <p>Rifas Ativas</p>
            </div>
        </div>
    </div>

    <h2 class="text-center mb-4">Animais Disponíveis para Adoção</h2>
    <div class="row">
        @forelse($animals as $animal)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($animal->photo)
                <img src="{{ $animal->photo }}" class="card-img-top" alt="{{ $animal->name }}" style="height: 250px; object-fit: cover;">
                @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-paw fa-4x text-white"></i>
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $animal->name }}</h5>
                    <p class="card-text">
                        <i class="fas fa-paw"></i> {{ ucfirst($animal->species) }} | 
                        <i class="fas fa-{{ $animal->gender == 'macho' ? 'mars' : 'venus' }}"></i> {{ ucfirst($animal->gender) }}<br>
                        @if($animal->age)
                        <i class="fas fa-calendar"></i> {{ $animal->age }} {{ $animal->age == 1 ? 'ano' : 'anos' }}<br>
                        @endif
                        @if($animal->size)
                        <i class="fas fa-ruler"></i> Porte {{ ucfirst($animal->size) }}
                        @endif
                    </p>
                    <p>{{ Str::limit($animal->description, 80) }}</p>
                    <a href="{{ route('animal.show', $animal->id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-heart"></i> Quero Adotar
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>Nenhum animal disponível no momento.</p>
        </div>
        @endforelse
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('animals') }}" class="btn btn-outline-primary">Ver Todos os Animais</a>
    </div>
</div>
@endsection
