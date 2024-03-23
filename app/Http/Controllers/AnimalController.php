<?php

namespace App\Http\Controllers;

use App\Models\animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
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
        $animales = Auth::user()->animal;
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

        $request->validate([
            'animal_especie'=>'required|max:255',
            'animal_genero'=>'required|max:255',
            'animal_peso'=>'required|numeric',
            'animal_valor_compra'=>'required|numeric',
            'animal_id_lote'=>'required|integer',
        ]);

        $request['animal_valor_venta'] = $request['animal_valor_compra'];
        $request->merge(['user_id'=> Auth::id()]);

        Animal::create($request->all());

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
        $request->validate([
            'animal_especie'=>'required|max:255',
            'animal_genero'=>'required|max:255',
            'animal_peso'=>'required|numeric',
            'animal_valor_compra'=>'required|numeric',
            'animal_id_lote'=>'required|integer',
        ]);

        $request['animal_valor_venta'] = $request['animal_valor_compra'];

        $animal->update($request->all());

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
