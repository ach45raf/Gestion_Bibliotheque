@extends('layouts.app')

@section('title', 'Accueil - Bibliothèque Numérique')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 700px;
        height: 700px;
        background: rgba(212, 175, 55, 0.1);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: rgba(212, 175, 55, 0.08);
        border-radius: 50%;
        animation: float 10s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(30px) rotate(180deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-image {
        position: relative;
        z-index: 2;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .hero-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .hero-section .lead {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        line-height: 1.8;
    }

    /* Section Titles */
    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3rem;
        position: relative;
        display: inline-block;
        font-family: 'Playfair Display', serif;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 80px;
        height: 5px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 3px;
    }

    /* Book Grid */
    .book-item {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(45, 80, 22, 0.08);
        transition: all 0.4s ease;
        border: 1px solid var(--border-color);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(45, 80, 22, 0.2);
        border-color: var(--accent);
    }

    .book-image-wrapper {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary), #1a3a0d);
    }

    .book-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .book-item:hover .book-image {
        transform: scale(1.08);
    }

    .book-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }

    .book-info {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.6rem;
        font-family: 'Playfair Display', serif;
    }

    .book-author {
        color: var(--secondary);
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        font-weight: 500;
    }

    .book-category {
        display: inline-block;
        background: linear-gradient(135deg, rgba(45, 80, 22, 0.1), rgba(139, 115, 85, 0.1));
        color: var(--primary);
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
    }

    .book-bottom {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    /* Categories Section */
    .category-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(45, 80, 22, 0.08);
        transition: all 0.4s ease;
        cursor: pointer;
        border: 1px solid var(--border-color);
        text-decoration: none !important;
        color: inherit;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(45, 80, 22, 0.2);
        border-color: var(--accent);
    }

    .category-icon {
        font-size: 3.5rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .category-card:hover .category-icon {
        transform: scale(1.15) rotate(-10deg);
    }

    .category-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }

    .category-count {
        color: var(--secondary);
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Stats Section */
    .stats-section {
        background: white;
        padding: 60px 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        padding: 80px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: rgba(212, 175, 55, 0.08);
        border-radius: 50%;
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }

    .cta-section h2 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }

    .cta-section .lead {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }

    .btn-cta {
        background: white;
        color: var(--primary);
        border: 3px solid white;
        padding: 14px 40px;
        font-weight: 700;
        font-size: 1.15rem;
        transition: all 0.3s ease;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-cta:hover {
        background: var(--accent);
        color: white;
        border-color: var(--accent);
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
    }

    /* Nouvelles Section */
    .new-badge-ribbon {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, var(--accent), #c9a961);
        color: var(--text-dark);
        padding: 0.6rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }

    /* Popular Badge */
    .popular-badge-ribbon {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 0.6rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Available/Reserved Status */
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .status-available {
        background: linear-gradient(135deg, var(--success), #059669);
        color: white;
    }

    .status-reserved {
        background: linear-gradient(135deg, var(--warning), #d97706);
        color: white;
    }

    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .book-item {
        animation: slideInUp 0.6s ease;
    }

    .category-card {
        animation: slideInUp 0.6s ease;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .cta-section h2 {
            font-size: 2rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 hero-content">
                <h1>
                    <i class="fas fa-book-reader me-3" style="color: var(--accent);"></i>
                    @auth
                        @if(auth()->user()->sexe === 'homme')
                            Bienvenue Monsieur
                        @elseif(auth()->user()->sexe === 'femme')
                            Bienvenue Madame
                        @else
                            Bienvenue
                        @endif
                        <br>{{ auth()->user()->name }}
                    @else
                        Bienvenue à la<br>Bibliothèque Numérique
                    @endauth
                </h1>
                <p class="lead">
                    Explorez notre collection exceptionnelle de livres, réservez en ligne 24/7, et rejoignez une communauté passionnée de lecteurs du monde entier.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>S'Inscrire
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('livres.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-book-open me-2"></i>Explorer les Livres
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user me-2"></i>Mon Profil
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bibliothèque Élégante" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Livres Populaires Section -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">⭐ Top Livres Populaires</h2>

        @if($populaires && $populaires->count() > 0)
            <div class="row g-4">
                @foreach($populaires->take(6) as $livre)
                    <div class="col-lg-4 col-md-6">
                        <div class="book-item">
                            <div class="book-image-wrapper">
                                <img src="{{ $livre->image ? asset('storage/' . $livre->image) : 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=400&h=300&fit=crop' }}" 
                                     class="book-image" alt="{{ $livre->titre }}" loading="lazy">
                                <div class="book-badge">
                                    <span class="popular-badge-ribbon">
                                        <i class="fas fa-star me-1"></i>POPULAIRE
                                    </span>
                                </div>
                            </div>
                            <div class="book-info">
                                <h5 class="book-title">{{ $livre->titre }}</h5>
                                <p class="book-author"><i class="fas fa-feather me-2"></i>{{ $livre->auteur }}</p>
                                <span class="book-category">{{ $livre->categorie->nom ?? 'Général' }}</span>
                                <div class="book-bottom">
                                    <div class="d-flex gap-2 mb-2">
                                        @php
                                            $reserved = $livre->reservations()->where('etat', 'valide')->count();
                                            $isAvailable = $reserved === 0;
                                        @endphp
                                        <span class="status-badge {{ $isAvailable ? 'status-available' : 'status-reserved' }}">
                                            {{ $isAvailable ? '✓ Disponible' : '⏱ Réservé' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-eye me-1"></i>Voir Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info py-4">
                <i class="fas fa-info-circle me-2"></i>
                Aucun livre populaire pour le moment. Revenez bientôt !
            </div>
        @endif
    </div>
</section>

<!-- Livres Récents Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title">🆕 Derniers Ajouts</h2>

        @php
            $recents = \App\Models\Livre::orderBy('created_at', 'desc')->limit(6)->get();
        @endphp

        <div class="row g-4">
            @forelse($recents as $livre)
                <div class="col-lg-4 col-md-6">
                    <div class="book-item">
                        <div class="book-image-wrapper">
                            <img src="{{ $livre->image ? asset('storage/' . $livre->image) : 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=300&fit=crop' }}" 
                                 class="book-image" alt="{{ $livre->titre }}" loading="lazy">
                            <div class="book-badge">
                                <span class="new-badge-ribbon">
                                    <i class="fas fa-spark me-1"></i>NOUVEAU
                                </span>
                            </div>
                        </div>
                        <div class="book-info">
                            <h5 class="book-title">{{ $livre->titre }}</h5>
                            <p class="book-author"><i class="fas fa-feather me-2"></i>{{ $livre->auteur }}</p>
                            <div class="book-bottom">
                                <a href="{{ route('livres.show', ['livre' => $livre->id]) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Voir Détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info py-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Aucun nouveau livre pour le moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Catégories Section -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">🏷️ Catégories</h2>

        @if($categories && $categories->count() > 0)
            <div class="row g-4">
                @foreach($categories->take(4) as $categorie)
                    <div class="col-lg-6 col-md-6">
                        <a href="{{ route('livres.index', ['categorie' => $categorie->id]) }}" class="text-decoration-none">
                            <div class="category-card">
                                <div class="category-icon">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <h5 class="category-name">{{ $categorie->nom }}</h5>
                                <p class="category-count">
                                    <i class="fas fa-book me-1"></i>
                                    {{ $categorie->livres_count ?? 0 }} livre{{ ($categorie->livres_count ?? 0) !== 1 ? 's' : '' }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title mb-5">📊 Notre Bibliothèque en Chiffres</h2>

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

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container text-center">
        <h2 class="mb-4">Prêt à Commencer ?</h2>
        <p class="lead mb-4">Rejoignez notre communauté et découvrez des milliers de livres passionnants.</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-cta btn-lg">
                <i class="fas fa-user-plus me-2"></i>Créer un Compte
            </a>
        @else
            <a href="{{ route('livres.index') }}" class="btn btn-cta btn-lg">
                <i class="fas fa-search me-2"></i>Parcourir les Livres
            </a>
        @endguest
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Initialiser le carousel
    const carousel = new bootstrap.Carousel(document.getElementById('carouselLivres'), {
        interval: 5000,
        wrap: true
    });
</script>
@endsection
