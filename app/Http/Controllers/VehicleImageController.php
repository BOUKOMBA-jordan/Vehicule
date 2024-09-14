<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vehicle; // Remplacer Property par Vehicle
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VehicleImageController extends Controller
{
    /**
     * Display a listing of images for a vehicle.
     *
     * @param int $vehicleId
     * @return \Illuminate\View\View
     */
    public function index(int $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $images = VehicleImage::where('vehicle_id', $vehicleId)->get(); // Remplacer property_id par vehicle_id
        
        return view('vehicleImage.index', compact('vehicle', 'images')); // Mettre à jour la vue
    }

    /**
     * Store new images for a vehicle.
     *
     * @param Request $request
     * @param int $vehicleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, int $vehicleId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jfif,jpg,jpeg,webp|max:2048',
        ]);

        $vehicle = Vehicle::findOrFail($vehicleId);

        $imageData = [];
        if ($files = $request->file('images')) {
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;

                $path = 'upload/vehicle/'; // Mettre à jour le chemin

                $file->move(public_path($path), $filename);

                $imageData[] = [
                    'vehicle_id' => $vehicle->id, // Remplacer property_id par vehicle_id
                    'image' => $path . $filename,
                ];
            }

            VehicleImage::insert($imageData);

            return redirect()->back()->with('status', 'Images téléchargées avec succès');
        } else {
            return redirect()->back()->with('status', 'Échec du téléchargement');
        }
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $imageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $imageId)
    {
        $image = VehicleImage::findOrFail($imageId);
        if (File::exists($image->image)) {
            File::delete($image->image);
        }
        $image->delete();

        return redirect()->back()->with('status', 'Image supprimée');
    }
}