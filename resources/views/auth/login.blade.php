<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Bibliothèque Numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2D5016;
            --secondary: #8B7355;
            --accent: #D4AF37;
            --success: #10b981;
            --bg-light: #F5F3F0;
            --text-dark: #2C2C2C;
            --border-color: #E0DDD9;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), #1a3a0d);
            color: white;
            padding: 30px 40px;
            text-align: center;
            border: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
            font-family: 'Playfair Display', serif;
        }

        .card-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 1rem;
        }

        .card-body {
            padding: 40px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
        }

        .form-floating label {
            padding: 12px 16px;
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), #1a3a0d);
            border: none;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 80, 22, 0.3);
            color: white;
        }

        .links {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .input-group-text {
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: var(--secondary-color);
        }

        .form-control:not(:first-child) {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .card-header {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="card-header">
            <h4>
                <i class="fas fa-sign-in-alt me-2"></i>
                Connexion
            </h4>
            <p>Accédez à votre compte Bibliothèque</p>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach>
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="votre@email.com" autocomplete="email" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Adresse email
                    </label>
                </div>

                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Mot de passe" autocomplete="current-password" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Mot de passe
                        </label>
                    </div>
                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </span>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-muted">
                            <small>Mot de passe oublié ?</small>
                        </a>
                    </div>
                @endif
            </form>

            <div class="links">
                <p class="mb-2">Pas encore de compte ?</p>
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus me-1"></i>Créer un compte
                </a>
            </div>
        </div>
    </div>
</div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>
