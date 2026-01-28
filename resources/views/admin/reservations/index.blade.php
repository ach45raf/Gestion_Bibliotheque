<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Réservations - Admin</title>
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
                    <a class="nav-link active" href="{{ route('admin.reservations.index') }}">📅 Réservations</a>
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
        <h1 class="admin-page-title">📅 Gestion des Réservations</h1>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="admin-card admin-shadow-lg">
        <div class="admin-card-header">
            <h5 class="mb-0">Liste des Réservations</h5>
        </div>
        <div class="admin-card-body">
            @if($reservations->isEmpty())
                <p class="text-muted">Aucune réservation trouvée.</p>
            @else
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Livre</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>État</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>{{ $reservation->livre->titre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($reservation->etat === 'en_attente')
                                            <span class="admin-badge admin-badge-warning">⏳ En attente</span>
                                        @elseif($reservation->etat === 'valide')
                                            <span class="admin-badge admin-badge-success">✅ Validée</span>
                                        @else
                                            <span class="admin-badge admin-badge-secondary">❌ Annulée</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reservation->etat === 'en_attente')
                                            <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="etat" value="valide">
                                                <button type="submit" class="btn btn-sm btn-admin-success me-1">✅ Valider</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="etat" value="annule">
                                                <button type="submit" class="btn btn-sm btn-admin-outline-danger">❌ Annuler</button>
                                            </form>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
