<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sport extends Model
{
    /** @use HasFactory<\Database\Factories\SportFactory> */
    use HasFactory, Notifiable;
    
    //Ne foglalkozzon a timestamps mezőkkel
    public $timestamps = false;
    
    //Ezeket a mezőket lehet feltölteni
    protected $fillable = [
        'id',
        'sportNev',
    ];
}
