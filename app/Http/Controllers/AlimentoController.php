<?php

namespace App\Http\Controllers;

use App\Mail\RegistroAlimento;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AlimentoController extends Controller
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
        $query = Alimento::query();
        // Verificar si se solicita una ordenación específica
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }

        $alimentos = $query->get();
        return view('alimentos.alimentoIndex', compact('alimentos'));
    }

    public function search(Request $request){
        $search4 = $request->search4;

        $alimentos = Alimento::where(function($query)use ($search4){

            $query->where('alimento_descripcion','like',"%$search4%");
        })
        ->get();
        return view('alimentos.alimentoIndex',compact('alimentos','search4'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alimentos.alimentoCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alimento_descripcion'=>'required|max:255',
            'alimento_cantidad'=>'required|integer',
            'alimento_costo'=>'required|numeric',
        ], [
            'alimento_descripcion.required' => 'El campo DESCRIPCION es obligatorio.',
            'alimento_descripcion.max' => 'El campo DESCRIPCION no puede tener más de 255 caracteres.',
            'alimento_cantidad.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad.integer' => 'El campo CANTIDAD debe ser un número ENTERO válido.',
            'alimento_costo.required' => 'El campo COSTO es obligatorio.',
            'alimento_costo.numeric' => 'El campo COSTO debe ser un número válido.',

        ]);

        // Verificar si se ha proporcionado un archivo y si es válido
    if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
        // Procesar la imagen si es válida
        $request->merge([
            'user_id' => Auth::id(),
            'archivo_nombre' => $request->file('archivo')->getClientOriginalName(),
            'archivo_ubicacion' => $request->file('archivo')->store('public'),
        ]);
    } else {
        // Opcional: Manejar caso donde no se proporcionó un archivo válido
        // Puedes agregar código adicional aquí según tus requerimientos
        // Por ejemplo, establecer valores por defecto para 'archivo_nombre' y 'archivo_ubicacion'
        $request->merge([
            'user_id' => Auth::id(),
            'archivo_nombre' => 0,
            'archivo_ubicacion' => 0,
        ]);
    }

    // Crear el registro de alimento
    $alimento = Alimento::create($request->all());

    // Obtener el usuario autenticado
    $user = Auth::user();

    // Enviar correo de confirmación
    Mail::to($user->email)->send(new RegistroAlimento($alimento, $user));

    // Redireccionar
    return redirect()->route('alimento.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Alimento $alimento)
    {
        return view('alimentos.alimentoShow', compact('alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alimento $alimento)
    {
        return view('alimentos.alimentoEdit', compact('alimento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alimento $alimento)
    {
        $request->validate([
            'alimento_descripcion'=>'required|max:255',
            'alimento_cantidad'=>'required|integer',
            'alimento_costo'=>'required|numeric',
        ], [
            'alimento_descripcion.required' => 'El campo DESCRIPCION es obligatorio.',
            'alimento_descripcion.max' => 'El campo DESCRIPCION no puede tener más de 255 caracteres.',
            'alimento_cantidad.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad.integer' => 'El campo CANTIDAD debe ser un número ENTERO válido.',
            'alimento_costo.required' => 'El campo COSTO es obligatorio.',
            'alimento_costo.numeric' => 'El campo COSTO debe ser un número válido.',

        ]);

        $alimento->update($request->all());

        return redirect()->route('alimento.show', $alimento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alimento::find($id)->delete();
        return redirect()->route('alimento.index');
    }

    public function descargar(Alimento $alimento){
        if ($alimento->archivo_ubicacion !="null") {
            return Storage::download($alimento->archivo_ubicacion);
        }else{
            return back()->with('warning', 'El archivo no existe.');
        }
    }
}
