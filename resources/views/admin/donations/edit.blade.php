@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Atualizar Informações da Doação</h1>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Data + valor --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="date">Data *</label>
                        <input type="date"
                               id="date"
                               name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', $donation->date->format('Y-m-d')) }}"
                               required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="amount">Valor (R$) *</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               id="amount"
                               name="amount"
                               class="form-control @error('amount') is-invalid @enderror"
                               value="{{ old('amount', $donation->amount) }}"
                               required>
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tipo --}}
                <div class="mb-3">
                    <label class="form-label" for="type">Tipo de Doação *</label>
                    <select id="type"
                            name="type"
                            class="form-select @error('type') is-invalid @enderror"
                            required>
                        <option value="">Selecione...</option>
                        <option value="dinheiro"    {{ old('type', $donation->type) == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                        <option value="racao"       {{ old('type', $donation->type) == 'racao' ? 'selected' : '' }}>Ração</option>
                        <option value="medicamento" {{ old('type', $donation->type) == 'medicamento' ? 'selected' : '' }}>Medicamento</option>
                        <option value="outros"      {{ old('type', $donation->type) == 'outros' ? 'selected' : '' }}>Outros</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Nome do doador --}}
                <div class="mb-3">
                    <label class="form-label" for="donor_name">Nome do Doador</label>
                    <input type="text"
                           id="donor_name"
                           name="donor_name"
                           class="form-control @error('donor_name') is-invalid @enderror"
                           value="{{ old('donor_name', $donation->donor_name) }}">
                    @error('donor_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label" for="donor_email">E-mail do Doador</label>
                    <input type="email"
                           id="donor_email"
                           name="donor_email"
                           class="form-control @error('donor_email') is-invalid @enderror"
                           value="{{ old('donor_email', $donation->donor_email) }}">
                    @error('donor_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Observações --}}
                <div class="mb-3">
                    <label class="form-label" for="description">Observações</label>
                    <textarea id="description"
                              name="description"
                              rows="3"
                              class="form-control @error('notes') is-invalid @enderror">{{ old('description', $donation->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
