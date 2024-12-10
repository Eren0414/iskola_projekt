<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Osztaly extends Model
{
    /** @use HasFactory<\Database\Factories\OsztalyFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'osztalyNev',
    ];
}
