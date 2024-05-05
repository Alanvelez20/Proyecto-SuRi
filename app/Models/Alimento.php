<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;
    protected $fillable = ['alimento_descripcion', 'alimento_cantidad','alimento_costo','user_id'];

    public function animals()
    {
        return $this->belongsToMany(Animal::class);
    }

    public function lotes()
    {
        return $this->belongsToMany(Lote::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
