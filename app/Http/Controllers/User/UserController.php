<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Dashboard utilisateur
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Dernière notification de l'admin (acceptation ou refus)
        $reservation = Reservation::where('user_id', $user->id)
            ->whereNotNull('message')
            ->latest()
            ->first();

        $notification = null;
        if ($reservation) {
            $notification = $reservation->message;
            $reservation->update(['message' => null]);
        }

        // Mes réservations
        $reservations = Reservation::where('user_id', $user->id)
            ->with('livre')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('user', 'notification', 'reservations'));
    }

    // Mettre à jour le profil utilisateur
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->hasFile('photo')) {

            // Supprimer l'ancienne photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Votre profil a été mis à jour avec succès.');
    }
}
