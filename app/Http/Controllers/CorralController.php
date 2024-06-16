<?php

namespace App\Http\Controllers;

use App\Models\Corral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorralController extends Controller
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
        $corrales = Auth::user()->corral;
        return view('corrales/corralIndex', compact('corrales'));
    }

    public function search(Request $request){
        $search3 = $request->search3;

        $corrales = Corral::where(function($query)use ($search3){

            $query->where('corral_nombre','like',"%$search3%");
        })
        ->get();
        return view('corrales/corralIndex',compact('corrales','search3'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('corrales.corralCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'corral_nombre'=>'required|max:255',
            'corral_estado'=>'required|max:255',
        ], [
            'corral_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'corral_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',
            'corral_estado.required' => 'El campo ESTADO es obligatorio.',
            'corral_estado.max' => 'El campo ESTADO no puede tener más de 255 caracteres.',

        ]);

        $request->merge(['user_id'=> Auth::id()]);

        Corral::create($request->all());

        // Redireccionar
        return redirect()->route('corral.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Corral $corral)
    {
        return view('corrales.corralShow', compact('corral'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Corral $corral)
    {
        return view('corrales.corralEdit', compact('corral'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Corral $corral)
    {
        $request->validate([
            'corral_nombre'=>'required|max:255',
            'corral_estado'=>'required|max:255',
        ], [
            'corral_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'corral_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',
            'corral_estado.required' => 'El campo ESTADO es obligatorio.',
            'corral_estado.max' => 'El campo ESTADO no puede tener más de 255 caracteres.',

        ]);

        $corral->update($request->all());

        return redirect()->route('corral.show', $corral);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Corral::find($id)->delete();
        return redirect()->route('corral.index');
    }
}
