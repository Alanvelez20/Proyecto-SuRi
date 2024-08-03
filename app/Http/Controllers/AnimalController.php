<?php

namespace App\Http\Controllers;

use App\Models\animal;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AnimalsExport;
use App\Imports\AnimalsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
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
        // Obtener el usuario autenticado
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

        // Consulta base para los animales del usuario autenticado
        $query = Animal::where('user_id', $user->id)->with('lote');

        // Aplicar filtros si están presentes
        if ($request->filled('especie_filter')) {
            $query->where('animal_especie', $request->especie_filter);
        }
        if ($request->filled('genero_filter')) {
            $query->where('animal_genero', $request->genero_filter);
        }
        if ($request->filled('lote_filter')) {
            $query->where('animal_id_lote', $request->lote_filter);
        }

        // Aplicar filtro por mes
        if ($request->has('mes_ingreso') && $request->mes_ingreso != '') {
            $mes = $request->mes_ingreso;
            $query->whereMonth('fecha_ingreso', '=', $mes);
        }

        // Aplicar filtro por año
        if ($request->has('anio_ingreso') && $request->anio_ingreso != '') {
            $anio = $request->anio_ingreso;
            $query->whereYear('fecha_ingreso', '=', $anio);
        }

        // Verificar si se solicita una ordenación específica
        $validSortDirections = ['asc', 'desc'];
        if ($request->has('sort_by') && in_array($request->sort_direction, $validSortDirections)) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }
        else {
            $query->orderBy('arete', 'asc'); // Ordenación por defecto
        }

        // Obtener los animales con los criterios especificados
        $animales = $query->get();

        // Datos para la gráfica de género
        $genderData = [
            'labels' => ['Machos', 'Hembras'],
            'datasets' => [
                [
                    'data' => [
                        $animales->where('animal_genero', 'Macho')->count(),
                        $animales->where('animal_genero', 'Hembra')->count()
                    ],
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                    'borderWidth' => 2
                ]
            ]
        ];

        // Datos para la gráfica de lotes
        $loteData = Animal::where('animals.user_id', $user->id)
            ->join('lotes', 'animals.animal_id_lote', '=', 'lotes.id')
            ->select('lotes.lote_nombre', DB::raw('count(*) as total'))
            ->groupBy('lotes.lote_nombre')
            ->pluck('total', 'lotes.lote_nombre')
            ->all();

        // Obtener especies y géneros únicos para los filtros
        $especies = Animal::where('user_id', $user->id)->select('animal_especie')->distinct()->pluck('animal_especie');
        $generos = Animal::where('user_id', $user->id)->select('animal_genero')->distinct()->pluck('animal_genero');
        $lotes = Lote::where('user_id', $user->id)->get();
        $totalAnimales = $animales->count();
        $totalConsumoAlimento = $animales->sum('consumo_total');
        $totalCostoAlimento = $animales->sum('costo_total');

        return view('animales.animalIndex', compact('animales', 'genderData', 'loteData', 'especies', 
        'generos', 'lotes','totalConsumoAlimento','totalCostoAlimento','meses','totalAnimales'));
    }

    public function showImportForm()
    {
        return view('animales.animalImport');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new AnimalsImport, $request->file('file'));

        return redirect()->route('animal.index')->with('success', 'Alimentos importados correctamente.');
    }

    public function export(){
        $userId = Auth::id();
        return Excel::download(new AnimalsExport($userId), 'Animales.xlsx');
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $lotes = Lote::where('user_id', $user->id)->get();
        return view('animales.animalCreate', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'arete'=>'required|integer',
            'animal_especie'=>'required|max:255',
            'animal_genero'=>'required|max:255',
            'animal_peso_inicial'=>'required|numeric',
            'animal_valor_compra'=>'required|numeric',
            'fecha_ingreso'=>'required',
            'animal_id_lote'=>'required|integer',
        ], [
            'arete.required'=>'El campo ARETE es obligatorio.',
            'arete.integer'=>'El campo ARETE debe ser un número ENTERO válido.',
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso.required' => 'El campo PESO es obligatorio.',
            'animal_peso.numeric' => 'El campo PESO debe ser un número válido.',
            'animal_valor_compra.required' => 'El campo VALOR DE COMPRA es obligatorio.',
            'animal_valor_compra.numeric' => 'El campo VALOR DE COMPRA debe ser un número válido.',
            'fecha_ingreso.required' => 'El campo FECHA es obligatorio.',
            'animal_id_lote.required' => 'El campo NUMERO DE LOTE es obligatorio.',
            'animal_id_lote.integer' => 'El campo NUMERO DE LOTE debe ser un número ENTERO válido.',

        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el arete ya existe para este usuario
        $exists = Animal::where('user_id', $user->id)
                        ->where('arete', $request->input('arete'))
                        ->exists();

        if ($exists) {
            return back()->withErrors(['arete' => 'Este arete ya existe.'])->withInput();
        }

        $request['animal_peso_final'] = $request['animal_peso_inicial'];
        $request->merge(['consumo_total' => 0]);
        $request->merge(['costo_total' => 0]);
        $request->merge(['user_id'=> $user->id]);

        Animal::create($request->all());

        // Incrementa la cantidad en el lote correspondiente
        $lote = Lote::findOrFail($request->animal_id_lote);
        $lote->increment('lote_cantidad');

        // Redireccionar
        return redirect()->route('animal.index')->with('success', 'Animal agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(animal $animal)
    {
        $user = Auth::user();
        $animal = Animal::where('arete', $animal->arete)->where('user_id', $user->id)->firstOrFail();
        $nombre_lote = Lote::find($animal->animal_id_lote)->lote_nombre;
        return view('animales.animalShow', compact('animal', 'nombre_lote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(animal $animal)
    {
        $user = Auth::user();
        $lotes = Lote::where('user_id', $user->id)->get();
        return view('animales.animalEdit', compact('animal','lotes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, animal $animal)
    {
        $request->validate([
            'animal_especie'=>'required|max:255',
            'animal_genero'=>'required|max:255',
            'animal_peso_final'=>'required|numeric',
        ], [
            'animal_especie.required' => 'El campo ESPECIE es obligatorio.',
            'animal_especie.max' => 'El campo ESPECIE no puede tener más de 255 caracteres.',
            'animal_genero.required' => 'El campo GENERO es obligatorio.',
            'animal_genero.max' => 'El campo GENERO no puede tener más de 255 caracteres.',

            'animal_peso_final.required' => 'El campo PESO ACTUAL es obligatorio.',
            'animal_peso_final.numeric' => 'El campo PESO ACTUAL debe ser un número válido.',

        ]);

        $animal->update($request->all());

        return redirect()->route('animal.show', $animal);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $animal = Animal::where('arete', $id)->where('user_id', $user->id)->firstOrFail();
        $animal->delete();
        return redirect()->route('animal.index');
    }

    

}
