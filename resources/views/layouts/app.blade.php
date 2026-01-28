<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '📚 Bibliothèque Numérique')</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts - Playfair Display & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Admin Theme CSS -->
    <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">
    
    <style>
        :root {
            /* Design System Professionnel */
            --primary: #2D5016;
            --secondary: #8B7355;
            --accent: #D4AF37;
            --bg-light: #F5F3F0;
            --text-dark: #2C2C2C;
            --border-color: #E0DDD9;
            /* Couleurs utilitaires */
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #0891b2;
            --light: #F5F3F0;
            --dark: #2C2C2C;
            --border: #E0DDD9;
        }

        * {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6, .section-title {
            font-family: 'Playfair Display', serif;
        }

        body {
            background-color: var(--light);
            color: var(--text-dark);
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-size: 15px;
        }

        main {
            flex: 1;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            box-shadow: 0 6px 20px rgba(45, 80, 22, 0.15);
            padding: 1rem 0;
            border-bottom: 3px solid var(--accent);
        }

        .navbar-custom .navbar-brand {
            font-size: 1.6rem;
            font-weight: 700;
            color: white !important;
            transition: all 0.3s ease;
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand:hover {
            transform: scale(1.05);
            color: var(--accent) !important;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            margin: 0 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .navbar-custom .nav-link:hover {
            color: var(--accent) !important;
            transform: translateY(-2px);
        }

        .navbar-custom .nav-link.active {
            color: var(--accent) !important;
            border-bottom: 3px solid var(--accent);
            padding-bottom: 0.2rem;
        }

        /* ===== BUTTONS ===== */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            letter-spacing: 0.3px;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(45, 80, 22, 0.3);
            background: linear-gradient(135deg, #1a3a0d 0%, var(--primary) 100%);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }

        /* ===== CARDS ===== */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(45, 80, 22, 0.15);
            border-color: var(--accent);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            color: white;
            border: none;
            border-radius: 15px 15px 0 0;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }

        /* ===== TABLES ===== */
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            color: white;
            border: none;
            font-weight: 700;
            padding: 1.2rem 1rem;
            font-family: 'Playfair Display', serif;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: rgba(45, 80, 22, 0.05);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 0.6rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        .badge-accepted, .badge-success, .badge-available {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
        }

        .badge-pending, .badge-reserved {
            background: linear-gradient(135deg, var(--warning), #d97706);
            color: white;
        }

        .badge-rejected, .badge-danger, .badge-unavailable {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }
        
        .badge-popular, .badge-new {
            background: linear-gradient(135deg, var(--accent), #c9a961);
            color: var(--text-dark);
            font-weight: 700;
        }

        /* ===== FORMS ===== */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid var(--border-color);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(45, 80, 22, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        /* ===== ALERTS ===== */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: var(--text-dark);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: var(--danger);
            color: var(--text-dark);
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border-color: var(--warning);
            color: var(--text-dark);
        }

        .alert-info {
            background-color: rgba(8, 145, 178, 0.1);
            border-color: var(--info);
            color: var(--text-dark);
        }

        /* ===== STATS CARDS ===== */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.08);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(45, 80, 22, 0.15);
            border-color: var(--accent);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* ===== FOOTER ===== */
        .footer-custom {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
            color: white;
            padding: 3.5rem 0 1.5rem;
            margin-top: 5rem;
            border-top: 3px solid var(--accent);
        }

        .footer-custom h6 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }

        .footer-custom a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-custom a:hover {
            color: var(--accent);
        }
        
        .footer-custom hr {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-custom .navbar-brand {
                font-size: 1.2rem;
            }

            .stat-icon {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .table {
                font-size: 0.9rem;
            }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease;
        }

        /* ===== SIDEBAR ADMIN ===== */
        .sidebar-admin {
            background: linear-gradient(180deg, var(--dark), #0f172a);
            min-height: 100vh;
            padding: 2rem 1rem;
            color: white;
        }

        .sidebar-admin .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-admin .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-admin .sidebar-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar-admin .sidebar-menu a:hover,
        .sidebar-admin .sidebar-menu a.active {
            background: var(--primary);
            color: white;
            transform: translateX(5px);
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-open me-2"></i>
                Bibliothèque Numérique
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- 👤 MENUS UTILISATEURS (user) -->
                    @auth
                        @if(auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="fas fa-home me-1"></i>Accueil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('livres.index') }}">
                                    <i class="fas fa-book me-1"></i>Livres
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">
                                    <i class="fas fa-envelope me-1"></i>Contact
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-user me-1"></i>Mon Profil
                                </a>
                            </li>
                        @endif

                        <!-- 🛠️ MENUS ADMIN -->
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-chart-line me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="gestionDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-book me-1"></i>Gestion des Livres
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.livres.index') }}"><i class="fas fa-list me-2"></i>Liste des Livres</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.livres.create') }}"><i class="fas fa-plus me-2"></i>Ajouter un Livre</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags me-2"></i>Catégories</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cogs me-1"></i>Administration
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i>Gestion des Utilisateurs</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.reservations.index') }}"><i class="fas fa-calendar-check me-2"></i>Gestion des Réservations</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth

                    <!-- MENUS VISITEURS (non connectés) -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i>Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('livres.index') }}">
                                <i class="fas fa-book me-1"></i>Livres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">
                                <i class="fas fa-envelope me-1"></i>Contact
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Inscription
                            </a>
                        </li>
                    @endguest

                    <!-- 👤 MENU UTILISATEUR (dropdown avec profil) -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo de profil" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid white;">
                                @else
                                    <i class="fas fa-circle-user me-2" style="font-size: 1.5rem;"></i>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(auth()->user()->role === 'user')
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fas fa-user me-2"></i>Mon Profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.reservations.index') }}"><i class="fas fa-calendar me-2"></i>Mes Réservations</a></li>
                                @elseif(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line me-2"></i>Dashboard Admin</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h6><i class="fas fa-book-open me-2"></i>Bibliothèque Numérique</h6>
                    <p>Votre destination pour découvrir, réserver et profiter d'une collection exceptionnelle de livres.</p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Navigation</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('livres.index') }}">Livres</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Services</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Réservation 24/7</li>
                        <li><i class="fas fa-check text-success me-2"></i>Accès Mobile</li>
                        <li><i class="fas fa-check text-success me-2"></i>Support Client</li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Contact</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>+33 1 23 45 67 89</li>
                        <li><i class="fas fa-envelope me-2"></i>contact@bibliotheque.fr</li>
                        <li><i class="fas fa-clock me-2"></i>Lun-Dim: 24/7</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} Bibliothèque Numérique. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-end">
                    <small>Développé avec <i class="fas fa-heart text-danger"></i> pour les passionnés de lecture</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
