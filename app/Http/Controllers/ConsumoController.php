<?php

namespace App\Http\Controllers;

use App\Exports\ConsumosExport;
use App\Models\Alimento;
use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\Consumo;
use App\Models\animal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $user = Auth::user();

        $query = Consumo::where('user_id', $user->id)->with('alimento', 'lote');

        // Aplicar filtro por lote
        if ($request->has('lote_id_consumo') && $request->lote_id_consumo != '') {
            $query->where('lote_id_consumo', $request->lote_id_consumo);
        }

        // Aplicar ordenación
        $validSortDirections = ['asc', 'desc'];
        if ($request->has('sort_by') && in_array($request->sort_direction, $validSortDirections)) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        } else {
            $query->orderBy('fecha_consumo', 'asc'); // Ordenación por defecto
        }
        $consumos = $query->get();

        $lotes = Lote::where('user_id', $user->id)->get();

        return view('consumos.consumoIndex', compact('consumos', 'lotes'));
    }


    public function export(){
        $userId = Auth::id();
        return Excel::download(new ConsumosExport($userId), 'Consumos.xlsx');
    }
 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $alimentos = Alimento::where('user_id', $userId)->get();
        $lotes = Lote::where('user_id', $userId)->get();
        
        return view('consumos.consumoCreate', compact('lotes','alimentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'alimento_id_consumo'=>'required|max:255',
            'alimento_cantidad_total'=>'required|numeric',
            'fecha_consumo'=>'required',
            'lote_id_consumo'=>'required',
        ], [
            'alimento_id_consumo.required' => 'El campo ALIMENTO es obligatorio.',
            'alimento_id_consumo.max' => 'El campo ALIMENTO no puede tener más de 255 caracteres.',
            'alimento_cantidad_total.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad_total.numeric' => 'El campo CANTIDAD debe ser un número válido.',

            'fecha_consumo.required' => 'El campo FECHA es obligatorio.',
            'lote_id_consumo.required' => 'El campo LOTE es obligatorio.',

        ]);
        $request->merge(['user_id'=> Auth::id()]);

        

        // Obtener el lote correspondiente
        $lote = Lote::find($request->lote_id_consumo);

        $alimento = Alimento::find($request->alimento_id_consumo);

        $request->merge(['valor_dieta' => $alimento->alimento_costo * $request->alimento_cantidad_total]);
        $request->merge(['animales_cantidad' => $lote->lote_cantidad]);

        if($alimento->alimento_cantidad >= $request->alimento_cantidad_total){
            $alimento->alimento_cantidad -= $request->alimento_cantidad_total;
            $alimento->save();

            //
            if ($lote->lote_cantidad > 0) {
            $costoPorAnimal = $request->valor_dieta / $lote->lote_cantidad;
            } else {
                // Si no hay animales en el lote, asignamos directamente el consumo total
                return redirect()->back()->withErrors(['lote_id_consumo' => 'Este lote esta vacío.']);
            }

            // Actualizar el consumo total del lote
            $lote->costo_total_alimento += $request->valor_dieta;
            $lote->save();
            //valor_dieta
        }else{
            return redirect()->back()->withErrors(['alimento_cantidad_total' => 'No hay suficiente cantidad de alimento en el inventario.']);
        }


         // Calcular el consumo por animal
        if ($lote->lote_cantidad > 0) {
            $consumoPorAnimal = $request->alimento_cantidad_total / $lote->lote_cantidad;
        } else {
            // Si no hay animales en el lote, asignamos directamente el consumo total
            return redirect()->back()->withErrors(['lote_id_consumo' => 'Este lote esta vacío.']);
        }

        $lote->consumo_total_alimento += $request->alimento_cantidad_total;
        $lote->save();

        $animales = Animal::where('animal_id_lote', $lote->id)->get();

        foreach ($animales as $animal) {
            $animal->consumo_total += $consumoPorAnimal;
            $animal->costo_total += $costoPorAnimal;
            $animal->save();
        }

        Consumo::create($request->all());
        // Redireccionar
        return redirect()->route('consumo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumo $consumo)
    {
        $nombre_lote = Lote::find($consumo->lote_id_consumo)->lote_nombre;
        $alimento_descripcion = Alimento::find($consumo->alimento_id_consumo)->alimento_descripcion;
        return view('consumos.show', compact('consumo','nombre_lote','alimento_descripcion'));
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
