<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $table = 'vehicle_images'; // Nom de la table des images des véhicules

    protected $fillable = [
        'vehicle_id', // Clé étrangère vers le modèle Vehicle
        'image', // Nom du fichier d'image
    ];

    /**
     * Get the vehicle that owns the image.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}