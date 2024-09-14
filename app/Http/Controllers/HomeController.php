<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Image;

class HomeController extends Controller
{
    /**
     * Display a listing of vehicles with their images.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Utilisation de paginate pour obtenir les enregistrements avec pagination
        $vehicles = Vehicle::with('images')->latest()->paginate(4); // Utilise le modèle Vehicle et sa relation images
        
        return view('home', ['vehicles' => $vehicles]);
    }
}