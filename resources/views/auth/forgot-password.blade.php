<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mot de passe oublié - Bibliothèque Numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .forgot-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .forgot-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            color: white;
            padding: 30px 40px;
            text-align: center;
            border: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
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
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-floating label {
            padding: 12px 16px;
            font-weight: 500;
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            border: none;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .links {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        @media (max-width: 576px) {
            .forgot-container {
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

<div class="forgot-container">
    <div class="forgot-card">
        <div class="card-header">
            <h4>
                <i class="fas fa-key me-2"></i>
                Mot de passe oublié
            </h4>
            <p>Réinitialisez votre mot de passe en toute sécurité</p>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach>
                    </ul>
                </div>
            @endif

            <p class="text-muted mb-4">
                Saisissez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="votre@email.com" value="{{ old('email') }}" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Adresse email
                    </label>
                </div>

                <button type="submit" class="btn btn-reset mb-3">
                    <i class="fas fa-paper-plane me-2"></i>Envoyer le lien de réinitialisation
                </button>
            </form>

            <div class="links">
                <p class="mb-2">Vous vous souvenez de votre mot de passe ?</p>
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>Retour à la connexion
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>