<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;
    protected $fillable = ['alimento_id_consumo', 'alimento_cantidad_total','valor_dieta', 'fecha_consumo','animales_cantidad','lote_id_consumo','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lote()
    {
        return $this->belongsTo(Lote::class, 'lote_id_consumo');
    }
    public function alimento()
    {
        return $this->belongsTo(Alimento::class, 'alimento_id_consumo');
    }
}
