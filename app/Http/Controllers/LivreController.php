<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LivreController extends Controller
{
    // Page d'accueil
    public function home()
    {
        // Livres populaires (les plus réservés)
        $populaires = Livre::with('categorie')
            ->withCount('reservations')
            ->orderByDesc('reservations_count')
            ->limit(12)
            ->get();

        // Catégories avec comptes
        $categories = Categorie::withCount('livres')->get();

        // Statistiques cachées
        $stats = Cache::remember('library_stats', 3600, function () {
            return [
                'total_livres' => Livre::count(),
                'total_users' => User::count(),
                'total_reservations' => Reservation::count(),
                'total_categories' => Categorie::count(),
            ];
        });

        return view('home', compact('populaires', 'categories', 'stats'));
    }

    // Afficher tous les livres avec image et catégorie
    public function index(Request $request)
    {
        $query = Livre::with('categorie');

        // Recherche par titre ou auteur
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('auteur', 'like', '%' . $request->search . '%');
            });
        }

        // Filtrage par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        $livres = $query->paginate(12)->withQueryString();

        // Récupérer toutes les catégories pour la liste déroulante - Cached
        $categories = Cache::remember('categories_list', 3600, function () {
            return Categorie::all();
        });

        // Passer les statistiques pré-calculées sans requêtes supplémentaires
        $stats = Cache::remember('library_stats', 3600, function () {
            return [
                'total_livres' => Livre::count(),
                'total_users' => User::count(),
                'total_reservations' => Reservation::count(),
                'total_categories' => Categorie::count(),
            ];
        });

        return view('livres.index', compact('livres', 'categories', 'stats'));
    }

    // Afficher les détails d'un livre spécifique
    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }
}
