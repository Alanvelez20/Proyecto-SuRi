<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\Consumo;
use App\Models\animal;
use Illuminate\Support\Facades\Auth;

class ConsumoController extends Controller
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
        $query = Consumo::query();
        // Verificar si se solicita una ordenación específica
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }

        $consumos = $query->get();
        return view('consumos.consumoIndex', compact('consumos'));

        $consumos = Auth::user()->consumos;
        return view('consumos.consumoIndex', compact('consumos'));
    }
 
    public function search(Request $request){
        $search0 = $request->search0;

        $consumos = Consumo::where(function($query)use ($search0){

            $query->where('alimento_descripcion','like',"%$search0%")
            ->orWhere('fecha_consumo','like',"%$search0%")
            ->orWhere('hora_consumo','like',"%$search0%");
        })
        ->get();
        return view('consumos.consumoIndex',compact('consumos','search0'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $lotes = Lote::all();
        return view('consumos.consumoCreate', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'alimento_descripcion'=>'required|max:255',
            'alimento_cantidad_total'=>'required|numeric',
            'valor_dieta'=>'required|numeric',
            'fecha_consumo'=>'required',
            'hora_consumo'=>'required|max:255',
            'lote_id_consumo'=>'required',
        ], [
            'alimento_descripcion.required' => 'El campo ALIMENTO es obligatorio.',
            'alimento_descripcion.max' => 'El campo ALIMENTO no puede tener más de 255 caracteres.',
            'alimento_cantidad_total.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad_total.numeric' => 'El campo CANTIDAD debe ser un número válido.',
            'valor_dieta.required' => 'El campo COSTO es obligatorio.',
            'valor_dieta.numeric' => 'El campo COSTO debe ser un número válido.',

            'fecha_consumo.required' => 'El campo FECHA es obligatorio.',
            'hora_consumo.required' => 'El campo HORARIO es obligatorio.',
            'hora_consumo.numeric' => 'El campo HORARIO debe ser un número válido.',
            'lote_id_consumo.required' => 'El campo LOTE es obligatorio.',

        ]);
        $request->merge(['user_id'=> Auth::id()]);

        Consumo::create($request->all());

        // Obtener el lote correspondiente
        $lote = Lote::find($request->lote_id_consumo);

         // Calcular el consumo por animal
        if ($lote->lote_cantidad > 0) {
            $consumoPorAnimal = $request->alimento_cantidad_total / $lote->lote_cantidad;
        } else {
            // Si no hay animales en el lote, asignamos directamente el consumo total
            $consumoPorAnimal = $request->alimento_cantidad_total;
        }

        // Actualizar el consumo total del lote
        $lote->consumo_total_alimento += $request->alimento_cantidad_total;
        $lote->save();

        // Actualizar el consumo total por animal en la tabla animales
        // Primero obtenemos todos los animales del lote
        $animales = Animal::where('animal_id_lote', $lote->id)->get();

        // Iteramos sobre cada animal y actualizamos su consumo total
        foreach ($animales as $animal) {
            $animal->consumo_total += $consumoPorAnimal;
            $animal->save();
        }
        // Redireccionar
        return redirect()->route('consumo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumo $consumo)
    {
        $nombre_lote = Lote::find($consumo->lote_id_consumo)->lote_nombre;
        return view('consumos.show', compact('consumo','nombre_lote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumo $consumo)
    {
        //No se puede editar un consumo
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumo $consumo)
    {
        //No se puede editar un consumo
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //No se puede eliminar un consumo
    }

}
