<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\animal;
use App\Models\Lote;
use App\Models\Corral;
use Database\Factories\AnimalFactory;
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
    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();


        $query = animal::where('user_id', $user->id)->with('lote');
        // Verificar si se solicita una ordenación específica
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }

        $animales = $query->get();
        return view('animales/animalIndex', compact('animales'));

    }

    public function search(Request $request){
        $search1 = $request->search1;

        $animales = animal::where(function($query)use ($search1){

            $query->where('animal_especie','like',"%$search1%")
            ->orWhere('animal_genero','like',"%$search1%");
        })
        ->get();
        return view('animales.animalIndex',compact('animales','search1'));
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
            'arete'=>'required|integer|unique:animals,arete',
            'animal_especie'=>'required|max:255',
            'animal_genero'=>'required|max:255',
            'animal_peso_inicial'=>'required|numeric',
            'animal_valor_compra'=>'required|numeric',
            'fecha_ingreso'=>'required',
            'animal_id_lote'=>'required|integer',
        ], [
            'arete.required'=>'El campo ARETE es obligatorio.',
            'arete.integer'=>'El campo ARETE debe ser un número ENTERO válido.',
            'arete.unique' => 'El campo ARETE ya existe en la base de datos, debe ser único.',
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso.required' => 'El campo PESO es obligatorio.',
            'animal_peso.numeric' => 'El campo PESO debe ser un número válido.',
            'animal_valor_compra.required' => 'El campo VALOR DE COMPRA es obligatorio.',
            'animal_valor_compra.numeric' => 'El campo VALOR DE COMPRA debe ser un número válido.',
            'fecha_ingreso.required' => 'El campo FECHA es obligatorio.',
            'animal_id_lote.required' => 'El campo NUMERO DE LOTE es obligatorio.',
            'animal_id_lote.integer' => 'El campo NUMERO DE LOTE debe ser un número ENTERO válido.',

        ]);

        $request['animal_valor_venta'] = $request['animal_valor_compra'];
        $request['animal_peso_final'] = $request['animal_peso_inicial'];
        $request->merge(['consumo_total' => 0]);
        $request->merge(['costo_total' => 0]);
        $request->merge(['user_id'=> Auth::id()]);

        Animal::create($request->all());

        // Incrementa la cantidad en el lote correspondiente
        $lote = Lote::findOrFail($request->animal_id_lote);
        $lote->increment('lote_cantidad');

        // Redireccionar
        return redirect()->route('animal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(animal $animal)
    {
        $nombre_lote = Lote::find($animal->animal_id_lote)->lote_nombre;
        return view('animales.animalShow', compact('animal', 'nombre_lote'));
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
            'animal_peso_final'=>'required|numeric',
            'animal_valor_venta'=>'required|numeric',
            'animal_id_lote'=>'required|integer',
        ], [
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso_final.required' => 'El campo PESO ACTUAL es obligatorio.',
            'animal_peso_final.numeric' => 'El campo PESO ACTUAL debe ser un número válido.',
            'animal_valor_venta.required' => 'El campo VALOR ACTUAL es obligatorio.',
            'animal_valor_venta.numeric' => 'El campo VALOR ACTUAL debe ser un número válido.',
            'animal_id_lote.required' => 'El campo NUMERO DE LOTE es obligatorio.',
            'animal_id_lote.integer' => 'El campo NUMERO DE LOTE debe ser un número ENTERO válido.',

        ]);

        $animal->update($request->all());

        return redirect()->route('animal.show', $animal);
    }

    public function destroy($id)
    {
        animal::find($id)->delete();
        return redirect()->route('animal.index');

    }

    

}
