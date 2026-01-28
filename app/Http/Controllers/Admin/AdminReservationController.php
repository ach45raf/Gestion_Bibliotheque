<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'livre'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'etat' => 'required|in:valide,annule'
        ]);

        $reservation->update([
            'etat' => $request->etat,
            'message' => $request->etat === 'valide'
                ? 'Félicitations, le livre "' . $reservation->livre->titre . '" a été réservé avec succès.'
                : 'Malheureusement, votre demande de réservation du livre "' . $reservation->livre->titre . '" a été refusée.'
]);

        return back()->with('success', 'Réservation mise à jour');
    }
}
