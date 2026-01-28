@extends('layouts.app')

@section('title', 'Contact - Bibliothèque Numérique')

@section('content')
<style>
    .contact-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #1a3a0d 100%);
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: rgba(212, 175, 55, 0.1);
        border-radius: 50%;
    }

    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
        position: relative;
        z-index: 2;
    }

    .contact-hero .lead {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        position: relative;
        z-index: 2;
    }

    .contact-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(45, 80, 22, 0.2);
        border-color: var(--accent);
    }

    .info-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .contact-card:hover .info-icon {
        transform: scale(1.15) rotate(-10deg);
    }

    .info-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        font-family: 'Playfair Display', serif;
    }

    .info-text {
        color: var(--secondary);
        font-size: 1rem;
        margin: 0;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(45, 80, 22, 0.1);
        border: 1px solid var(--border-color);
    }

    .form-card h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--text-dark);
        font-family: 'Playfair Display', serif;
    }

    .form-label {
        color: var(--text-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid var(--border-color);
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary), #1a3a0d);
        color: white;
        border: none;
        padding: 12px 40px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45, 80, 22, 0.3);
        color: white;
    }
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container text-center">
        <h1><i class="fas fa-envelope me-3"></i>Contactez-nous</h1>
        <p class="lead">Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question.</p>
    </div>
</section>

<div class="container py-5">
    <!-- Contact Info Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="contact-card text-center">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5 class="info-title">Email</h5>
                <p class="info-text">bibliotheque@email.com</p>
                <p class="info-text text-muted small">Réponse sous 24h</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="contact-card text-center">
                <div class="info-icon" style="color: var(--accent);">
                    <i class="fas fa-phone"></i>
                </div>
                <h5 class="info-title">Téléphone</h5>
                <p class="info-text">+212 6 00 00 00 00</p>
                <p class="info-text text-muted small">Lun-Ven 9h-18h</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="contact-card text-center">
                <div class="info-icon" style="color: var(--secondary);">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h5 class="info-title">Adresse</h5>
                <p class="info-text">Bibliothèque en ligne</p>
                <p class="info-text text-muted small">Maroc</p>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <h3><i class="fas fa-paper-plane me-2"></i>Envoyez-nous un Message</h3>
                <form method="POST" action="#">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Sujet</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet du message" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="6" placeholder="Votre message..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer le Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
