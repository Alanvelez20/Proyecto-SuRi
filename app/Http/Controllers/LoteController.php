<?php

namespace App\Http\Controllers;

use App\Exports\LotesExport;
use App\Models\Lote;
use App\Models\Corral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LoteController extends Controller
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

        // Consulta base para los lotes del usuario autenticado
        $query = Lote::where('user_id', $user->id)->with('corral');
    
        if ($request->has('corral_filter') && !empty($request->corral_filter)) {
            $query->whereHas('corral', function($q) use ($request) {
                $q->where('id', $request->corral_filter);
            });
        }
    
        // Verificar si se solicita una ordenación específica
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }
    
        // Obtener los lotes con los criterios especificados
        $lotes = $query->get();
    
        // Calcular totales
        $totalLotes = $lotes->count();
        $totalConsumoAlimento = $lotes->sum('consumo_total_alimento');
        $totalCostoAlimento = $lotes->sum('costo_total_alimento');
    
        $corrales = Corral::where('user_id', $user->id)->get();

        return view('lotes.loteIndex', compact('lotes', 'totalLotes', 'totalConsumoAlimento', 'totalCostoAlimento', 'corrales'));

    }

    public function export(){
        $userId = Auth::id();
        return Excel::download(new LotesExport($userId), 'Lotes.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $corrales = Corral::where('user_id', $user->id)->get();
        return view('lotes.loteCreate', compact('corrales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lote_nombre'=>'required|max:255',
            'lote_id_corral'=>'required|integer',
        ], [
            'lote_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'lote_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

            'lote_id_corral.required' => 'El campo ID del CORRAL es obligatorio y debe existir de antes.',
            'lote_id_corral.integer' => 'El campo ID del CORRAL debe ser un número entero válido.',

        ]);

        $request->merge(['user_id'=> Auth::id()]);
        $request->merge(['lote_cantidad' => 0]);
        $request->merge(['consumo_total_alimento' => 0]);
        $request->merge(['costo_total_alimento' => 0]);
        
        Lote::create($request->all());

        // Redireccionar
        return back()->with('success', 'Corral creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lote $lote)
    {
        $nombre_corral = Corral::find($lote->lote_id_corral)->corral_nombre;
        return view('lotes.loteShow', compact('lote', 'nombre_corral'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lote $lote)
    {
        $user = Auth::user();
        $lote = Lote::where('id', $lote->id)->where('user_id', $user->id)->firstOrFail();
        $corrales = Corral::where('user_id', $user->id)->get();
        return view('lotes.loteEdit', compact('lote', 'corrales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lote $lote )
    {
        $request->validate([
            'lote_nombre'=>'required|max:255',
            'lote_id_corral'=>'required|integer',
        ], [
            'lote_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'lote_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

            'lote_id_corral.required' => 'El campo ID del CORRAL es obligatorio.',
            'lote_id_corral.integer' => 'El campo ID del CORRAL debe ser un número entero válido.',

        ]);

        $request->offsetUnset('lote_cantidad');
        $lote->update($request->all());

        return redirect()->route('lote.show', $lote);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Lote::find($id)->delete();
        return redirect()->route('lote.index');
    }

}
