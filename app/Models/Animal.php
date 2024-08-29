<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class animal extends Model
{
    use HasFactory; 
    protected $primaryKey = 'arete';
    public $incrementing = false; 
    protected $keyType = 'bigInteger'; 
    protected $fillable = ['arete','animal_especie', 'animal_genero',
    'animal_peso_inicial','animal_peso_final','animal_valor_compra',
    'consumo_total','costo_total','fecha_ingreso','animal_id_lote','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lote()
    {
        return $this->belongsTo(Lote::class,'animal_id_lote');
    }
}
