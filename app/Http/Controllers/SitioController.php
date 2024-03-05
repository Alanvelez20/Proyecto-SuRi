<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitioController extends Controller
{
    public function principal($tipo = null)
    {
        $otra = 'algo';

        return view('principal', compact('tipo', 'otra'));

    }
}
