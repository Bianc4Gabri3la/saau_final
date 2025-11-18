<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Animal extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'size',
        'color',
        'description',
        'health_status',
        'status',
        'photo',
        'castrated',
        'vaccinated',
        'dewormed',
        'special_needs',
        'health_notes'
    ];

    protected $casts = [
        'castrated' => 'boolean',
        'vaccinated' => 'boolean',
        'dewormed' => 'boolean',
        'special_needs' => 'boolean',
    ];

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function adoptionStory()
    {
        return $this->hasOne(AdoptionStory::class);
    }

    // Mutators para garantir que checkboxes vazios sejam tratados como false
    public function setCastratedAttribute($value)
    {
        $this->attributes['castrated'] = $value ? 1 : 0;
    }

    public function setVaccinatedAttribute($value)
    {
        $this->attributes['vaccinated'] = $value ? 1 : 0;
    }

    public function setDewormedAttribute($value)
    {
        $this->attributes['dewormed'] = $value ? 1 : 0;
    }

    public function setSpecialNeedsAttribute($value)
    {
        $this->attributes['special_needs'] = $value ? 1 : 0;
    }
}
