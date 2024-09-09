<?php

namespace App\Http\Controllers;

use App\Mail\RegistroAlimento;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Exports\AlimentosExport;
use App\Imports\AlimentosImport;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Maatwebsite\Excel\Facades\Excel;

class AlimentoController extends Controller
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
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Crear la consulta inicial para los alimentos del usuario autenticado
        $query = Alimento::where('user_id', $user->id);
    
        // Verificar si se solicita una ordenación específica
        if ($request->has('sort_by') && $request->has('sort_direction')) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }
    
        // Obtener los alimentos filtrados y ordenados
        $alimentos = $query->get();
    
        // Retornar la vista con los alimentos
        return view('alimentos.alimentoIndex', compact('alimentos'));
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new AlimentosImport, $request->file('file'));

        return redirect()->route('animales.import.form');
    }

    public function showImportForm()
    {
        return view('alimentos.alimentoImport');
    }

    public function export(){
        $userId = Auth::id();
        return Excel::download(new AlimentosExport($userId), 'Alimentos.xlsx');
    }
    

    public function search(Request $request){
        $search4 = $request->search4;

        $alimentos = Alimento::where('user_id', Auth::id())
        ->where(function($query) use ($search4) {
            $query->where('alimento_descripcion', 'like', "%$search4%");
        })
        ->get();
        return view('alimentos.alimentoIndex',compact('alimentos','search4'));
    }

    public function ShowAgregar()
    {
        $alimentos = Alimento::where('user_id', Auth::id())->get();
        return view('alimentos.AlimentoAgregar', compact('alimentos'));
    }

    public function AgregarCantidad(Request $request, Alimento $alimento)
    {
        $request->validate([
            'alimento_id' => 'required|exists:alimentos,id',
            'alimento_cantidad' => 'required|numeric|min:1',
        ], [
            'alimento_id.required' => 'El campo ALIMENTO es obligatorio.',
            'alimento_id.exists' => 'El ALIMENTO seleccionado no es válido.',
            'alimento_cantidad.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad.numeric' => 'El campo CANTIDAD debe ser un número válido.',
            'alimento_cantidad.min' => 'La cantidad debe ser al menos 1.',
        ]);

        $alimento = Alimento::where('id', $request->alimento_id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        // Cantidad y precio actuales
        $cantidad_actual = $alimento->alimento_cantidad;
        $precio_actual = $alimento->alimento_costo;

        // Nueva cantidad y precio
        $nueva_cantidad = $request->alimento_cantidad;
        $nuevo_precio = $request->alimento_precio;

        // Calcular la nueva cantidad total
        $cantidad_total = $cantidad_actual + $nueva_cantidad;

        // Calcular el nuevo precio promedio
        $nuevo_precio_promedio = (($cantidad_actual * $precio_actual) + ($nueva_cantidad * $nuevo_precio)) / $cantidad_total;

        // Actualizar los valores en el modelo
        $alimento->alimento_cantidad = $cantidad_total;
        $alimento->alimento_costo = $nuevo_precio_promedio;
        $alimento->save();

        return redirect()->route('alimento.index')->with('success', 'Cantidad añadida correctamente.');
    }

    public function ShowAdd(Alimento $alimento)
    {
        return view('alimentos.AlimentoAdd', compact('alimento'));
    }

    // Manejar la lógica para añadir la cantidad
    public function addQuantity(Request $request, Alimento $alimento)
    {
        $request->validate([
            'alimento_cantidad' => 'required|numeric|min:1',
        ], [
            'alimento_cantidad.required' => 'El campo CANTIDAD es obligatorio.',
            'alimento_cantidad.numeric' => 'El campo CANTIDAD debe ser un número válido.',
            'alimento_cantidad.min' => 'La cantidad debe ser al menos 1.',
        ]);

        // Añadir la cantidad al alimento existente
        //$alimento->alimento_cantidad += $request->alimento_cantidad;
        // Cantidad y precio actuales
        $cantidad_actual = $alimento->alimento_cantidad;
        $precio_actual = $alimento->alimento_costo;

        // Nueva cantidad y precio
        $nueva_cantidad = $request->alimento_cantidad;
        $nuevo_precio = $request->alimento_precio;

        // Calcular la nueva cantidad total
        $cantidad_total = $cantidad_actual + $nueva_cantidad;

        // Calcular el nuevo precio promedio
        $nuevo_precio_promedio = (($cantidad_actual * $precio_actual) + ($nueva_cantidad * $nuevo_precio)) / $cantidad_total;

        // Actualizar los valores en el modelo
        $alimento->alimento_cantidad = $cantidad_total;
        $alimento->alimento_costo = $nuevo_precio_promedio;
        $alimento->save();

        return redirect()->route('alimento.index')->with('success', 'Cantidad añadida correctamente.');
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
    //Mail::to($user->email)->send(new RegistroAlimento($alimento, $user));

    // Redireccionar
    return redirect()->route('alimento.create')->withSuccess('El alimento se agregó correctamente');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Alimento $alimento)
    {
        // Convertir la imagen en base64
        $base64Image = null;
        if ($alimento->archivo_ubicacion != "null" && $alimento->archivo_ubicacion != "0") {
            $filePath = storage_path('app/' . $alimento->archivo_ubicacion);
            if (file_exists($filePath)) {
                $fileContent = file_get_contents($filePath);
                $base64Image = base64_encode($fileContent);
            }
        }

        return view('alimentos.alimentoShow', compact('alimento', 'base64Image'));
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
        ], [
            'alimento_descripcion.required' => 'El campo DESCRIPCION es obligatorio.',
            'alimento_descripcion.max' => 'El campo DESCRIPCION no puede tener más de 255 caracteres.',

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
