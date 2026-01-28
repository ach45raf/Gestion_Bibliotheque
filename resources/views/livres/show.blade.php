@extends('layouts.app')

@section('title', $livre->titre . ' - Bibliothèque Numérique')

@section('content')
<style>
    .book-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        color: white;
        padding: 60px 0;
    }

    .book-image-container {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        height: 500px;
    }

    .book-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-details-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border: 1px solid var(--border-color);
    }

    .book-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        font-family: 'Playfair Display', serif;
    }

    .book-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid var(--border-color);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .meta-icon {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .meta-label {
        font-weight: 600;
        color: var(--secondary);
        font-size: 0.9rem;
        display: block;
    }

    .meta-value {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 1.1rem;
    }

    .description-section {
        margin-bottom: 2rem;
    }

    .description-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }

    .description-text {
        color: var(--secondary);
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .reservation-card {
        background: linear-gradient(135deg, rgba(45, 80, 22, 0.05), rgba(139, 115, 85, 0.05));
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border: 2px solid var(--primary);
    }

    .reservation-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        font-family: 'Playfair Display', serif;
        text-align: center;
    }

    .btn-reserve {
        background: linear-gradient(135deg, var(--primary), #1a3a0d);
        color: white;
        border: none;
        padding: 14px 40px;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 1.15rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45, 80, 22, 0.3);
        color: white;
    }

    .badge-category {
        background: linear-gradient(135deg, var(--accent), #c9a961);
        color: var(--text-dark);
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.95rem;
        display: inline-block;
    }
</style>

<!-- Hero Section -->
<section class="book-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('livres.index') }}" class="text-white">Livres</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $livre->titre }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container py-5">
    <div class="row mb-5">
        <!-- Book Image -->
        <div class="col-lg-4 mb-4">
            <div class="book-image-container">
                @if($livre->image)
                    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="book-image">
                @else
                    <div class="book-image bg-gradient d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--primary), #1a3a0d);">
                        <i class="fas fa-book fa-6x text-white opacity-50"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Book Details -->
        <div class="col-lg-8">
            <div class="book-details-card">
                <span class="badge-category mb-3">
                    <i class="fas fa-tag me-1"></i>{{ $livre->categorie->nom ?? 'Général' }}
                </span>
                
                <h1 class="book-title">{{ $livre->titre }}</h1>

                <div class="book-meta">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <span class="meta-label">Auteur</span>
                            <span class="meta-value">{{ $livre->auteur }}</span>
                        </div>
                    </div>

                    @if($livre->date_publication)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div>
                            <span class="meta-label">Publication</span>
                            <span class="meta-value">{{ \Carbon\Carbon::parse($livre->date_publication)->format('Y') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div>
                            <span class="meta-label">Statut</span>
                            @php
                                $reserved = $livre->reservations()->where('etat', 'valide')->count();
                                $isAvailable = $reserved === 0;
                            @endphp
                            <span class="meta-value" style="color: {{ $isAvailable ? 'var(--success)' : 'var(--warning)' }};">
                                {{ $isAvailable ? '✓ Disponible' : '⏱ Réservé' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="description-section">
                    <h3 class="description-title">
                        <i class="fas fa-align-left me-2"></i>Description
                    </h3>
                    <p class="description-text">
                        {{ $livre->description ?: 'Aucune description disponible pour ce livre.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservation Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="reservation-card">
                <h3><i class="fas fa-bookmark me-2"></i>Réserver ce Livre</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @auth
                    <form method="POST" action="{{ route('user.reservations.store') }}">
                        @csrf
                        <input type="hidden" name="livre_id" value="{{ $livre->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_debut" class="form-label fw-bold">
                                    <i class="fas fa-calendar-alt me-2"></i>Date de Début
                                </label>
                                <input type="date" class="form-control form-control-lg" id="date_debut" name="date_debut" 
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date_fin" class="form-label fw-bold">
                                    <i class="fas fa-calendar-check me-2"></i>Date de Fin
                                </label>
                                <input type="date" class="form-control form-control-lg" id="date_fin" name="date_fin" 
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-reserve">
                                <i class="fas fa-bookmark me-2"></i>Réserver Maintenant
                            </button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning text-center">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Connexion Requise</h5>
                        <p class="mb-3">Vous devez être connecté pour réserver ce livre.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>S'inscrire
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

@endsection
