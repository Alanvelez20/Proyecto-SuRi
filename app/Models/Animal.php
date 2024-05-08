<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class animal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['animal_especie', 'animal_genero','animal_peso','animal_valor_compra','animal_valor_venta','animal_id_lote','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
