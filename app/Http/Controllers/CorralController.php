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
    public function index()
    {
        $corrales = Auth::user()->corral;
        return view('corrales/corralIndex', compact('corrales'));
    }

    public function search(Request $request){
        $search3 = $request->search3;
        $user = Auth::user();

        $corrales = Corral::where('user_id', $user->id)
            ->where(function($query)use ($search3){

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
        ], [
            'corral_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'corral_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

        ]);

        $request->merge(['user_id'=> Auth::id()]);

        Corral::create($request->all());

        // Redireccionar
        return back()->with('success', 'Corral creado correctamente.');
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
        ], [
            'corral_nombre.required' => 'El campo NOMBRE es obligatorio.',
            'corral_nombre.max' => 'El campo NOMBRE no puede tener más de 255 caracteres.',

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
