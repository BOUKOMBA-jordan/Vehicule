<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'make',
        'model',
        'year',
        'fuel_type',
        'mileage',
        'color',
        'price',
        'city',
        'address',
        'location',
        'registration_number',
        'owner_name',
        'owner_phone',
        'reference', // Assurez-vous que 'reference' est inclus ici
    ];

    protected $casts = [
        // Ajoutez des casts ici si nécessaire
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($vehicle) {
            if (empty($vehicle->reference)) {
                $vehicle->reference = self::generateUniqueReference();
            }
        });
    }

    public static function generateUniqueReference()
    {
        do {
            $reference = strtoupper(Str::random(2)) . random_int(10, 99);
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }

    // Ne générez pas une nouvelle référence lors des mises à jour
    public function getReferenceAttribute($value)
    {
        return $value;
    }

    // Méthodes pour les relations
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function attachFiles(array $files): void
    {
        if (!$this->exists) {
            Log::warning('Attempted to attach files to a non-existent vehicle.');
            return;
        }
    
        $images = [];
        foreach ($files as $file) {
            if ($file->getError()) {
                continue;
            }
            $filename = $file->store('vehicles/' . $this->id, 'public');
            $images[] = ['filename' => $filename];
        }
        if (count($images) > 0) {
            $this->images()->createMany($images);
        }
    }
    


    public function getImage(): ?VehicleImage
    {
        return $this->images->first();
    }

    public function scopeAvailable(Builder $builder, bool $available = true): Builder
    {
        return $builder->where('sold', !$available);
    }

    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy('created_at', 'desc');
    }

    public function getSlug(): string
    {
        return Str::slug($this->make . ' ' . $this->model);
    }
}