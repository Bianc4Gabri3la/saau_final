@extends('layouts.admin')

@section('title', 'Relatórios')

@section('content')
<div class="container-fluid">
    <div class="page-header mb-4">
        <h1 class="page-title">Relatórios</h1>
    </div>

    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Gerar relatório</h2>
        </div>

        <form action="{{ route('admin.reports.generate') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Tipo --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de relatório</label>
                    <select name="type" class="form-control" required>
                        <option value="">Selecione...</option>
                        <option value="animals">Animais</option>
                        <option value="donations">Doações</option>
                        <option value="vaccines">Vacinas</option>
                        <option value="adoptions">Pedidos de Adoção</option>
                        <option value="raffles">Rifas</option>
                        <option value="events">Eventos</option>
                    </select>
                </div>

                {{-- Data inicial --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Data inicial (opcional)</label>
                    <input type="date" name="start_date" class="form-control">
                </div>

                {{-- Data final --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Data final (opcional)</label>
                    <input type="date" name="end_date" class="form-control">
                </div>

                {{-- Botão --}}
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-file-download me-1"></i> Gerar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
