<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SitioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function principal($tipo = null)
    {
        $user = Auth::user();
        
        if ($user->rol === 'admin') {
            return view('admin.principal', compact('tipo'));
        } else {
            return view('principal', compact('tipo'));
        }
    }
}
