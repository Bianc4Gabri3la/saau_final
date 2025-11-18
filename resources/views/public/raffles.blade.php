@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Rifas</h1>
    <div class="row">
        @forelse($raffles as $raffle)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $raffle->title }}</h5>
                    <p>{{ $raffle->description }}</p>
                    <p><strong>Prêmio:</strong> {{ $raffle->prize }}</p>
                    <p><strong>Valor:</strong> R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhuma rifa ativa.</p>
        @endforelse
    </div>
</div>
@endsection
