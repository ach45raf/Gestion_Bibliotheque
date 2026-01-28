<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Catégories - Admin</title>
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
                    <a class="nav-link active" href="{{ route('admin.categories.index') }}">📂 Catégories</a>
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
        <h1 class="admin-page-title">📂 Gestion des Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-success">➕ Ajouter Catégorie</a>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="admin-card admin-shadow-lg">
        <div class="admin-card-header">
            <h5 class="mb-0">Liste des Catégories</h5>
        </div>
        <div class="admin-card-body">
            @if($categories->isEmpty())
                <p class="text-muted">Aucune catégorie trouvée.</p>
            @else
                <div class="list-group">
                    @foreach($categories as $categorie)
                        <div class="admin-list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">{{ $categorie->nom }}</span>
                            <div>
                                <a href="{{ route('admin.categories.edit', $categorie) }}" class="btn btn-sm btn-admin-warning me-2">✏️ Modifier</a>
                                <form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-admin-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">🗑 Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
