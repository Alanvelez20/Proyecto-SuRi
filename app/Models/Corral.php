<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corral extends Model
{
    use HasFactory;
    protected $fillable = ['corral_nombre','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lotes()
    {
        return $this->hasMany(Lote::class, 'lote_id_corral');
    }
}
