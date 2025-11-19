<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Raffle extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'raffles';

    protected $fillable = [
        'title',
        'description',
        'prize',
        'ticket_price',
        'total_tickets',
        'draw_date',
        'status',
        'image_url',
    ];

    protected $casts = [
        'draw_date'      => 'date',
        'ticket_price'   => 'decimal:2',
        'total_tickets'  => 'integer',
    ];
}
