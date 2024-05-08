<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\animal;
use App\Models\Lote;
use App\Models\Corral;
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
        $lotes = Lote::all();
        return view('animales.animalCreate', compact('lotes'));
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
        ], [
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso.required' => 'El campo PESO es obligatorio.',
            'animal_peso.numeric' => 'El campo PESO debe ser un número válido.',
            'animal_valor_compra.required' => 'El campo VALOR DE COMPRA es obligatorio.',
            'animal_valor_compra.numeric' => 'El campo VALOR DE COMPRA debe ser un número válido.',
            'animal_id_lote.required' => 'El campo NUMERO DE LOTE es obligatorio.',
            'animal_id_lote.integer' => 'El campo NUMERO DE LOTE debe ser un número ENTERO válido.',

        ]);

        $request['animal_valor_venta'] = $request['animal_valor_compra'];
        $request->merge(['user_id'=> Auth::id()]);

        Animal::create($request->all());

        // Incrementa la cantidad en el lote correspondiente
        $lote = Lote::findOrFail($request->animal_id_lote);
        $lote->increment('lote_cantidad');

         // Cambia el estado del corral de vacío a ocupado
        $corral = Corral::findOrFail($lote->lote_id_corral);
        $corral->corral_estado = 'Ocupado';
        $corral->save();

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
        $lotes = Lote::all();
        return view('animales.animalEdit', compact('animal','lotes'));
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
        ], [
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso.required' => 'El campo PESO es obligatorio.',
            'animal_peso.numeric' => 'El campo PESO debe ser un número válido.',
            'animal_valor_compra.required' => 'El campo VALOR DE COMPRA es obligatorio.',
            'animal_valor_compra.numeric' => 'El campo VALOR DE COMPRA debe ser un número válido.',
            'animal_id_lote.required' => 'El campo NUMERO DE LOTE es obligatorio.',
            'animal_id_lote.integer' => 'El campo NUMERO DE LOTE debe ser un número ENTERO válido.',

        ]);

        $request['animal_valor_venta'] = $request['animal_valor_compra'];

        $animal->update($request->all());

        return redirect()->route('animal.show', $animal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        animal::find($id)->delete();
        return redirect()->route('animal.index');

    }

    

}
