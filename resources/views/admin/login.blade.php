<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SAAU</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            gap: 8px;
        }
        
        .login-logo-text {
            font-size: 48px;
            font-weight: 900;
            color: white;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .login-logo i {
            font-size: 40px;
            color: white;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));
        }
        
        .login-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.8);
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #F5B800;
            box-shadow: 0 0 0 0.2rem rgba(245,184,0,0.15);
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }
        
        .form-check-input:checked {
            background-color: #F5B800;
            border-color: #F5B800;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #F5B800 0%, #d9a500 100%);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(245,184,0,0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245,184,0,0.4);
            background: linear-gradient(135deg, #d9a500 0%, #F5B800 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
        }
        
        .alert-danger {
            background: #fee;
            color: #c33;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider span {
            padding: 0 15px;
            color: #95a5a6;
            font-size: 13px;
        }
        
        .back-link {
            text-align: center;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s;
        }
        
        .back-link:hover {
            color: #2c3e50;
        }
        
        .security-notice {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px 16px;
            text-align: center;
            font-size: 13px;
            color: #7f8c8d;
        }
        
        .security-notice i {
            color: #F5B800;
            margin-right: 6px;
        }
        
        @media (max-width: 576px) {
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-paw"></i>
                    <span class="login-logo-text">SAAU</span>
                </div>
                <h1 class="login-title">Painel Administrativo</h1>
                <p class="login-subtitle">Sistema de Adoção de Animais de Umuarama</p>
            </div>
            
            <div class="login-body">
                @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i> E-mail
                        </label>
                        <input id="email" 
                               type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="seu@email.com"
                               required 
                               autocomplete="email" 
                               autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i> Senha
                        </label>
                        <input id="password" 
                               type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               placeholder="••••••••"
                               required 
                               autocomplete="current-password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="remember" 
                               id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Manter-me conectado
                        </label>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i> Acessar Painel
                        </button>
                    </div>
                    
                    <div class="security-notice mb-3">
                        <i class="fas fa-shield-alt"></i>
                        Acesso restrito a administradores e veterinários
                    </div>
                    
                    <div class="divider">
                        <span>ou</span>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="back-link">
                            <i class="fas fa-arrow-left"></i>
                            Voltar para o site
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
