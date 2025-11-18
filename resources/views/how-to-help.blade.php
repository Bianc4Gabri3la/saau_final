@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Como Você Pode Ajudar</h1>

    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <p class="lead">Existem várias formas de contribuir com a SAAU e fazer a diferença na vida dos animais abandonados de Umuarama. Escolha a que mais combina com você!</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-heart text-danger"></i> Adote</h3>
                    <p>A forma mais direta de ajudar é dando um lar para um animal. Cada adoção salva uma vida e abre espaço para resgatarmos mais animais.</p>
                    <a href="{{ route('animals') }}" class="btn btn-primary">Ver Animais</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-hand-holding-usd text-success"></i> Doe</h3>
                    <p>Contribuições financeiras nos ajudam a manter os cuidados veterinários, alimentação e estrutura do abrigo.</p>
                    <p><strong>PIX:</strong> saau@umuarama.org.br</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-gift text-info"></i> Doe Materiais</h3>
                    <p>Aceitamos doações de:</p>
                    <ul>
                        <li>Ração para cães e gatos</li>
                        <li>Medicamentos veterinários</li>
                        <li>Cobertores e caminhas</li>
                        <li>Brinquedos</li>
                        <li>Produtos de limpeza</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-hands-helping text-warning"></i> Seja Voluntário</h3>
                    <p>Precisamos de ajuda com:</p>
                    <ul>
                        <li>Passeios com os animais</li>
                        <li>Limpeza e manutenção</li>
                        <li>Eventos e feiras de adoção</li>
                        <li>Divulgação nas redes sociais</li>
                        <li>Transporte de animais</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-paw text-primary"></i> Apadrinhe</h3>
                    <p>Não pode adotar mas quer ajudar um animal específico? Apadrinhe! Você contribui mensalmente com os custos de cuidado de um animal escolhido.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3><i class="fas fa-share-alt text-secondary"></i> Divulgue</h3>
                    <p>Compartilhe nossos animais nas redes sociais! Quanto mais pessoas souberem, maiores as chances de adoção.</p>
                    <p>
                        <a href="#" class="btn btn-sm btn-primary"><i class="fab fa-facebook"></i> Facebook</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fab fa-instagram"></i> Instagram</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h3>Participe de Nossas Rifas e Eventos!</h3>
                    <p>Toda a renda é revertida para os cuidados dos animais. Confira nossas rifas ativas e eventos programados!</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('raffles') }}" class="btn btn-dark">Ver Rifas</a>
                        <a href="{{ route('events') }}" class="btn btn-dark">Ver Eventos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center mb-4">Entre em Contato</h4>
                    <p class="text-center">Quer saber mais sobre como ajudar? Fale conosco!</p>
                    <div class="text-center">
                        <p>
                            <i class="fas fa-envelope"></i> contato@saau.org.br<br>
                            <i class="fas fa-phone"></i> (44) 9999-9999<br>
                            <i class="fab fa-instagram"></i> @saau_umuarama<br>
                            <i class="fas fa-map-marker-alt"></i> Rua das Flores, 123 - Umuarama/PR
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
