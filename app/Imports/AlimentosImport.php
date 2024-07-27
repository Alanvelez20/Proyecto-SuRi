<?php

namespace App\Imports;

use App\Models\Alimento;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class AlimentosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        return new Alimento([
            'alimento_descripcion' => $row[0],  // Asegúrate de que el índice corresponda a las columnas en el archivo
            'alimento_cantidad'    => $row[1],
            'alimento_costo'       => $row[2],
            'user_id'              => auth()->id(), // Asigna el usuario autenticado
            'archivo_ubicacion'    => '0', // Puedes añadir lógica para manejar la ubicación si es necesario
            'archivo_nombre'       => '0', // Igual aquí si necesitas manejar el nombre
        ]);
    }
}
