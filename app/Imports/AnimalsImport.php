<?php

namespace App\Imports;

use App\Models\Animal;
use App\Models\Corral;
use App\Models\Lote;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AnimalsImport implements ToCollection
{
    protected $errors = [];

    public function collection(Collection $rows)
    {
        // Omitir la primera fila de encabezados
        $rows->shift();

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

            // Verificar si el arete ya existe
            if (Animal::where('arete', $arete)->exists()) {
                $this->errors[] = "El arete $arete ya existe y no puede ser duplicado.";
                continue;
            }

            // Obtener o crear corral
            $corral = Corral::firstOrCreate(
                ['corral_nombre' => $corralNombre, 'user_id' => Auth::id()],
                ['corral_nombre' => $corralNombre, 'user_id' => Auth::id()]
            );

            // Obtener o crear lote
            $lote = Lote::firstOrCreate(
                ['lote_nombre' => $loteNombre, 'lote_id_corral' => $corral->id, 'user_id' => Auth::id()],
                [
                    'lote_cantidad' => 0,
                    'consumo_total_alimento' => 0,
                    'costo_total_alimento' => 0,
                    'lote_id_corral' => $corral->id,
                    'user_id' => Auth::id()
                ]
            );

            // Incrementar la cantidad de animales en el lote
            $lote->increment('lote_cantidad');

            // Crear animal
            Animal::create([
                'arete' => $arete,
                'animal_especie' => $animalEspecie,
                'animal_genero' => $animalGenero,
                'animal_peso_inicial' => $animalPesoInicial,
                'animal_peso_final' => $animalPesoInicial,
                'animal_valor_compra' => $animalValorCompra,
                'consumo_total' => 0,
                'costo_total' => 0,
                'fecha_ingreso' => $fechaIngreso,
                'animal_id_lote' => $lote->id,
                'user_id' => Auth::id()
            ]);
        }
    }
}
