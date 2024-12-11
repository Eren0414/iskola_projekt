<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diak extends Model
{
    /** @use HasFactory<\Database\Factories\DiakFactory> */
    use HasFactory;

    public $timestamps = true;


    protected $fillable = [
        'id',
        'osztalyId',
        'nev',
        'neme',
        'szuletett',
        'helyseg',
        'osztondij',
        'atlag',
    ];


    protected function casts(): array
    {
        return [
            'neme' => 'boolean',
            'szuletett' => 'date',                      
        ];
    }


}
