<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchVehiclesRequest;
use App\Http\Requests\VehicleContactRequest;
use App\Mail\VehicleContactMail;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    /**
     * Afficher la liste des véhicules avec filtre et pagination.
     *
     * @param SearchVehiclesRequest $request
     * @return \Illuminate\View\View
     */
    public function index(SearchVehiclesRequest $request)
{
    $query = Vehicle::query()->orderBy('created_at', 'desc');
    $validated = $request->validated();
    
    try {
        if (isset($validated['price'])) {
            $query = $query->where('price', '<=', $validated['price']);
        }
        
        if (isset($validated['mileage'])) {
            $query = $query->where('mileage', '>=', $validated['mileage']);
        }
        
        if (isset($validated['year'])) {
            $query = $query->where('year', '>=', $validated['year']);
        }

        if (isset($validated['make'])) {
            $query = $query->where('make', 'like', "%{$validated['make']}%");
        }

        if (isset($validated['model'])) {
            $query = $query->where('model', 'like', "%{$validated['model']}%");
        }
        
        // Filtrer par les nouveaux champs
        if (isset($validated['registration_number'])) {
            $query = $query->where('registration_number', 'like', "%{$validated['registration_number']}%");
        }

        if (isset($validated['location'])) {
            $query = $query->where('location', 'like', "%{$validated['location']}%");
        }

        $vehicles = $query->paginate(16);

        // Vérifiez si des véhicules ont été trouvés
        $noResults = $vehicles->isEmpty();

        return view('vehicle.index', [
            'vehicles' => $vehicles,
            'input' => $validated,
            'noResults' => $noResults
        ]);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la recherche de véhicules: ' . $e->getMessage());
        return view('vehicle.index')->with('error', 'Une erreur est survenue lors de la recherche de véhicules.');
    }
}


    /**
     * Afficher un véhicule spécifique.
     *
     * @param string $make
     * @param string $model
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $make, string $model, int $id)
    {
        $vehicle = Vehicle::where('make', $make)
            ->where('model', $model)
            ->where('id', $id)
            ->first();

        if (!$vehicle) {
            abort(404); // Affiche une page 404 si le véhicule n'est pas trouvé
        }

        return view('vehicle.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Gérer une demande de contact pour un véhicule.
     *
     * @param Vehicle $vehicle
     * @param VehicleContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact(Vehicle $vehicle, VehicleContactRequest $request)
    {
        try {
            Mail::to('recipient@example.com')->send(new VehicleContactMail($vehicle, $request->validated()));
            return back()->with('success', 'Votre demande de contact a bien été envoyée');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du mail de contact: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande de contact.');
        }
    }
}