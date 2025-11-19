@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciar Doações</h1>
            <a href="{{ route('admin.donations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Registrar Nova Doação
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body text-center">
                <h3 class="text-success">Total Arrecadado</h3>
                <h1 class="display-4">R$ {{ number_format($total, 2, ',', '.') }}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Doador</th>
                                <th>E-mail</th>
                                <th>Observações</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    {{-- Data --}}
                                    <td>{{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</td>

                                    {{-- Valor --}}
                                    <td class="text-success fw-bold">
                                        R$ {{ number_format($donation->amount, 2, ',', '.') }}
                                    </td>

                                    {{-- Tipo --}}
                                    <td>
                                        <span class="badge bg-info">
                                            {{ ucfirst($donation->type) }}
                                        </span>
                                    </td>

                                    {{-- Doador --}}
                                    <td>{{ $donation->donor_name ?? 'Anônimo' }}</td>

                                    {{-- E-mail --}}
                                    <td>{{ $donation->donor_email ?? '-' }}</td>

                                    {{-- Observações --}}
                                    <td>{{ $donation->description ?? '-' }}</td>

                                    {{-- Ações --}}
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.donations.edit', $donation->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Tem certeza que deseja remover esta doação?')">
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
                                    <td colspan="7" class="text-center">
                                        Nenhuma doação registrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
