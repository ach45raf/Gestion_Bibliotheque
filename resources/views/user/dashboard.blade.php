@extends('layouts.app')

@section('title', 'Mon Dashboard - Bibliothèque Numérique')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
        }

        .dashboard-header .container {
            position: relative;
            z-index: 2;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .tab-content-custom {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 30px;
        }

        .nav-tabs-custom .nav-link {
            border: none;
            border-radius: 10px 10px 0 0;
            color: var(--secondary);
            font-weight: 600;
            padding: 15px 25px;
            margin-right: 5px;
            transition: all 0.3s ease;
        }

        .nav-tabs-custom .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 10px rgba(45, 80, 22, 0.3);
        }

        .nav-tabs-custom .nav-link:hover:not(.active) {
            background: rgba(45, 80, 22, 0.1);
            color: var(--primary);
        }

        .reservation-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .reservation-card:hover {
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.1);
            border-color: var(--primary);
        }

        .book-card-dashboard {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .book-card-dashboard:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .book-image-dashboard {
            height: 150px;
            object-fit: cover;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #1a3a0d);
            border: none;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.4);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .badge-custom {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                padding: 40px 0;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>

<!-- ================= MODERN NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <i class="fas fa-book-open me-2"></i>
            Bibliothèque Numérique
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="me-3 text-white">
                    <small>Connecté en tant que</small><br>
                    <strong>{{ $user->name }}</strong>
                </div>
                <div class="rounded-circle overflow-hidden border border-white me-3" style="width: 45px; height: 45px;">
                    <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/45x45?text=U' }}"
                         alt="Profile" class="w-100 h-100 object-fit-cover">
                </div>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-custom">
                        <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- ================= DASHBOARD HEADER ================= -->
<section class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="fas fa-user-circle me-3"></i>
                    Bienvenue dans votre Espace Personnel
                </h1>
                <p class="lead mb-0 fs-5">
                    Gérez vos réservations, consultez votre profil et explorez notre collection de livres.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/200x200?text=Profile' }}"
                     alt="Profile" class="rounded-circle profile-avatar">
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">

    {{-- Notification --}}
    @if($notification)
        <div class="container">
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white;">
                <i class="fas fa-bell me-2"></i>
                {{ $notification }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- ================= STATS CARDS ================= -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon text-primary">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ $reservations->count() }}</h3>
                    <p class="text-muted mb-0">Mes Réservations</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon text-success">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ $reservations->where('status', 'active')->count() }}</h3>
                    <p class="text-muted mb-0">Réservations Actives</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ $reservations->where('status', 'pending')->count() }}</h3>
                    <p class="text-muted mb-0">En Attente</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon text-info">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ $reservations->where('status', 'completed')->count() }}</h3>
                    <p class="text-muted mb-0">Terminées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="container">
        <div class="tab-content-custom">
            <ul class="nav nav-tabs nav-tabs-custom mb-4" id="userTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                        <i class="fas fa-user me-2"></i>Mon Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reservations-tab" data-bs-toggle="tab" data-bs-target="#reservations" type="button" role="tab">
                        <i class="fas fa-calendar-alt me-2"></i>Mes Réservations
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="books-tab" data-bs-toggle="tab" data-bs-target="#books" type="button" role="tab">
                        <i class="fas fa-book me-2"></i>Livres Disponibles
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="userTabsContent">

                <!-- PROFILE TAB -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="profile-card">
                        <div class="row">
                            <div class="col-lg-4 text-center mb-4">
                                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/200x200?text=Profile' }}"
                                     alt="Profile" class="rounded-circle profile-avatar mx-auto d-block">
                                <h4 class="mt-3 fw-bold">{{ $user->name }}</h4>
                                <p class="text-muted mb-0">{{ $user->sexe === 'female' ? 'Femme' : 'Homme' }}</p>
                            </div>
                            <div class="col-lg-8">
                                <h3 class="mb-4">
                                    <i class="fas fa-user-edit me-2 text-primary"></i>
                                    Modifier Mon Profil
                                </h3>

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px;">
                                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label fw-semibold">
                                                <i class="fas fa-user me-1"></i>Nom complet
                                            </label>
                                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                                   value="{{ $user->name }}" style="border-radius: 10px;" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label fw-semibold">
                                                <i class="fas fa-envelope me-1"></i>Adresse email
                                            </label>
                                            <input type="email" class="form-control form-control-lg"
                                                   value="{{ $user->email }}" style="border-radius: 10px;" readonly>
                                            <small class="text-muted">L'email ne peut pas être modifié</small>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="photo" class="form-label fw-semibold">
                                            <i class="fas fa-camera me-1"></i>Photo de profil
                                        </label>
                                        <input type="file" name="photo" id="photo" class="form-control form-control-lg"
                                               accept="image/*" style="border-radius: 10px;">
                                        <small class="text-muted">Formats acceptés: JPG, PNG, GIF. Taille max: 2MB</small>
                                    </div>

                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-primary-custom btn-lg">
                                            <i class="fas fa-save me-2"></i>Sauvegarder les modifications
                                        </button>
                                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-lg">
                                            <i class="fas fa-times me-2"></i>Annuler
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RESERVATIONS TAB -->
                <div class="tab-pane fade" id="reservations" role="tabpanel">
                    <div class="mb-4">
                        <h3 class="mb-4">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            Mes Réservations
                        </h3>

                        @if($reservations->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Aucune réservation trouvée</h4>
                                <p class="text-muted mb-4">Vous n'avez pas encore fait de réservations.</p>
                                <a href="{{ route('home') }}" class="btn btn-primary-custom btn-lg">
                                    <i class="fas fa-search me-2"></i>Découvrir nos livres
                                </a>
                            </div>
                        @else
                            <div class="row">
                                @foreach($reservations as $res)
                                    <div class="col-12 mb-3">
                                        <div class="reservation-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-2 text-center">
                                                    @if($res->livre && $res->livre->image)
                                                        <img src="{{ asset('storage/' . $res->livre->image) }}"
                                                             alt="{{ $res->livre->titre }}" class="rounded" style="width: 80px; height: 100px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 100px;">
                                                            <i class="fas fa-book fa-2x text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-1 fw-bold">{{ $res->livre->titre ?? 'Livre supprimé' }}</h5>
                                                    <p class="mb-1 text-muted">
                                                        <i class="fas fa-user-edit me-1"></i>{{ $res->livre->auteur ?? 'Auteur inconnu' }}
                                                    </p>
                                                    <p class="mb-0 text-muted small">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        Du {{ $res->date_debut->format('d/m/Y') }} au {{ $res->date_fin->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    @if($res->etat === 'en_attente')
                                                        <span class="badge bg-warning badge-custom fs-6">
                                                            <i class="fas fa-clock me-1"></i>En attente
                                                        </span>
                                                    @elseif($res->etat === 'valide')
                                                        <span class="badge bg-success badge-custom fs-6">
                                                            <i class="fas fa-check me-1"></i>Validée
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger badge-custom fs-6">
                                                            <i class="fas fa-times me-1"></i>Refusée
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    @if($res->etat === 'en_attente')
                                                        <form action="{{ route('user.reservations.cancel', $res) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-custom"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                                                <i class="fas fa-times me-1"></i>Annuler
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted small">Action terminée</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- BOOKS TAB -->
                <div class="tab-pane fade" id="books" role="tabpanel">
                    <div class="text-center mb-4">
                        <h3 class="mb-3">
                            <i class="fas fa-book me-2 text-primary"></i>
                            Livres Disponibles
                        </h3>
                        <p class="text-muted">Explorez notre collection complète et réservez vos livres préférés</p>
                        <a href="{{ route('home') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-search me-2"></i>Voir tous les livres
                        </a>
                    </div>

                    <div class="row">
                        @php
                            $livres = \App\Models\Livre::with('categorie')->take(6)->get();
                        @endphp
                        @foreach($livres as $livre)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="book-card-dashboard h-100">
                                    @if($livre->image)
                                        <img src="{{ asset('storage/' . $livre->image) }}" class="card-img-top book-image-dashboard" alt="{{ $livre->titre }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center book-image-dashboard">
                                            <i class="fas fa-book fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold mb-2">{{ $livre->titre }}</h6>
                                        <p class="card-text text-muted small mb-2">
                                            <i class="fas fa-user-edit me-1"></i>{{ $livre->auteur }}
                                        </p>
                                        <p class="card-text mb-3">
                                            <span class="badge bg-primary">{{ $livre->categorie->nom ?? 'N/A' }}</span>
                                        </p>
                                        <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary-custom btn-sm w-100">
                                            <i class="fas fa-eye me-1"></i>Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
