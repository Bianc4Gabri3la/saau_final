@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Animais Disponíveis</h1>
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
                    <p class="card-text">{{ Str::limit($animal->description, 100) }}</p>
                    <a href="{{ route('animal.show', $animal->id) }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-heart"></i> Ver Detalhes e Adotar
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhum animal disponível.</p>
        @endforelse
    </div>
    {{ $animals->links() }}
</div>
@endsection
