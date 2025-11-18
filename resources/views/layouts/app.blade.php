<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SAAU - Sociedade de Amparo aos Animais de Umuarama')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- VERSAO ATUALIZADA 2025-11-17 13:15 -->
    <style>
        :root {
            --saau-yellow: #FDB913;
            --saau-orange: #FF8C42;
            --saau-brown: #8B4513;
            --saau-green: #4A7C59;
            --saau-blue: #5B9BD5;
            --saau-light: #F8F9FA;
            --saau-dark: #2C3E50;
        }
        html, body { 
            height: 100%; 
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        body {
            display: flex;
            flex-direction: column;
            background-color: var(--saau-light);
        }
        #main-content {
            flex: 1 0 auto;
        }
        .navbar { 
            background: linear-gradient(135deg, #FF8C42 0%, #FDB913 50%, #FF8C42 100%); 
            position: static !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand img { 
            height: 70px !important;
            max-height: 70px !important;
            width: auto !important;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
        }
        .btn-primary { 
            background-color: #FF8C42; 
            border-color: #FF8C42; 
            transition: all 0.3s;
        }
        .btn-primary:hover { 
            background-color: #E67A31; 
            border-color: #E67A31;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .text-primary { color: var(--saau-orange) !important; }
        .bg-primary { background-color: var(--saau-orange) !important; }
        .hero { 
            background: linear-gradient(135deg, rgba(255,140,66,0.95) 0%, rgba(253,185,19,0.95) 50%, rgba(255,140,66,0.95) 100%); 
            padding: 80px 0; 
            color: white; 
            text-align: center;
            box-shadow: inset 0 0 50px rgba(0,0,0,0.1);
        }
        .card { 
            transition: all 0.3s; 
            border: none; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 12px;
            overflow: hidden;
        }
        .card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 12px 24px rgba(255,140,66,0.2);
        }
        footer { 
            flex-shrink: 0;
            background-color: var(--saau-brown); 
            color: white; 
            padding: 40px 0; 
            margin-top: auto;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-saau.png') }}" alt="SAAU">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('animals') }}">Adotar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('events') }}">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('raffles') }}">Rifas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('stories.index') }}">Histórias</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('how-it-works') }}">Como Funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('how-to-help') }}">Como Ajudar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    @auth
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'vet')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield"></i> Painel Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.animals.index') }}"><i class="fas fa-paw"></i> Animais</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.adoption-requests.index') }}"><i class="fas fa-heart"></i> Pedidos de Adoção</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.events.index') }}"><i class="fas fa-calendar"></i> Eventos</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.raffles.index') }}"><i class="fas fa-ticket-alt"></i> Rifas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.vaccines.index') }}"><i class="fas fa-syringe"></i> Vacinas</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.donations.index') }}"><i class="fas fa-hand-holding-heart"></i> Doações</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Usuários</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.stories.index') }}"><i class="fas fa-book-heart"></i> Histórias</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-header">Relatórios</li>
                                <li><a class="dropdown-item" href="{{ route('admin.reports.index') }}"><i class="fas fa-file-csv"></i> Animais (CSV)</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reports.index') }}"><i class="fas fa-file-csv"></i> Doações (CSV)</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reports.index') }}"><i class="fas fa-file-csv"></i> Vacinas (CSV)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ auth()->user()->role === 'admin' || auth()->user()->role === 'vet' ? route('admin.logout') : route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Entrar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div id="main-content">
        @yield('content')
    </div>

    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row mb-4">
                <!-- Logo e Sobre -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-warning mb-3"><i class="fas fa-paw"></i> SAAU</h5>
                    <p class="text-light small">
                        A SAAU - Sociedade de Amparo aos Animais de Umuarama atua no resgate e encaminhamento de cães e gatos para adoção responsável, promovendo o bem-estar animal em nossa região.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-warning mb-3">Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Início</a></li>
                        <li class="mb-2"><a href="{{ route('animals') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Quero adotar</a></li>
                        <li class="mb-2"><a href="{{ route('raffles') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Rifas solidárias</a></li>
                        <li class="mb-2"><a href="{{ route('events') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Eventos</a></li>
                        <li class="mb-2"><a href="{{ route('how-to-help') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Como ajudar</a></li>
                        <li class="mb-2"><a href="{{ route('stories.index') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> Histórias de adoção</a></li>
                        <li class="mb-2"><a href="{{ route('faq') }}" class="text-light text-decoration-none small"><i class="fas fa-chevron-right text-warning"></i> FAQ</a></li>
                    </ul>
                </div>

                <!-- Contato -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-warning mb-3">Contato</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            <span class="text-light small">
                                Rua Exemplo, 123<br>
                                <span class="ms-4">Umuarama - PR, 87500-000</span>
                            </span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope text-warning me-2"></i>
                            <a href="mailto:contato@saau.org.br" class="text-light text-decoration-none small">contato@saau.org.br</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-warning me-2"></i>
                            <a href="tel:+554430001234" class="text-light text-decoration-none small">(44) 3000-1234</a>
                        </li>
                    </ul>
                </div>

                <!-- Redes Sociais -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-warning mb-3">Redes Sociais</h5>
                    <p class="text-light small mb-3">Siga-nos nas redes sociais e fique por dentro das novidades!</p>
                    <div class="d-flex gap-2">
                        <a href="https://facebook.com/saau" target="_blank" rel="noopener noreferrer" 
                           class="btn btn-warning btn-sm rounded-circle" style="width: 40px; height: 40px;" 
                           aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com/saau" target="_blank" rel="noopener noreferrer" 
                           class="btn btn-warning btn-sm rounded-circle" style="width: 40px; height: 40px;" 
                           aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/5544999999999" target="_blank" rel="noopener noreferrer" 
                           class="btn btn-warning btn-sm rounded-circle" style="width: 40px; height: 40px;" 
                           aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="border-secondary">

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-light small mb-0">
                        <i class="far fa-copyright"></i> {{ date('Y') }} SAAU - Sociedade de Amparo aos Animais de Umuarama. Todos os direitos reservados.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-light text-decoration-none small me-3">Termos de Uso</a>
                    <span class="text-secondary">•</span>
                    <a href="#" class="text-light text-decoration-none small ms-3">Política de Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
