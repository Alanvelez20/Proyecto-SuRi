<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TraspasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $lotes = Lote::where('user_id', $user->id)->get();
        $animales = Animal::where('user_id', $user->id)->get();

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

        // Buscar y actualizar el animal directamente en la base de datos
        $affectedRows = DB::table('animals')
        ->where('arete', $request->animal_arete)
        ->where('animal_id_lote', $request->lote_origen)
        ->where('user_id', Auth::id())
        ->update(['animal_id_lote' => $request->lote_destino]);

        if ($affectedRows === 0) {
            return redirect()->back()->withErrors(['animal_arete' => 'El animal no se encontró en el lote de origen seleccionado para el usuario actual.']);
        }

        // Actualizar las cantidades en los lotes
        DB::table('lotes')
            ->where('id', $request->lote_origen)
            ->decrement('lote_cantidad');

        DB::table('lotes')
            ->where('id', $request->lote_destino)
            ->increment('lote_cantidad');

        

        return redirect()->route('traspaso.create')->with('success', 'Animal traspasado exitosamente.');
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
