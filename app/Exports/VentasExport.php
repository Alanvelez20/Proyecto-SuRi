<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function collection()
    {
        return Venta::where('user_id', $this->userId)
            ->get()
            ->map(function ($venta) {
                // Puedes obtener el nombre del lote o cualquier otro dato relacionado si es necesario
                
                return [
                    $venta->arete,
                    $venta->animal_especie,
                    $venta->animal_genero,
                    $venta->animal_peso_inicial,
                    $venta->animal_peso_final,
                    $venta->animal_valor_compra,
                    $venta->animal_valor_venta,
                    $venta->consumo_total,
                    $venta->costo_total,
                    $venta->fecha_ingreso,
                    $venta->fecha_venta,
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Arete',
            'Especie',
            'Género',
            'Peso Inicial',
            'Peso Final',
            'Valor de Compra',
            'Valor de Venta',
            'Consumo Total',
            'Costo Total',
            'Fecha de Ingreso',
            'Fecha de Venta',
        ];
    }
}
