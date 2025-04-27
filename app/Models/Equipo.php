<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen', 'fundacion', 'descripcion', 'user_id'];

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
