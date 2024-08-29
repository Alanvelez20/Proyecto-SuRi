<?php

namespace App\Imports;

use App\Models\Alimento;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class AlimentosImport implements ToCollection
{
    protected $errors = [];

    /**
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        // Convertir todos los encabezados a mayúsculas
        $rows->shift();
        $user=Auth::id();
        foreach ($rows as $row) {
            if (count($row) < 3) {
                continue;
            }
            $nombre = $row[0];
            $cantidad = $row[1];
            $precio = $row[2];

            if (is_null($nombre) || is_null($cantidad) || is_null($precio) ) {
                continue;
            }

            // Verificar si el alimento ya existe para el usuario actual
            $existingAlimento = Alimento::where('alimento_descripcion', $nombre)
                                       ->where('user_id', auth()->id())
                                       ->first();

            if ($existingAlimento) {
                // Añadir un mensaje de error si el alimento ya existe
                $this->errors[] = "El alimento con nombre '$nombre' ya existe.";
                continue;
            }

            // Crear alimento
            DB::table('alimentos')->insert([
                'alimento_descripcion' => $nombre,
                'alimento_cantidad'    => $cantidad,
                'alimento_costo'       => $precio,
                'user_id'              => $user,
                'archivo_ubicacion'    => '0',
                'archivo_nombre'       => '0',
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        // Redireccionar con errores o éxito
        if (count($this->errors) > 0) {
            return redirect()->back()->withErrors($this->errors)->withInput();
        } else {
            return redirect()->back()->with('success', 'Alimentos importados correctamente.');
        }
    }
}



