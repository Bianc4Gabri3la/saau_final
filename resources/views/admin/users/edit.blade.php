@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Editar Usuário</h1>
</div>

<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Atualizar Informações do Usuário</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Deixe em branco para manter a senha atual. Mínimo de 6 caracteres.</small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Perfil *</label>
            <select class="form-select @error('role') is-invalid @enderror" 
                    id="role" name="role" required>
                <option value="">Selecione...</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="veterinario" {{ old('role', $user->role) == 'veterinario' ? 'selected' : '' }}>Veterinário</option>
                <option value="usuario" {{ old('role', $user->role) == 'usuario' ? 'selected' : '' }}>Usuário</option>
            </select>
            @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Atualizar Usuário
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
