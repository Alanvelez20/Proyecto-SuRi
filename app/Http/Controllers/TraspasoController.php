<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;


class TraspasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        // ->only()
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lotes = Lote::all();
        $animales = Animal::all();

        return view('traspasos.traspasoCreate', compact('lotes', 'animales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lote_origen' => 'required|exists:lotes,id',
            'animal_arete' => 'required|exists:animals,arete',
            'lote_destino' => 'required|exists:lotes,id',
        ]);

        if ($request->lote_origen == $request->lote_destino) {
            return redirect()->back()->withErrors(['lote_destino' => 'El lote de destino debe ser diferente al lote de origen.']);
        }

        $animal = Animal::where('arete', $request->animal_arete)->firstOrFail();
        $loteOrigen = Lote::findOrFail($request->lote_origen);
        $loteDestino = Lote::findOrFail($request->lote_destino);

        // Verificar que el animal esté en el lote de origen
        if ($animal->animal_id_lote != $loteOrigen->id) {
            return redirect()->back()->withErrors(['animal_arete' => 'El animal no pertenece al lote de origen seleccionado.']);
        }

        // Actualizar el ID del lote del animal
        $animal->animal_id_lote = $request->lote_destino;
        $animal->save();

        // Disminuir la cantidad de animales en el lote de origen
        $loteOrigen->decrement('lote_cantidad');

        // Aumentar la cantidad de animales en el lote de destino
        $loteDestino->increment('lote_cantidad');

        return redirect()->route('animal.index')->with('success', 'Animal traspasado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
