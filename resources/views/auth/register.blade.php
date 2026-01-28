<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Bibliothèque Numérique</title>
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

        .register-container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }

        .register-card {
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

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
        }

        .form-floating label {
            padding: 12px 16px;
            font-weight: 500;
        }

        .btn-register {
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

        .btn-register:hover {
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
            color: var(--secondary);
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
            .register-container {
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

<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <h4>
                <i class="fas fa-user-plus me-2"></i>
                Inscription
            </h4>
            <p>Créez votre compte Bibliothèque</p>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Votre nom complet" autocomplete="name" required>
                    <label for="name">
                        <i class="fas fa-user me-2"></i>Nom complet
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="sexe" name="sexe" autocomplete="sex" required>
                        <option value="">-- Choisir --</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                        <option value="other">Pas D'autre</option>
                    </select>
                    <label for="sexe">
                        <i class="fas fa-venus-mars me-2"></i>Sexe
                    </label>
                </div>

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
                               placeholder="Mot de passe" autocomplete="new-password" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Mot de passe
                        </label>
                    </div>
                    <button type="button" class="input-group-text password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </button>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password_confirmation"
                           name="password_confirmation" placeholder="Confirmer le mot de passe" autocomplete="new-password" required>
                    <label for="password_confirmation">
                        <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
                    </label>
                </div>

                <button type="submit" class="btn btn-register mb-3">
                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                </button>
            </form>

            <div class="links">
                <p class="mb-2">Déjà un compte ?</p>
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>Se connecter
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
