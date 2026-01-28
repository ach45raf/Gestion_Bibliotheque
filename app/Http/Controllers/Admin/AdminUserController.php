<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // Formulaire de modification d'un utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Utilisateur modifié avec succès');
    }

    // Supprimer un utilisateur
    public function destroy(User $user)
    {
        // ❌ Empêcher l'admin de supprimer son propre compte
        if ($user->id === Auth::id()) {
            return back()->withErrors([
                'Vous ne pouvez pas supprimer votre propre compte.'
            ]);
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès');
    }
}
