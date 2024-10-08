<?php

namespace App\Http\Controllers;

use App\Exports\ConsumosExport;
use App\Models\Alimento;
use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\Consumo;
use App\Models\animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ConsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->subscription_active) {
                return redirect('/suscripcion')->with('error', '¡Debes contar con una suscripción!.');
            }

            return $next($request);
        })->except('index');;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
    
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $query = Consumo::where('user_id', $user->id)->with('alimento', 'lote');

        // Aplicar filtro por lote
        if ($request->has('lote_id_consumo') && $request->lote_id_consumo != '') {
            $query->where('lote_id_consumo', $request->lote_id_consumo);
        }

        // Filtro por alimento
        if ($request->has('alimento_id') && $request->alimento_id != '') {
            $query->where('alimento_id_consumo', $request->alimento_id);
        }

        // Aplicar filtro por mes
        if ($request->has('mes_consumo') && $request->mes_consumo != '') {
            $mes = $request->mes_consumo;
            $query->whereMonth('fecha_consumo', '=', $mes);
        }

        // Aplicar filtro por año
        if ($request->has('anio_consumo') && $request->anio_consumo != '') {
            $anio = $request->anio_consumo;
            $query->whereYear('fecha_consumo', '=', $anio);
        }

        // Aplicar ordenación
        $validSortDirections = ['asc', 'desc'];
        if ($request->has('sort_by') && in_array($request->sort_direction, $validSortDirections)) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        } else {
            $query->orderBy('fecha_consumo', 'asc'); // Ordenación por defecto
        }

        $consumos = $query->get();

        // Calcular los totales
        $totalAlimentoCantidad = $consumos->sum('alimento_cantidad_total');
        $totalCostoAlimento = $consumos->sum('valor_dieta');

        $lotes = Lote::where('user_id', $user->id)->get();
        $alimentos = Alimento::where('user_id', $user->id)->get();

        return view('consumos.consumoIndex', compact('consumos', 'lotes', 'alimentos', 'totalAlimentoCantidad', 'totalCostoAlimento','meses'));
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

            $lote->costo_total_alimento += $request->valor_dieta;
            $lote->save();
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

        DB::table('animals')
            ->where('animal_id_lote', $lote->id)
            ->where('user_id', Auth::id())
            ->update([
                'consumo_total' => DB::raw('consumo_total + ' . $consumoPorAnimal),
                'costo_total' => DB::raw('costo_total + ' . $costoPorAnimal),
            ]);

        Consumo::create($request->all());
        
        return redirect()->route('consumo.create')->with('success', 'Consumo generado correctamente.');
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
        return view('consumos.consumoEdit', compact('consumo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumo $consumo)
    {
        $request->validate([
            'fecha_consumo'=>'required',
        ], [
            'fecha_consumo.required' => 'El campo FECHA es obligatorio.',
        ]);

        // Actualizar solo la fecha del consumo
        $consumo->update([
            'fecha_consumo' => $request->fecha_consumo,
        ]);

        return redirect()->route('consumo.show', $consumo)->with('success', 'Fecha del consumo actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //No se puede eliminar un consumo
    }

}
