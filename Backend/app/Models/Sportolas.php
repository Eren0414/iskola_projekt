<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportolas extends Model
{
    /** @use HasFactory<\Database\Factories\SportolasFactory> */
    use HasFactory;

    protected $fillable = [
        'diakokId',
        'sportokId',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'diakokId' => 'integer',
            'sportokId' => 'integer',                      
        ];
    }
}
