@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Animais Disponíveis</h1>

    {{-- =========================
         FILTRO DE ADOÇÃO
       ========================== --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('animals') }}">
                <div class="row g-2">
                    {{-- Busca por nome/descrição --}}
                    <div class="col-md-4">
                        <input
                            type="text"
                            name="q"
                            class="form-control"
                            placeholder="Buscar por nome ou descrição"
                            value="{{ request('q') }}"
                        >
                    </div>

                    {{-- Espécie --}}
                    <div class="col-md-2">
                        <select name="species" class="form-control">
                            <option value="">Espécie</option>
                            <option value="cachorro" {{ request('species') == 'cachorro' ? 'selected' : '' }}>Cachorro</option>
                            <option value="gato" {{ request('species') == 'gato' ? 'selected' : '' }}>Gato</option>
                        </select>
                    </div>

                    {{-- Sexo --}}
                    <div class="col-md-2">
                        <select name="gender" class="form-control">
                            <option value="">Sexo</option>
                            <option value="macho" {{ request('gender') == 'macho' ? 'selected' : '' }}>Macho</option>
                            <option value="fêmea" {{ request('gender') == 'fêmea' ? 'selected' : '' }}>Fêmea</option>
                        </select>
                    </div>

                    {{-- Porte --}}
                    <div class="col-md-2">
                        <select name="size" class="form-control">
                            <option value="">Porte</option>
                            <option value="pequeno" {{ request('size') == 'pequeno' ? 'selected' : '' }}>Pequeno</option>
                            <option value="médio" {{ request('size') == 'médio' ? 'selected' : '' }}>Médio</option>
                            <option value="grande" {{ request('size') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>

                    {{-- Botões --}}
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2 w-100">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('animals') }}" class="btn btn-outline-secondary w-100 mt-0 mt-md-0 ms-md-2">
                            Limpar
                        </a>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    {{-- Idade mínima --}}
                    <div class="col-md-2">
                        <input
                            type="number"
                            name="min_age"
                            class="form-control"
                            placeholder="Idade mín."
                            min="0"
                            value="{{ request('min_age') }}"
                        >
                    </div>

                    {{-- Idade máxima --}}
                    <div class="col-md-2">
                        <input
                            type="number"
                            name="max_age"
                            class="form-control"
                            placeholder="Idade máx."
                            min="0"
                            value="{{ request('max_age') }}"
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- =========================
         LISTAGEM DOS ANIMAIS
       ========================== --}}
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

    {{-- Mantém os filtros na paginação --}}
    {{ $animals->withQueryString()->links() }}
</div>
@endsection
