@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Rifas</h1>
        <a href="{{ route('admin.raffles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Nova Rifa
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
                            <th>Prêmio</th>
                            <th>Valor do Bilhete</th>
                            <th>Total de Bilhetes</th>
                            <th>Data do Sorteio</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($raffles as $raffle)
                        <tr>
                            <td>
                                @if($raffle->image_url)
                                <img src="{{ $raffle->image_url }}" alt="{{ $raffle->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $raffle->title }}</td>
                            <td>{{ $raffle->prize ?? '-' }}</td>
                            <td>R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</td>
                            <td>{{ $raffle->total_tickets }}</td>
                            <td>{{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $raffle->status == 'ativa' ? 'success' : ($raffle->status == 'sorteada' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($raffle->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.raffles.edit', $raffle) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.raffles.destroy', $raffle) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta rifa?')">
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
                            <td colspan="8" class="text-center">Nenhuma rifa cadastrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $raffles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
