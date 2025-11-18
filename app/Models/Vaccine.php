<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vaccine extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'vaccines';

    // ID é UUID (string), não auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'animal_id',
        'name',
        'date',
        'veterinarian',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
