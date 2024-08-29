<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function show($arete, Request $request)
    {
        $userId = $request->query('user_id');

    $animal = Animal::where('arete', $arete)
                    ->where('user_id', $userId)  // Filtrar por el user_id recibido
                    ->firstOrFail();
        return response()->json($animal);
    }
}

