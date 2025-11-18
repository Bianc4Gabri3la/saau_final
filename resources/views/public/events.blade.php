@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Eventos</h1>
    <div class="row">
        @forelse($events as $event)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $event->title }}</h5>
                    <p>{{ $event->description }}</p>
                    <p><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhum evento ativo.</p>
        @endforelse
    </div>
</div>
@endsection
