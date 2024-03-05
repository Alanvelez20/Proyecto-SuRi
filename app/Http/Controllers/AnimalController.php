<?php

namespace App\Http\Controllers;

use App\Models\animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animales = animal::all();
        return view('animales/animalIndex', compact('animales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('animales.animalCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $animal = new animal();
        $animal->animal_especie = $request->animal_especie;
        $animal->animal_genero = $request->animal_genero;
        $animal->animal_peso = $request->animal_peso;
        $animal->animal_valor_compra = $request->animal_valor_compra;
        $animal->animal_valor_venta = $request->animal_valor_compra;
        $animal->animal_id_lote = $request->animal_id_lote;

        $animal->save();

        // Redireccionar
        return redirect()->route('animal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(animal $animal)
    {
        return view('animales.animalShow', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(animal $animal)
    {
        return view('animales.animalEdit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, animal $animal)
    {
        $animal->animal_especie = $request->animal_especie;
        $animal->animal_genero = $request->animal_genero;
        $animal->animal_peso = $request->animal_peso;
        $animal->animal_valor_compra = $request->animal_valor_compra;
        $animal->animal_valor_venta = $request->animal_valor_compra;
        $animal->animal_id_lote = $request->animal_id_lote;

        $animal->save();

        return redirect()->route('animal.show', $animal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(animal $animal)
    {
        $animal->delete();
        return redirect()->route('animal.index');
    }
}
