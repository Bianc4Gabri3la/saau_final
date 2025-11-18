@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Histórias de Adoção</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif>

    <div class="row">
        @forelse($stories as $story)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                @if($story->photo_url)
                <img src="{{ $story->photo_url }}" class="card-img-top" alt="{{ $story->pet_name }}" style="height: 250px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $story->pet_name }}</h5>
                    <p class="card-text"><strong>Adotante:</strong> {{ $story->adopter_name }}</p>
                    <p class="card-text">{{ Str::limit($story->story, 150) }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ $story->created_at->format('d/m/Y') }}</small>
                        @if($story->approved)
                        <span class="badge bg-success">Aprovada</span>
                        @else
                        <span class="badge bg-warning">Pendente</span>
                        @endif
                    </p>
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2">
                        @if(!$story->approved)
                        <form action="{{ route('admin.stories.approve', $story) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Aprovar
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta história?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                Nenhuma história de adoção cadastrada ainda.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $stories->links() }}
    </div>
</div>
@endsection
