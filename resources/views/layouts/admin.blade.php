<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel Admin - SAAU')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }
        
        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-logo {
            height: 50px;
            margin-bottom: 8px;
        }
        
        .sidebar-user {
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            border-left-color: #F5B800;
        }
        
        .menu-item.active {
            background: rgba(245,184,0,0.15);
            color: #F5B800;
            border-left-color: #F5B800;
        }
        
        .menu-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
        }
        
        .menu-item span {
            font-weight: 500;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px 20px;
            background: rgba(231,76,60,0.1);
            border: 1px solid rgba(231,76,60,0.3);
            color: #e74c3c;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: rgba(231,76,60,0.2);
        }
        
        .logout-btn i {
            margin-right: 10px;
        }
        
        /* Main Content */
        .admin-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 30px;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }
        
        .stat-card.blue { border-left-color: #3498db; }
        .stat-card.green { border-left-color: #2ecc71; }
        .stat-card.purple { border-left-color: #9b59b6; }
        .stat-card.orange { border-left-color: #e67e22; }
        .stat-card.red { border-left-color: #e74c3c; }
        .stat-card.yellow { border-left-color: #f39c12; }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 12px;
        }
        
        .stat-card.blue .stat-icon { background: #3498db; }
        .stat-card.green .stat-icon { background: #2ecc71; }
        .stat-card.purple .stat-icon { background: #9b59b6; }
        .stat-card.orange .stat-icon { background: #e67e22; }
        .stat-card.red .stat-icon { background: #e74c3c; }
        .stat-card.yellow .stat-icon { background: #f39c12; }
        
        .stat-label {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 4px;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }
        
        /* Content Card */
        .content-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f5f5f5;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }
        
        /* Buttons */
        .btn-primary {
            background: #F5B800;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #d9a500;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245,184,0,0.3);
        }
        
        .btn-success {
            background: #2ecc71;
            border: none;
        }
        
        .btn-success:hover {
            background: #27ae60;
        }
        
        .btn-danger {
            background: #e74c3c;
            border: none;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        /* Table */
        .table {
            margin: 0;
        }
        
        .table thead th {
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            padding: 12px;
        }
        
        .table tbody tr {
            transition: background 0.2s;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .table tbody td {
            padding: 12px;
            vertical-align: middle;
        }
        
        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo-saau.png') }}" alt="SAAU" class="sidebar-logo">
            <div class="sidebar-user">{{ auth()->user()->name }}</div>
        </div>
        
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.animals.index') }}" class="menu-item {{ request()->routeIs('admin.animals.*') ? 'active' : '' }}">
                <i class="fas fa-paw"></i>
                <span>Animais</span>
            </a>
            <a href="{{ route('admin.vaccines.index') }}" class="menu-item {{ request()->routeIs('admin.vaccines.*') ? 'active' : '' }}">
                <i class="fas fa-syringe"></i>
                <span>Vacinas</span>
            </a>
            <a href="{{ route('admin.raffles.index') }}" class="menu-item {{ request()->routeIs('admin.raffles.*') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt"></i>
                <span>Rifas</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="menu-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i>
                <span>Eventos</span>
            </a>
            <a href="{{ route('admin.stories.index') }}" class="menu-item {{ request()->routeIs('admin.stories.*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i>
                <span>Histórias</span>
            </a>
            <a href="{{ route('admin.donations.index') }}" class="menu-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                <i class="fas fa-dollar-sign"></i>
                <span>Doações</span>
            </a>
            <a href="{{ route('admin.adoption-requests.index') }}" class="menu-item {{ request()->routeIs('admin.adoption-requests.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>Pedidos de Adoção</span>
            </a>

            {{-- NOVO ITEM: RELATÓRIOS --}}
            <a href="{{ route('admin.reports.index') }}" class="menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Relatórios</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Usuários</span>
            </a>
            @endif
        </nav>
        
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @yield('content')
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
