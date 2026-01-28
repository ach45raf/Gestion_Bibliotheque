<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{
    // Afficher les réservations de l'utilisateur
    public function index()
    {
        $reservations = Reservation::with('livre')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }

    // Annuler une réservation
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->update([
            'etat' => 'annule'
        ]);

        return back()->with('success', 'Votre réservation a été annulée avec succès.');
    }
}
