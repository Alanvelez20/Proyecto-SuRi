<?php

namespace App\Imports;

use App\Models\Alimento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlimentosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Convertir todos los encabezados a mayúsculas
        $row = array_change_key_case($row, CASE_UPPER);

        // Verificar si los encabezados existen en la fila
        if (!array_key_exists('NOMBRE', $row) || !array_key_exists('CANTIDAD', $row) || !array_key_exists('PRECIO', $row)) {
            return null; // O puedes manejar el error de otra manera si lo prefieres
        }

        try {
            return new Alimento([
                'alimento_descripcion' => $row['NOMBRE'], 
                'alimento_cantidad'    => $row['CANTIDAD'],
                'alimento_costo'       => $row['PRECIO'],
                'user_id'              => auth()->id(),
                'archivo_ubicacion'    => '0',
                'archivo_nombre'       => '0',
            ]);
        } catch (\Exception $e) {
            return null; // O puedes manejar el error de otra manera si lo prefieres
        }
    }
}



