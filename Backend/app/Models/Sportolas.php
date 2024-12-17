<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sportolas extends Model
{
    /** @use HasFactory<\Database\Factories\SportolasFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'diakokId',
        'sportokId',
    ];
}
