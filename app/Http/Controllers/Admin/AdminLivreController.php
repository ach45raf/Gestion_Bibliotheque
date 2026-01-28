<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLivreController extends Controller
{
    // Afficher tous les livres
    public function index()
    {
        $livres = Livre::with('categorie')->get();
        return view('admin.livres.index', compact('livres'));
    }

    // Formulaire d'ajout d'un nouveau livre
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.livres.create', compact('categories'));
    }

    // Enregistrer un nouveau livre
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['titre','auteur','description','date_publication','categorie_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('livres', 'public');
        }

        Livre::create($data);

        return redirect()->route('admin.livres.index')->with('success', 'Livre ajouté avec succès');
    }

    // Formulaire de modification d'un livre
    public function edit(Livre $livre)
    {
        $categories = Categorie::all();
        return view('admin.livres.edit', compact('livre', 'categories'));
    }

    // Mettre à jour un livre
    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['titre','auteur','description','date_publication','categorie_id']);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $data['image'] = $request->file('image')->store('livres', 'public');
        }

        $livre->update($data);

        return redirect()->route('admin.livres.index')->with('success', 'Livre modifié avec succès');
    }

    // Supprimer un livre
    public function destroy(Livre $livre)
    {
        // Supprimer l'image si elle existe
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }

        $livre->delete();

        return redirect()->route('admin.livres.index')->with('success', 'Livre supprimé avec succès');
    }
}
