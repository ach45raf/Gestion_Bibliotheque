@extends('layouts.app')

@section('title', 'Notre Catalogue - Bibliothèque Numérique')

@section('styles')
<style>
    /* Catalogue Hero Section */
    .catalogue-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: 50px;
        border-bottom: 3px solid var(--accent);
    }

    .catalogue-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }

    .catalogue-hero .lead {
        font-size: 1.2rem;
        opacity: 0.95;
    }

    /* Search & Filter Card */
    .search-filter-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(45, 80, 22, 0.15);
        margin-bottom: 50px;
        border-top: 4px solid var(--accent);
    }

    .search-filter-card .form-control,
    .search-filter-card .form-select {
        border-radius: 12px;
        border: 2px solid var(--border-color);
        padding: 0.85rem 1.2rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .search-filter-card .form-control:focus,
    .search-filter-card .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(45, 80, 22, 0.1);
    }

    .filter-label {
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
    }

    /* Book Cards */
    .book-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(45, 80, 22, 0.25);
        border-color: var(--accent);
    }

    .book-image-wrapper {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary), #1a3a0d);
    }

    .book-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .book-card:hover .book-image {
        transform: scale(1.05);
    }

    .book-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    .book-content {
        padding: 1.5rem;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.6rem;
    }

    .book-author {
        color: var(--secondary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .book-description {
        color: var(--secondary);
        font-size: 0.85rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1rem;
        min-height: 3.8rem;
    }

    /* Stats Section */
    .stats-section {
        background: white;
        padding: 40px 0;
        margin-bottom: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 5rem;
        color: var(--secondary);
        opacity: 0.5;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('content')

<!-- Hero Search Section -->
<section class="hero-search">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-book-open me-2"></i>
                Découvrez Notre Collection
            </h1>
            <p class="lead">Explorez {{ $stats['total_livres'] }} livres disponibles dans notre bibliothèque</p>
        </div>

        <div class="search-card">
            <form method="GET" action="{{ route('livres.index') }}" class="row g-3">
                <div class="col-lg-5">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-search me-1"></i>Rechercher par titre ou auteur
                    </label>
                    <input type="text" name="search" class="form-control form-control-lg"
                           placeholder="Ex: Victor Hugo, Les Misérables..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-lg-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-tags me-1"></i>Catégorie
                    </label>
                    <select name="categorie" class="form-select form-select-lg">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }} ({{ $categorie->livres()->count() }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book" style="color: var(--primary);"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_livres'] }}</div>
                    <div class="stat-label">Livres Disponibles</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users" style="color: var(--success);"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_users'] }}</div>
                    <div class="stat-label">Membres Actifs</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check" style="color: var(--warning);"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_reservations'] }}</div>
                    <div class="stat-label">Réservations</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tags" style="color: var(--info);"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_categories'] }}</div>
                    <div class="stat-label">Catégories</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Books Grid -->
<section class="py-5">
    <div class="container">
        @if(request('search') || request('categorie'))
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-filter me-2 text-primary"></i>
                        Résultats de recherche
                    </h3>
                    <a href="{{ route('livres.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Effacer les filtres
                    </a>
                </div>
            </div>
        @endif

        @if($livres->isEmpty())
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h3>Aucun livre trouvé</h3>
                <p class="text-muted mb-4">Essayez de modifier vos critères de recherche ou explorez toutes nos catégories.</p>
                <a href="{{ route('livres.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-book me-2"></i>Voir Tous les Livres
                </a>
            </div>
        @else
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">
                    <i class="fas fa-book-open me-2 text-primary"></i>
                    {{ $livres->total() }} livre(s) disponible(s)
                </h3>
                <div class="text-muted">
                    Page {{ $livres->currentPage() }} sur {{ $livres->lastPage() }}
                </div>
            </div>

            <div class="row g-4">
                @foreach($livres as $livre)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="book-card">
                            <div class="book-image-wrapper">
                                @php
                                    // Images par défaut pour les livres sans image
                                    $defaultImages = [
                                        'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=400&h=300&fit=crop',
                                    ];
                                    $randomImage = $defaultImages[array_rand($defaultImages)];
                                @endphp
                                
                                <img src="{{ $livre->image ? asset('storage/' . $livre->image) : $randomImage }}" 
                                     class="book-image" 
                                     alt="{{ $livre->titre }}" 
                                     loading="lazy">
                                
                                <div class="book-badge">
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        <i class="fas fa-tag me-1"></i>{{ $livre->categorie->nom ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="book-content">
                                <h5 class="book-title" title="{{ $livre->titre }}">
                                    {{ $livre->titre }}
                                </h5>
                                
                                <p class="book-author">
                                    <i class="fas fa-user-edit me-1"></i>{{ $livre->auteur }}
                                </p>

                                @if($livre->description)
                                    <p class="book-description">
                                        {{ $livre->description }}
                                    </p>
                                @else
                                    <p class="book-description text-muted fst-italic">
                                        Aucune description disponible pour ce livre.
                                    </p>
                                @endif

                                <div class="d-grid gap-2">
                                    @auth
                                        @if(auth()->user()->role === 'user')
                                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary">
                                                <i class="fas fa-calendar-plus me-2"></i>Réserver
                                            </a>
                                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-eye me-2"></i>Détails
                                            </a>
                                        @else
                                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-eye me-2"></i>Voir Détails
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary">
                                            <i class="fas fa-eye me-2"></i>Voir Détails
                                        </a>
                                        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-sign-in-alt me-2"></i>Connectez-vous
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $livres->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
