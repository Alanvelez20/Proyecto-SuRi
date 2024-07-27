<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $primaryKey = 'arete';
    protected $fillable = ['arete', 'animal_especie','animal_genero', 'animal_peso_inicial', 
    'animal_peso_final','animal_valor_compra','animal_valor_venta','consumo_total','costo_total',
    'fecha_ingreso','fecha_venta','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
