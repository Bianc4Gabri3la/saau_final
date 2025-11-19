@extends('layouts.app')

@section('content')
<div class="container my-5">
    {{-- Botão voltar --}}
    <div class="mb-4">
        <a href="{{ route('animals') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar para lista de animais
        </a>
    </div>

    <div class="row">
        {{-- FOTO / IMAGEM --}}
        <div class="col-md-6">
            @if($animal->photo)
                <img src="{{ $animal->photo }}" 
                     class="img-fluid rounded shadow mb-4" 
                     alt="{{ $animal->name }}"
                     style="width: 100%; max-height: 500px; object-fit: cover;">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center rounded shadow mb-4"
                     style="width: 100%; height: 400px;">
                    <i class="fas fa-paw fa-5x text-white"></i>
                </div>
            @endif
        </div>

        {{-- INFORMAÇÕES DO ANIMAL --}}
        <div class="col-md-6">
            <h1 class="mb-3">{{ $animal->name }}</h1>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle"></i> Informações
                    </h5>

                    <p class="mb-2">
                        <strong><i class="fas fa-paw"></i> Espécie:</strong>
                        {{ ucfirst($animal->species) }}
                    </p>

                    @if($animal->breed)
                        <p class="mb-2">
                            <strong><i class="fas fa-dog"></i> Raça:</strong>
                            {{ $animal->breed }}
                        </p>
                    @endif

                    @if($animal->age)
                        <p class="mb-2">
                            <strong><i class="fas fa-calendar"></i> Idade:</strong>
                            @switch($animal->age)
                                @case('filhote')
                                    Filhote
                                    @break
                                @case('adulto')
                                    Adulto
                                    @break
                                @case('idoso')
                                    Idoso
                                    @break
                                @default
                                    {{ $animal->age }}
                            @endswitch
                        </p>
                    @endif

                    <p class="mb-2">
                        <strong>
                            <i class="fas fa-{{ $animal->gender == 'macho' ? 'mars' : 'venus' }}"></i> Sexo:
                        </strong>
                        {{ ucfirst($animal->gender) }}
                    </p>

                    @if($animal->size)
                        <p class="mb-2">
                            <strong><i class="fas fa-ruler"></i> Porte:</strong>
                            {{ ucfirst($animal->size) }}
                        </p>
                    @endif

                    @if($animal->color)
                        <p class="mb-2">
                            <strong><i class="fas fa-palette"></i> Cor:</strong>
                            {{ $animal->color }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- SAÚDE --}}
            @if($animal->castrated || $animal->vaccinated || $animal->dewormed || $animal->special_needs)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-heartbeat"></i> Saúde
                        </h5>

                        @if($animal->castrated)
                            <p class="mb-1">
                                <i class="fas fa-check text-success"></i> Castrado
                            </p>
                        @endif

                        @if($animal->vaccinated)
                            <p class="mb-1">
                                <i class="fas fa-check text-success"></i> Vacinado
                            </p>
                        @endif

                        @if($animal->dewormed)
                            <p class="mb-1">
                                <i class="fas fa-check text-success"></i> Vermifugado
                            </p>
                        @endif

                        @if($animal->special_needs)
                            <p class="mb-1">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                Necessidades Especiais
                            </p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- DESCRIÇÃO --}}
            @if($animal->description)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-align-left"></i> Sobre {{ $animal->name }}
                        </h5>
                        <p class="mb-0">{{ $animal->description }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- FORMULÁRIO DE ADOÇÃO --}}
    <div class="row mt-4">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Solicitar Adoção</h3>

                    @auth
                        <form method="POST" action="{{ route('adoption.request', $animal->id) }}">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="full_name" class="form-control"
                                       placeholder="Nome Completo" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Email" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control"
                                       placeholder="Telefone" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="city_state" class="form-control"
                                       placeholder="Cidade/Estado" required>
                            </div>

                            <div class="mb-3">
                                <select name="housing_type" class="form-control" required>
                                    <option value="">Tipo de Moradia</option>
                                    <option value="casa">Casa</option>
                                    <option value="apartamento">Apartamento</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <textarea name="message" class="form-control"
                                          placeholder="Mensagem (opcional)"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Enviar Pedido
                            </button>
                        </form>
                    @else
                        <p class="alert alert-info mb-0">
                            Faça
                            <a href="{{ route('login') }}" class="alert-link">login</a>
                            para solicitar adoção de {{ $animal->name }}.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
