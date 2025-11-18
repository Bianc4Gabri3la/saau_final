@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Histórias de Adoção</h1>
    <div class="row">
        @forelse($stories as $story)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $story->title }}</h5>
                    <p>{{ Str::limit($story->story, 150) }}</p>
                    <p><small>Por: {{ $story->adopter_name }}</small></p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhuma história aprovada.</p>
        @endforelse
    </div>
</div>
@endsection
