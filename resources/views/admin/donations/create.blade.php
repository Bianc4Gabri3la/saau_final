@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Registrar Nova Doação</h1>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.donations.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Data *</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" 
                               id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="amount" class="form-label">Valor (R$) *</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                               id="amount" name="amount" value="{{ old('amount') }}" required>
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="donation_type" class="form-label">Tipo de Doação *</label>
                    <select class="form-select @error('donation_type') is-invalid @enderror" 
                            id="donation_type" name="donation_type" required>
                        <option value="">Selecione...</option>
                        <option value="vakinha" {{ old('donation_type') == 'vakinha' ? 'selected' : '' }}>Vakinha</option>
                        <option value="pix" {{ old('donation_type') == 'pix' ? 'selected' : '' }}>PIX</option>
                        <option value="evento" {{ old('donation_type') == 'evento' ? 'selected' : '' }}>Evento</option>
                        <option value="rifa" {{ old('donation_type') == 'rifa' ? 'selected' : '' }}>Rifa</option>
                        <option value="doador_direto" {{ old('donation_type') == 'doador_direto' ? 'selected' : '' }}>Doador Direto</option>
                        <option value="outro" {{ old('donation_type') == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('donation_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="donor_name" class="form-label">Nome do Doador</label>
                    <input type="text" class="form-control @error('donor_name') is-invalid @enderror" 
                           id="donor_name" name="donor_name" value="{{ old('donor_name') }}" 
                           placeholder="Deixe em branco para anônimo">
                    @error('donor_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Observações</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Registrar Doação
                    </button>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
