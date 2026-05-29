<?php

namespace App\Http\Controllers;

use App\Models\Cycle;

class ProfilController extends Controller
{
    public function index()
    {
        $user           = auth()->user();
        $allCycles      = Cycle::where('user_id', $user->id)->get();
        $activeCycles   = $allCycles->where('status', 'active');
        $completedCycles = $allCycles->where('status', 'completed');

        return view('profil', compact('user', 'allCycles', 'activeCycles', 'completedCycles'));
    }
}
