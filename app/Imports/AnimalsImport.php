<?php

namespace App\Imports;

use App\Models\Animal;
use App\Models\Corral;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AnimalsImport implements ToCollection
{
    protected $errors = [];

    public function collection(Collection $rows)
    {
        // Omitir la primera fila de encabezados
        $rows->shift();
        $user=Auth::id();
        foreach ($rows as $row) {
            if (count($row) < 8) {
                continue;
            }

            $arete = $row[0];
            $animalEspecie = $row[1];
            $animalGenero = $row[2];
            $animalPesoInicial = $row[3];
            $animalValorCompra = $row[4];
            $fechaIngreso = $row[5];
            $corralNombre = $row[6];
            $loteNombre = $row[7];

            if (is_null($arete) || is_null($animalEspecie) || is_null($animalGenero) || is_null($animalPesoInicial) || is_null($animalValorCompra) || is_null($fechaIngreso) || is_null($corralNombre) || is_null($loteNombre)) {
                continue;
            }

            if (is_numeric($fechaIngreso)) {
                $fechaIngreso = Date::excelToDateTimeObject($fechaIngreso)->format('Y-m-d');
            } else {
                $fechaIngreso = \Carbon\Carbon::parse($fechaIngreso)->format('Y-m-d');
            }


            // Obtener o crear corral
            $corralId = DB::table('corrals')->where('corral_nombre', $corralNombre)->where('user_id', $user)->value('id');

            if (!$corralId) {
                $corralId = DB::table('corrals')->insertGetId([
                    'corral_nombre' => $corralNombre,
                    'user_id' => $user,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Obtener o crear lote
            $loteId = DB::table('lotes')->where('lote_nombre', $loteNombre)
                                        ->where('lote_id_corral', $corralId)
                                        ->where('user_id', $user)
                                        ->value('id');

            if (!$loteId) {
                $loteId = DB::table('lotes')->insertGetId([
                    'lote_nombre' => $loteNombre,
                    'lote_id_corral' => $corralId,
                    'lote_cantidad' => 0,
                    'consumo_total_alimento' => 0,
                    'costo_total_alimento' => 0,
                    'user_id' => $user,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Incrementar la cantidad de animales en el lote
                DB::table('lotes')->where('id', $loteId)->increment('lote_cantidad');
            }

            $existingAnimal = Animal::where('arete', $arete)
                                    ->where('user_id', $user)
                                    ->first();

            if ($existingAnimal) {
                // Añadir un mensaje de error si el animal ya existe
                $this->errors[] = "El animal con arete '$arete' ya existe.";
                continue;
            }

            // Crear animal
            DB::table('animals')->insert([
                'arete' => $arete,
                'animal_especie' => $animalEspecie,
                'animal_genero' => $animalGenero,
                'animal_peso_inicial' => $animalPesoInicial,
                'animal_peso_final' => $animalPesoInicial,
                'animal_valor_compra' => $animalValorCompra,
                'consumo_total' => 0,
                'costo_total' => 0,
                'fecha_ingreso' => $fechaIngreso,
                'animal_id_lote' => $loteId,
                'user_id' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        if (count($this->errors) > 0) {
            return redirect()->back()->withErrors($this->errors)->withInput();
        }else{
            return redirect()->back()->with('success', 'Animales importados correctamente.');
        }
    }
}
