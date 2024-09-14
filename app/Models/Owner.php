<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

// Dans le modèle Owner.php
protected $fillable = ['name', 'phone'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }


}