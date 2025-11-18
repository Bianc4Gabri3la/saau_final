@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes do Pedido de Adoção</h1>
        <a href="{{ route('admin.adoption-requests.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Informações do Adotante</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> {{ $adoptionRequest->adopter_name }}</p>
                    <p><strong>Email:</strong> {{ $adoptionRequest->adopter_email }}</p>
                    <p><strong>Telefone:</strong> {{ $adoptionRequest->adopter_phone }}</p>
                    <p><strong>Endereço:</strong> {{ $adoptionRequest->adopter_address ?? 'Não informado' }}</p>
                    <p><strong>Data do Pedido:</strong> {{ $adoptionRequest->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5>Informações do Animal</h5>
                </div>
                <div class="card-body">
                    @if($adoptionRequest->animal)
                    <div class="d-flex align-items-center">
                        @if($adoptionRequest->animal->photo_url)
                        <img src="{{ $adoptionRequest->animal->photo_url }}" alt="{{ $adoptionRequest->animal->name }}" 
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; margin-right: 20px;">
                        @endif
                        <div>
                            <h5>{{ $adoptionRequest->animal->name }}</h5>
                            <p class="mb-1"><strong>Espécie:</strong> {{ ucfirst($adoptionRequest->animal->species) }}</p>
                            <p class="mb-1"><strong>Raça:</strong> {{ $adoptionRequest->animal->breed ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Idade:</strong> {{ $adoptionRequest->animal->age ?? 'N/A' }} anos</p>
                            <p class="mb-1"><strong>Status:</strong> 
                                <span class="badge bg-{{ $adoptionRequest->animal->status == 'disponivel' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($adoptionRequest->animal->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @else
                    <p>Animal não encontrado</p>
                    @endif
                </div>
            </div>

            @if($adoptionRequest->message)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Mensagem do Adotante</h5>
                </div>
                <div class="card-body">
                    <p>{{ $adoptionRequest->message }}</p>
                </div>
            </div>
            @endif

            @if($adoptionRequest->admin_notes)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Observações do Administrador</h5>
                </div>
                <div class="card-body">
                    <p>{{ $adoptionRequest->admin_notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Ações</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.adoption-requests.update', $adoptionRequest) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pendente" {{ $adoptionRequest->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="aprovado" {{ $adoptionRequest->status == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                                <option value="rejeitado" {{ $adoptionRequest->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Observações</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4">{{ $adoptionRequest->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </form>

                    <hr>

                    <form action="{{ route('admin.adoption-requests.destroy', $adoptionRequest) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Remover Pedido
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
