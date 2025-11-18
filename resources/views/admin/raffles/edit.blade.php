@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Rifa: {{ $raffle->title }}</h1>
        <a href="{{ route('admin.raffles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.raffles.update', $raffle) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $raffle->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description', $raffle->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prize" class="form-label">Prêmio</label>
                    <input type="text" class="form-control @error('prize') is-invalid @enderror" 
                           id="prize" name="prize" value="{{ old('prize', $raffle->prize) }}">
                    @error('prize')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="ticket_price" class="form-label">Valor do Bilhete *</label>
                        <input type="number" step="0.01" class="form-control @error('ticket_price') is-invalid @enderror" 
                               id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $raffle->ticket_price) }}" required>
                        @error('ticket_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="total_tickets" class="form-label">Total de Bilhetes *</label>
                        <input type="number" class="form-control @error('total_tickets') is-invalid @enderror" 
                               id="total_tickets" name="total_tickets" value="{{ old('total_tickets', $raffle->total_tickets) }}" required>
                        @error('total_tickets')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="draw_date" class="form-label">Data do Sorteio *</label>
                        <input type="date" class="form-control @error('draw_date') is-invalid @enderror" 
                               id="draw_date" name="draw_date" value="{{ old('draw_date', $raffle->draw_date) }}" required>
                        @error('draw_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="ativa" {{ old('status', $raffle->status) == 'ativa' ? 'selected' : '' }}>Ativa</option>
                        <option value="encerrada" {{ old('status', $raffle->status) == 'encerrada' ? 'selected' : '' }}>Encerrada</option>
                        <option value="sorteada" {{ old('status', $raffle->status) == 'sorteada' ? 'selected' : '' }}>Sorteada</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($raffle->image_url)
                <div class="mb-3">
                    <label class="form-label">Imagem Atual</label>
                    <div>
                        <img src="{{ $raffle->image_url }}" alt="{{ $raffle->title }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">{{ $raffle->image_url ? 'Alterar Imagem' : 'Adicionar Imagem' }}</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('admin.raffles.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
