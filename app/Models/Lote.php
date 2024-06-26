<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lote extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['lote_nombre', 'lote_cantidad','consumo_total_alimento','lote_id_corral','user_id'];

    public function alimentos()
    {
        return $this->belongsToMany(Alimento::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function consumos()
    {
        return $this->hasMany(Consumo::class, 'lote_id_consumo');
    }
    public function animales()
    {
        return $this->hasMany(Animal::class);
    }
}
