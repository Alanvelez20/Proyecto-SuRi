<?php

namespace App\Exports;

use App\Models\Consumo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsumosExport implements FromCollection, WithHeadings
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
        return Consumo::where('user_id', $this->userId)
            ->get()
            ->map(function ($consumo) {
                return [
                    $consumo->lote ? $consumo->lote->lote_nombre : 'N/A', // Nombre del lote
                    $consumo->alimento ? $consumo->alimento->alimento_descripcion : 'N/A', // Nombre del alimento
                    $consumo->alimento_cantidad_total,
                    $consumo->valor_dieta,
                    $consumo->animales_cantidad,
                    $consumo->fecha_consumo,
                    $consumo->user ? $consumo->user->name : 'N/A',
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Lote',
            'Alimento',
            'Cantidad',
            'Valor/Costo',
            'Cantidad de animales',
            'Fecha',
            'Usuario'
        ];
    }
}
