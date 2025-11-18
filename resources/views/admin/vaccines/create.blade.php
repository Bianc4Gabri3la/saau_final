@extends('layouts.admin')

@section('title', 'Cadastrar Vacina')

@section('content')
<div class="container-fluid">
    <div class="page-header mb-4">
        <h1 class="page-title">Cadastrar Vacina</h1>
    </div>

    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Nova vacina</h2>
        </div>

        <form action="{{ route('admin.vaccines.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Animal --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Animal</label>
                    <select name="animal_id" class="form-control" required>
                        <option value="">Selecione um animal...</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                {{ $animal->name }} ({{ $animal->species }})
                            </option>
                        @endforeach
                    </select>
                    @error('animal_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nome da vacina --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome da vacina</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Data da aplicação --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">Data da aplicação</label>
                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ old('date') }}"
                        required
                    >
                    @error('date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Veterinário --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">Veterinário (opcional)</label>
                    <input
                        type="text"
                        name="veterinarian"
                        class="form-control"
                        value="{{ old('veterinarian') }}"
                    >
                    @error('veterinarian')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Observações --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">Observações</label>
                    <textarea
                        name="notes"
                        class="form-control"
                        rows="3"
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
                <button type="submit" class="btn btn-primary">
                    Salvar vacina
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
