@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Editar Animal: {{ $animal->name }}</h1>
            <a href="{{ route('admin.animals.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.animals.update', $animal) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $animal->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="species" class="form-label">Espécie *</label>
                            <select class="form-select @error('species') is-invalid @enderror" id="species" name="species"
                                required>
                                <option value="">Selecione...</option>
                                <option value="cao" {{ old('species', $animal->species) == 'cao' ? 'selected' : '' }}>
                                    Cachorro</option>
                                <option value="gato" {{ old('species', $animal->species) == 'gato' ? 'selected' : '' }}>
                                    Gato</option>
                                <option value="outro" {{ old('species', $animal->species) == 'outro' ? 'selected' : '' }}>
                                    Outro</option>
                            </select>
                            @error('species')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="breed" class="form-label">Raça</label>
                            <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed"
                                name="breed" value="{{ old('breed', $animal->breed) }}">
                            @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Idade</label>
                            <select class="form-select @error('age') is-invalid @enderror" id="age" name="age">
                                <option value="">Selecione...</option>
                                <option value="filhote"
                                    {{ old('age', $animal->age ?? '') == 'filhote' ? 'selected' : '' }}>Filhote</option>
                                <option value="adulto" {{ old('age', $animal->age ?? '') == 'adulto' ? 'selected' : '' }}>
                                    Adulto</option>
                                <option value="idoso" {{ old('age', $animal->age ?? '') == 'idoso' ? 'selected' : '' }}>
                                    Idoso</option>
                            </select>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Sexo *</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                        required>
                        <option value="">Selecione...</option>
                        <option value="macho" {{ old('gender', $animal->gender) == 'macho' ? 'selected' : '' }}>Macho
                        </option>
                        <option value="femea" {{ old('gender', $animal->gender) == 'femea' ? 'selected' : '' }}>Fêmea
                        </option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="size" class="form-label">Porte</label>
                    <select class="form-select @error('size') is-invalid @enderror" id="size" name="size">
                        <option value="">Selecione...</option>
                        <option value="pequeno" {{ old('size', $animal->size) == 'pequeno' ? 'selected' : '' }}>Pequeno
                        </option>
                        <option value="medio" {{ old('size', $animal->size) == 'medio' ? 'selected' : '' }}>Médio</option>
                        <option value="grande" {{ old('size', $animal->size) == 'grande' ? 'selected' : '' }}>Grande
                        </option>
                    </select>
                    @error('size')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="color" class="form-label">Cor</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                        name="color" value="{{ old('color', $animal->color) }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3">{{ old('description', $animal->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="health_status" class="form-label">Estado de Saúde</label>
                <textarea class="form-control @error('health_status') is-invalid @enderror" id="health_status" name="health_status"
                    rows="2">{{ old('health_status', $animal->health_status) }}</textarea>
                @error('health_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Informações de Saúde</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="castrated" name="castrated"
                                value="1" {{ old('castrated', $animal->castrated) ? 'checked' : '' }}>
                            <label class="form-check-label" for="castrated">Castrado</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="vaccinated" name="vaccinated"
                                value="1" {{ old('vaccinated', $animal->vaccinated) ? 'checked' : '' }}>
                            <label class="form-check-label" for="vaccinated">Vacinado</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dewormed" name="dewormed"
                                value="1" {{ old('dewormed', $animal->dewormed) ? 'checked' : '' }}>
                            <label class="form-check-label" for="dewormed">Vermifugado</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="special_needs" name="special_needs"
                                value="1" {{ old('special_needs', $animal->special_needs) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special_needs">Necessidades Especiais</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status *</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="disponivel" {{ old('status', $animal->status) == 'disponivel' ? 'selected' : '' }}>
                        Disponível</option>
                    <option value="adotado" {{ old('status', $animal->status) == 'adotado' ? 'selected' : '' }}>Adotado
                    </option>
                    <option value="em_tratamento"
                        {{ old('status', $animal->status) == 'em_tratamento' ? 'selected' : '' }}>Em Tratamento</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($animal->photo_url)
                <div class="mb-3">
                    <label class="form-label">Foto Atual</label>
                    <div>
                        <img src="{{ $animal->photo_url }}" alt="{{ $animal->name }}"
                            style="max-width: 200px; border-radius: 8px;">
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label for="photo"
                    class="form-label">{{ $animal->photo_url ? 'Alterar Foto' : 'Adicionar Foto' }}</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                    name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
                <a href="{{ route('admin.animals.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
