<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Diak extends Model
{
    /** @use HasFactory<\Database\Factories\DiakFactory> */
    use HasFactory, Notifiable;


    public function osztalies()
    {
        return $this->belongsTo(Osztaly::class, 'osztalyId');
    }


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
