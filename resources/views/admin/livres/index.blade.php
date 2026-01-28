<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Livres - Admin</title>
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
                    <a class="nav-link active" href="{{ route('admin.livres.index') }}">📚 Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">📂 Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reservations.index') }}">📅 Réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">👤 Utilisateurs</a>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="admin-page-title">📚 Gestion des Livres</h1>
        <a href="{{ route('admin.livres.create') }}" class="btn btn-admin-success">➕ Ajouter un Livre</a>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($livres as $livre)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="admin-card h-100">
                    @if($livre->image)
                        <img src="{{ asset('storage/' . $livre->image) }}" class="card-img-top admin-img-thumbnail" alt="{{ $livre->titre }}" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">📖 Pas d'image</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $livre->titre }}</h5>
                        <p class="card-text">
                            <strong>Auteur:</strong> {{ $livre->auteur }}<br>
                            <strong>Catégorie:</strong> {{ $livre->categorie->nom }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.livres.edit', $livre) }}" class="btn btn-admin-warning btn-sm me-2">✏️ Modifier</a>
                            <form action="{{ route('admin.livres.destroy', $livre) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-admin-outline-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">🗑 Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="admin-alert admin-alert-info text-center">
                    📚 Aucun livre trouvé.
                </div>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
