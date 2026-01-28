<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'livre_id' => 'required|exists:livres,id',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
    ]);

    // Empêcher le même utilisateur de réserver le même livre deux fois
    $alreadyReservedSameBook = Reservation::where('user_id', Auth::id())
        ->where('livre_id', $request->livre_id)
        ->whereIn('etat', ['en_attente', 'valide'])
        ->exists();

    if ($alreadyReservedSameBook) {
        return back()->withErrors([
            'reservation' => 'Vous avez déjà réservé ce livre.'
        ]);
    }

    // Empêcher le chevauchement des réservations pour le même livre (avec d'autres utilisateurs)
    $existe = Reservation::where('livre_id', $request->livre_id)
        ->where('etat', 'valide')
        ->where(function ($q) use ($request) {
            $q->where('date_debut', '<=', $request->date_fin)
              ->where('date_fin', '>=', $request->date_debut);
        })
        ->exists();

    if ($existe) {
        return back()->withErrors([
            'reservation' => 'Ce livre est déjà réservé pour cette période.'
        ]);
    }

    Reservation::create([
        'user_id' => Auth::id(),
        'livre_id' => $request->livre_id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'etat' => 'en_attente',
    ]);

    return back()->with('success', 'Votre demande de réservation a été envoyée avec succès.');
}

}
 