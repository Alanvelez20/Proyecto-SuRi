<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corral extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['corral_nombre', 'corral_estado','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
