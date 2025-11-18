@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Pedidos de Adoção</h1>

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
                            <th>Data</th>
                            <th>Animal</th>
                            <th>Adotante</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        <tr>
                            <td>{{ $request->created_at->format('d/m/Y') }}</td>
                            <td>{{ $request->animal->name ?? 'N/A' }}</td>
                            <td>{{ $request->adopter_name }}</td>
                            <td>{{ $request->adopter_email }}</td>
                            <td>{{ $request->adopter_phone }}</td>
                            <td>
                                <span class="badge bg-{{ $request->status == 'pendente' ? 'warning' : ($request->status == 'aprovado' ? 'success' : 'danger') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.adoption-requests.show', $request) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.adoption-requests.destroy', $request) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
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
                            <td colspan="7" class="text-center">Nenhum pedido de adoção.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
