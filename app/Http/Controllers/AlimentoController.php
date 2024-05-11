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
    public function index()
    {
        $alimentos = Auth::user()->alimentos;
    return view('alimentos.alimentoIndex', compact('alimentos'));
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

        if (!$request->file('archivo')->isValid()) {
        
        }else{

        $request->merge([
            'user_id'=> Auth::id(),
            'archivo_nombre'=>$request->file('archivo')->getClientOriginalName(),
            'archivo_ubicacion'=>$request->file('archivo')->store('public'),
        ]);

        $alimento = Alimento::create($request->all());

        $user = Auth::user();
        //Se envia el correo
        Mail::to($user->email)->send(new RegistroAlimento($alimento, $user));
        //Mail::raw("Mediante este correo te confirmamos el registro de la compra de. $alimento->alimento_descripcion\nCantidad: $alimento->alimento_cantidad \nCosto: $$alimento->alimento_costo \n\n¡Gracias por utilizar nuestra aplicación!", function ($message) use ($user) {
           // $message->from('SuRi.oficial@gmail.com', 'Equipo SuRi');
           // $message->to($user->email);
           // $message->subject("Registro de inventario");
        //});
        
        // Redireccionar
        return redirect()->route('alimento.index');
        }
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
