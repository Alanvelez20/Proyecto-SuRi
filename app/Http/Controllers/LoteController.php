<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Corral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // ->only()
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lotes = Auth::user()->lote;
        return view('lotes/loteIndex', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $corrales = Corral::all();
        return view('lotes.loteCreate', compact('corrales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lote_nombre'=>'required|max:255',
            'lote_id_corral'=>'required|integer',
        ], [
            'lote_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'lote_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

            'lote_id_corral.required' => 'El campo ID del CORRAL es obligatorio y debe existir de antes.',
            'lote_id_corral.integer' => 'El campo ID del CORRAL debe ser un número entero válido.',

        ]);

        $request->merge(['user_id'=> Auth::id()]);
        $request->merge(['lote_cantidad' => 0]);
        
        Lote::create($request->all());

        // Redireccionar
        return redirect()->route('lote.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lote $lote)
    {
        $nombre_corral = Corral::find($lote->lote_id_corral)->corral_nombre;
        return view('lotes.loteShow', compact('lote', 'nombre_corral'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lote $lote)
    {
        $corrales = Corral::all(); // Obtener todos los corrales disponibles
        return view('lotes.loteEdit', compact('lote', 'corrales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lote $lote )
    {
        $request->validate([
            'lote_nombre'=>'required|max:255',
            'lote_id_corral'=>'required|integer',
        ], [
            'lote_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'lote_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

            'lote_id_corral.required' => 'El campo ID del CORRAL es obligatorio.',
            'lote_id_corral.integer' => 'El campo ID del CORRAL debe ser un número entero válido.',

        ]);

        $request->offsetUnset('lote_cantidad');
        
        $lote->update($request->all());

        return redirect()->route('lote.show', $lote);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lote $lote)
    {
        $lote->delete();
        return redirect()->route('lote.index');
    }
}
