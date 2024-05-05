<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\Consumo;
use App\Models\Alimento;

class ConsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lotes = Lote::all();
        return view('consumo_alimentos.listado', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lote $lote, $lote_id)
    {
        $lote = Lote::findOrFail($lote_id);
        return view('consumo_alimentos.show', compact('lote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumo $consumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumo $consumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumo $consumo)
    {
        //
    }

    public function ConsumirAlimento(Lote $lote)
    {
        //$alimentos = Alimento::all();
        $lotes = Lote::all();
        return view('consumo_alimentos.consumo-alimentos', compact('lotes'))
        ->with('alimentos', Alimento::all());
    }

    public function relacionarConsumoAlimentos (Request $request, Lote $lote)
    {
        $alimento_id = $request->alimento_id;
    $lote_id = $request->lote_id; // Obtener el ID del lote del formulario

    // Validar si el ID del lote no es nulo
    if (!$lote_id) {
        return back()->with('error', 'No se seleccionó un lote válido.');
    }

    $lote = Lote::findOrFail($lote_id); // Obtener el modelo de Lote utilizando el ID

    $lote->alimentos()->sync($alimento_id);

    return redirect()->route('consumo.show', $lote_id);
    }
}
