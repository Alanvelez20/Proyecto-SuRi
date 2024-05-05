<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;
    protected $fillable = ['lote_id', 'alimento_id'];

    public function lote()
    {
        return $this->belongsToMany(Lote::class);
    }
    public function alimento()
    {
        return $this->belongsToMany(Alimento::class);
    }
}
