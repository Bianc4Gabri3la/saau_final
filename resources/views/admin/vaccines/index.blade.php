@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Vacinas</h1>
        <a href="{{ route('admin.vaccines.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Nova Vacina
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
                            <th>Animal</th>
                            <th>Tipo de Vacina</th>
                            <th>Data de Aplicação</th>
                            <th>Próxima Dose</th>
                            <th>Observações</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vaccines as $vaccine)
                        <tr>
                            <td>{{ $vaccine->animal->name ?? 'N/A' }}</td>
                            <td>{{ $vaccine->vaccine_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($vaccine->application_date)->format('d/m/Y') }}</td>
                            <td>
                                @if($vaccine->next_dose_date)
                                {{ \Carbon\Carbon::parse($vaccine->next_dose_date)->format('d/m/Y') }}
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $vaccine->notes ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.vaccines.edit', $vaccine->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.vaccines.destroy', $vaccine) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este registro?')">
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
                            <td colspan="6" class="text-center">Nenhuma vacina registrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $vaccines->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
