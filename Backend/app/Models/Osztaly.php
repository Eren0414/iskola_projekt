<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Osztaly extends Model
{

    /** @use HasFactory<\Database\Factories\OsztalyFactory> */
    use HasFactory, Notifiable;

    public function diakok()
    {
        return $this->hasMany(Diak::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'osztalyNev' => $this->osztalyNev,
            'diakok' => $this->diakok,
        ];
    }



    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'osztalyNev',
    ];
}
