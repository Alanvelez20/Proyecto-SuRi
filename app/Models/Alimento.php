<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alimento extends Model
{
    use HasFactory;
    protected $fillable = ['alimento_descripcion', 'alimento_cantidad','alimento_costo',
    'user_id','archivo_nombre','archivo_ubicacion'];

    public function animals()
    {
        return $this->belongsToMany(Animal::class);
    }

    public function lotes()
    {
        return $this->belongsToMany(Lote::class);
    }
    public function consumos()
    {
        return $this->belongsTo(Consumo::class, 'alimento_id_consumo');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
