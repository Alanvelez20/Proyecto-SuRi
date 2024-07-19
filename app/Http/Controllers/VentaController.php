<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\animal;
use App\Models\Venta;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $lote = Lote::all();
        $ventas = Venta::all();
        return view('ventas.ventaIndex', compact('ventas','lote'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animales = Animal::all();
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

        $animal = Animal::where('arete', $request->animal_arete)->firstOrFail();
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
            'user_id'=>Auth::id(),
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
    public function getAnimalData($arete)
    {
        $animal = Animal::where('arete', $arete)->firstOrFail();
        return response()->json($animal);
    }
}
