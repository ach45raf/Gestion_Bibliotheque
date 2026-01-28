<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Utilisateur - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">
</head>
<body class="admin-bg-light">

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark mb-4 admin-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            🛠️ Admin Dashboard
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.livres.index') }}">📚 Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">📂 Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reservations.index') }}">📅 Réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.users.index') }}">👤 Utilisateurs</a>
                </li>
            </ul>

            <div class="d-flex">
                <a href="{{ route('home') }}" class="btn btn-outline-light me-2">🏠 Accueil Public</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-light">🚪 Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container admin-fade-in">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="admin-card admin-shadow-lg">
                <div class="admin-card-header" style="background: linear-gradient(135deg, var(--warning), #d97706);">
                    <h5 class="mb-0">✏️ Modifier l'Utilisateur</h5>
                </div>
                <div class="admin-card-body">
                    @if ($errors->any())
                        <div class="admin-alert admin-alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>⚠️ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="admin-form-label">Nom</label>
                            <input type="text" class="form-control admin-form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="admin-form-label">Email</label>
                            <input type="email" class="form-control admin-form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="admin-form-label">Rôle</label>
                            <select class="form-select admin-form-select" id="role" name="role" required>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-admin-secondary">⬅ Retour</a>
                            <button type="submit" class="btn btn-admin-warning">Mettre à Jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
