@extends('layouts.app')

@section('title', 'Dashboard Admin - Bibliothèque Numérique')

@section('content')
<style>
    /* Dashboard Admin Professional Styling */
    .admin-header {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        color: white;
        padding: 60px 0;
        border-bottom: 3px solid var(--accent);
    }

    .admin-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
    }

    .admin-header .lead {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .stat-box {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border-left: 5px solid var(--primary);
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(45, 80, 22, 0.2);
        border-left-color: var(--accent);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        font-family: 'Playfair Display', serif;
        margin: 0.5rem 0;
    }

    .stat-label {
        color: var(--secondary);
        font-size: 0.95rem;
        font-weight: 600;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .action-btn-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .action-btn-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(45, 80, 22, 0.2);
        border-color: var(--accent);
        text-decoration: none;
        color: inherit;
    }

    .action-btn-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .action-btn-card:hover .action-btn-icon {
        color: var(--accent);
        transform: scale(1.15);
        transition: all 0.3s ease;
    }

    .action-btn-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }

    .action-btn-desc {
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .recent-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border-top: 3px solid var(--primary);
    }

    .recent-section h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 2rem;
        font-family: 'Playfair Display', serif;
        color: var(--text-dark);
    }

    .table {
        color: var(--text-dark);
    }

    .table thead th {
        background: linear-gradient(135deg, var(--primary), #1a3a0d);
        color: white;
        border: none;
        font-weight: 700;
        padding: 1.2rem;
    }

    .table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: linear-gradient(90deg, rgba(45, 80, 22, 0.05), transparent);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
    }
</style>

<!-- Admin Header -->
<section class="admin-header">
    <div class="container">
        <h1><i class="fas fa-chart-line me-3" style="color: var(--accent);"></i>Dashboard Administrateur</h1>
        <p class="lead mb-0">Bienvenue {{ auth()->user()->name }}, voici l'aperçu de votre bibliothèque</p>
    </div>
</section>

<!-- Statistics Cards -->
<div class="container py-5">
    <div class="dashboard-grid">
        <div class="stat-box">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-number">{{ $totalLivres }}</div>
            <div class="stat-label">Livres en Catalogue</div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fas fa-users" style="color: var(--success);"></i>
            </div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Utilisateurs Enregistrés</div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fas fa-calendar-check" style="color: var(--warning);"></i>
            </div>
            <div class="stat-number">{{ $totalReservations }}</div>
            <div class="stat-label">Réservations</div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fas fa-tags" style="color: var(--info);"></i>
            </div>
            <div class="stat-number">{{ $totalCategories }}</div>
            <div class="stat-label">Catégories</div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('admin.livres.create') }}" class="action-btn-card">
            <div class="action-btn-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="action-btn-title">Ajouter un Livre</div>
            <div class="action-btn-desc">Ajouter une nouvelle publication</div>
        </a>

        <a href="{{ route('admin.livres.index') }}" class="action-btn-card">
            <div class="action-btn-icon">
                <i class="fas fa-list"></i>
            </div>
            <div class="action-btn-title">Gestion des Livres</div>
            <div class="action-btn-desc">Éditer et supprimer des livres</div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="action-btn-card">
            <div class="action-btn-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="action-btn-title">Gestion des Utilisateurs</div>
            <div class="action-btn-desc">Gérer les comptes membres</div>
        </a>

        <a href="{{ route('admin.reservations.index') }}" class="action-btn-card">
            <div class="action-btn-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="action-btn-title">Gestion des Réservations</div>
            <div class="action-btn-desc">Approuver ou refuser les réservations</div>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="action-btn-card">
            <div class="action-btn-icon">
                <i class="fas fa-folder-plus"></i>
            </div>
            <div class="action-btn-title">Catégories</div>
            <div class="action-btn-desc">Créer et organiser les catégories</div>
        </a>
    </div>

    <!-- Recent Activities -->
    <div class="recent-section">
        <h3><i class="fas fa-history me-2"></i>Activités Récentes</h3>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Récupérer les dernières réservations
                        $recentReservations = \App\Models\Reservation::with(['user', 'livre'])
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp

                    @forelse($recentReservations as $reservation)
                        <tr>
                            <td><i class="fas fa-calendar-check" style="color: var(--primary);"></i></td>
                            <td>
                                <strong>{{ $reservation->user->name }}</strong> a réservé 
                                <strong>{{ $reservation->livre->titre }}</strong>
                            </td>
                            <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($reservation->etat === 'valide')
                                    <span class="badge bg-success">Validé</span>
                                @elseif($reservation->etat === 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @else
                                    <span class="badge bg-danger">Annulé</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Aucune activité récente
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
