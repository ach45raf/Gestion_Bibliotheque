<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Categorie;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalLivres' => Livre::count(),
            'totalUsers' => User::count(),
            'totalReservations' => Reservation::count(),
            'totalCategories' => Categorie::count(),
            'reservations' => Reservation::count(),
        ]);
    }
}
