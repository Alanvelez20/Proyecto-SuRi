<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function getAnimales($loteId)
    {
        $animales = Animal::where('animal_id_lote', $loteId)->get();
        return response()->json($animales);
    }
}