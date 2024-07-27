<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use Illuminate\Http\Request;
use App\Models\animal;
use App\Models\Venta;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        // ->only()
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Venta::where('user_id', $user->id);
        
        // Aplicar filtros por especie y género
        if ($request->has('especie_filter') && $request->especie_filter != '') {
            $query->where('animal_especie', $request->especie_filter);
        }

        if ($request->has('genero_filter') && $request->genero_filter != '') {
            $query->where('animal_genero', $request->genero_filter);
        }
        
        // Aplicar ordenación
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        } else {
            $query->orderBy('arete', 'asc'); // Ordenación por defecto
        }
        
        $ventas = $query->get();
        
        // Obtener todas las especies y géneros únicos para los filtros
        $especies = Venta::where('user_id', $user->id)->distinct()->pluck('animal_especie');
        $generos = Venta::where('user_id', $user->id)->distinct()->pluck('animal_genero');

        return view('ventas.ventaIndex', compact('ventas', 'especies', 'generos'));
    }



    public function export(){
        $userId = Auth::id();
        return Excel::download(new VentasExport($userId), 'Ventas.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $animales = animal::where('user_id', $userId)->get();
        return view('ventas.ventaCreate', compact('animales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'animal_arete' => 'required|exists:animals,arete',
            'animal_peso_final' => 'required|numeric',
            'fecha_venta' => 'required|date',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar el animal del usuario autenticado
        $animal = Animal::where('arete', $request->animal_arete)
                        ->where('user_id', $user->id)
                        ->firstOrFail();

        // Buscar el lote del animal
        $lote = Lote::findOrFail($animal->animal_id_lote);
        
        // Crear un registro de venta
        Venta::create([
            'arete' => $animal->arete,
            'animal_especie' => $animal->animal_especie,
            'animal_genero' => $animal->animal_genero,
            'animal_peso_inicial' => $animal->animal_peso_inicial,
            'animal_peso_final' => $request->animal_peso_final,
            'animal_valor_compra' => $animal->animal_valor_compra,

            'animal_valor_venta' => ($request->animal_peso_final * $request->costo_kilo),
            'fecha_ingreso' => $animal->fecha_ingreso,
            'consumo_total' => $animal->consumo_total,
            'costo_total' => $animal->costo_total,
            'fecha_venta' => $request->fecha_venta,
            'user_id'=>$user->id,
        ]);

        // Eliminar el animal de la base de datos
        $animal->delete();

        // Disminuir la cantidad de animales en el lote
        $lote->decrement('lote_cantidad');

        return redirect()->route('venta.index')->with('success', 'Venta registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($arete)
    {
        $user = Auth::user();
        $venta = Venta::where('arete', $arete)->where('user_id', $user->id)->firstOrFail();
        return view('ventas.ventaShow', compact('venta'));
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
    public function getAnimalData($arete)
    {
        $animal = Animal::where('arete', $arete)->firstOrFail();
        return response()->json($animal);
    }
}
