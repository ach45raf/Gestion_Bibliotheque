@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-5">
        <h1 class="h2 fw-bold text-dark">Mes Réservations</h1>
        <p class="text-muted">Gérez vos réservations de livres</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($reservations->isEmpty())
        <div class="card border-0 bg-light">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Vous n'avez aucune réservation en cours.</h5>
                <p class="text-muted small mb-4">Découvrez notre collection de livres et créez votre première réservation</p>
                <a href="{{ route('livres.index') }}" class="btn btn-primary">
                    <i class="fas fa-book me-2"></i>Parcourir les livres
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($reservations as $reservation)
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-start">
                                <!-- Informations du livre -->
                                <div class="col-lg-8">
                                    <h5 class="card-title fw-bold">
                                        @if($reservation->livre)
                                            {{ $reservation->livre->titre }}
                                        @else
                                            <span class="text-muted">Livre supprimé</span>
                                        @endif
                                    </h5>
                                    
                                    @if($reservation->livre)
                                        <p class="text-muted small mb-3">
                                            <strong>Auteur :</strong> {{ $reservation->livre->auteur ?? 'Non spécifié' }}
                                        </p>
                                    @endif

                                    <div class="row text-sm text-muted mb-3">
                                        <div class="col-sm-6">
                                            <p class="mb-2">
                                                <strong><i class="fas fa-calendar me-1"></i>Du :</strong> 
                                                {{ $reservation->date_debut->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="mb-2">
                                                <strong><i class="fas fa-calendar-check me-1"></i>Au :</strong> 
                                                {{ $reservation->date_fin->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($reservation->message)
                                        <div class="alert alert-info alert-sm py-2 px-3">
                                            <strong>Note :</strong> {{ $reservation->message }}
                                        </div>
                                    @endif
                                </div>

                                <!-- État et actions -->
                                <div class="col-lg-4 text-lg-end">
                                    <span class="badge
                                        @if($reservation->etat === 'confirmee')
                                            bg-success
                                        @elseif($reservation->etat === 'en_attente')
                                            bg-warning
                                        @elseif($reservation->etat === 'annule')
                                            bg-danger
                                        @elseif($reservation->etat === 'expiree')
                                            bg-secondary
                                        @else
                                            bg-info
                                        @endif
                                    " class="d-inline-block mb-3">
                                        @switch($reservation->etat)
                                            @case('confirmee')
                                                <i class="fas fa-check-circle me-1"></i>Confirmée
                                                @break
                                            @case('en_attente')
                                                <i class="fas fa-hourglass-half me-1"></i>En attente
                                                @break
                                            @case('annule')
                                                <i class="fas fa-times-circle me-1"></i>Annulée
                                                @break
                                            @case('expiree')
                                                <i class="fas fa-calendar-times me-1"></i>Expirée
                                                @break
                                            @default
                                                {{ $reservation->etat }}
                                        @endswitch
                                    </span>

                                    @if($reservation->etat !== 'annule' && $reservation->etat !== 'expiree')
                                        <div class="mt-3">
                                            <form action="{{ route('user.reservations.cancel', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash me-1"></i>Annuler
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
