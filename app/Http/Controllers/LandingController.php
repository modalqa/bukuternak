<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cycle;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        // Pastikan status 'active' (bukan 'aktif') sesuai migrasi dan model
        $activeCycleCount = Cycle::where('status', 'active')->count();
        return view('welcome', compact('userCount', 'activeCycleCount'));
    }
}
