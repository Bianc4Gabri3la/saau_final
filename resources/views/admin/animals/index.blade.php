@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Animais</h1>
        <a href="{{ route('admin.animals.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Cadastrar Novo Animal
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Raça</th>
                            <th>Idade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($animals as $animal)
                        <tr>
                            <td>
                                @if($animal->photo)
                                <img src="{{ $animal->photo }}" alt="{{ $animal->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-paw"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $animal->name }}</td>
                            <td>{{ ucfirst($animal->species) }}</td>
                            <td>{{ $animal->breed ?? '-' }}</td>
                            <td>{{ $animal->age ? $animal->age . ' anos' : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $animal->status == 'disponivel' ? 'success' : ($animal->status == 'adotado' ? 'info' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $animal->status)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.animals.edit', $animal) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.animals.destroy', $animal) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este animal?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhum animal cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $animals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
