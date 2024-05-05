<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $fillable = ['lote_nombre', 'lote_cantidad','lote_id_corral','user_id'];

    public function alimentos()
    {
        return $this->belongsToMany(Alimento::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
