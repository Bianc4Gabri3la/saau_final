@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Como Funciona a Adoção</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-search fa-4x text-primary"></i>
                    </div>
                    <h3>1. Encontre seu Amigo</h3>
                    <p>Navegue pela nossa galeria de animais disponíveis. Cada um tem uma história única e está esperando por você!</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-file-alt fa-4x text-success"></i>
                    </div>
                    <h3>2. Preencha o Formulário</h3>
                    <p>Conte-nos sobre você, sua casa e por que deseja adotar. Queremos garantir o melhor match!</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-comments fa-4x text-info"></i>
                    </div>
                    <h3>3. Entrevista</h3>
                    <p>Nossa equipe entrará em contato para uma conversa amigável e tirar todas as suas dúvidas.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-home fa-4x text-warning"></i>
                    </div>
                    <h3>4. Visita ao Lar</h3>
                    <p>Realizamos uma visita para conhecer o ambiente onde o animal viverá e garantir sua segurança.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-4x text-success"></i>
                    </div>
                    <h3>5. Aprovação</h3>
                    <p>Aprovado o pedido, você assina o termo de adoção responsável e pode buscar seu novo amigo!</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-heart fa-4x text-danger"></i>
                    </div>
                    <h3>6. Bem-vindo ao Lar!</h3>
                    <p>Leve seu novo companheiro para casa e comece uma linda história de amor e companheirismo!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card bg-light">
                <div class="card-body">
                    <h3 class="text-center mb-4">O que você recebe na adoção?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Animal vacinado</li>
                                <li><i class="fas fa-check text-success"></i> Animal vermifugado</li>
                                <li><i class="fas fa-check text-success"></i> Animal castrado (quando possível)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Atestado de saúde</li>
                                <li><i class="fas fa-check text-success"></i> Carteira de vacinação</li>
                                <li><i class="fas fa-check text-success"></i> Suporte pós-adoção</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('animals') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-paw"></i> Ver Animais Disponíveis
        </a>
    </div>
</div>
@endsection
