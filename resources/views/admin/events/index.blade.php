@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Eventos</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Novo Evento
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
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td>
                                @if($event->image_url)
                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                            <td>{{ $event->location ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $event->active ? 'success' : 'secondary' }}">
                                    {{ $event->active ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este evento?')">
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
                            <td colspan="6" class="text-center">Nenhum evento cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
