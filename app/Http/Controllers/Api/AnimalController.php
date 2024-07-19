<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function show($arete)
    {
        $animal = Animal::where('arete', $arete)->firstOrFail();
        return response()->json($animal);
    }
}

