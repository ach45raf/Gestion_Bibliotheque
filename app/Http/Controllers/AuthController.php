<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher la page d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Traiter l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'sexe'     => 'required|in:male,female,other',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'sexe'     => $request->sexe,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Role par défaut
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    // Afficher la page de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Rediriger vers l'accueil pour tous les utilisateurs
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'L\'adresse e-mail ou le mot de passe est incorrect.',
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Afficher la page mot de passe oublié
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Envoyer le lien de réinitialisation du mot de passe
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Ici, vous pouvez implémenter l'envoi d'email
        // Pour l'instant, on simule le succès
        return back()->with('status', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
    }
}
