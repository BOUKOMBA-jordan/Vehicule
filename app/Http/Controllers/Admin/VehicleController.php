<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleFormRequest;
use App\Models\Option;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('make', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%")
                    ->orWhere('fuel_type', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('owner_name', 'like', "%{$search}%")
                    ->orWhere('owner_phone', 'like', "%{$search}%");
            });
        }

        $vehicles = $query->orderBy('created_at', 'desc')->withTrashed()->paginate(25);

        return view('admin.vehicles.index', [
            'vehicles' => $vehicles
        ]);
    }

    public function create()
    {
        return view('admin.vehicles.form', [
            'vehicle' => new Vehicle(),
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    public function store(VehicleFormRequest $request)
    {
        Log::info('Vehicle data before save:', $request->all());

        // Créez le véhicule avec les données validées
        $vehicle = Vehicle::create($request->validated());

        Log::info('Vehicle data after save:', $vehicle->toArray());

        // Assurez-vous que le véhicule est bien enregistré avant d'attacher des fichiers
        if ($request->hasFile('images')) {
            $vehicle->attachFiles($request->file('images'));
        }

        $vehicle->options()->sync($request->input('options', []));

        return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été créé');
    }


    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.form', [
            'vehicle' => $vehicle,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    public function update(VehicleFormRequest $request, Vehicle $vehicle)
    {
        Log::info('Vehicle data before update:', $request->all());

        // Préparez les données pour la mise à jour, excluez la référence si vous ne souhaitez pas la modifier
        $data = $request->except('reference');

        // Mettre à jour le véhicule avec les données validées
        $vehicle->update($data);

        Log::info('Vehicle data after update:', $vehicle->toArray());

        $vehicle->options()->sync($request->input('options', []));
        $vehicle->attachFiles($request->file('images', []));

        return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été modifié');
    }





    public function destroy(Vehicle $vehicle)
{
    foreach ($vehicle->images as $image) {
        if ($image->filename) {
            Log::info('Attempting to delete file: ' . $image->filename);
            if (Storage::disk('public')->exists($image->filename)) {
                Storage::disk('public')->delete($image->filename);
            } else {
                Log::warning('File not found for deletion: ' . $image->filename);
            }
            $image->delete();
        } else {
            Log::warning('Filename is null for image associated with vehicle ID: ' . $vehicle->id);
        }
    }

    $vehicle->delete();

    return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été supprimé');
}

}