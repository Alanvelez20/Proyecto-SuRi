<?php

namespace App\Exports;

use App\Models\Lote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LotesExport implements FromCollection,WithHeadings
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
        return Lote::where('user_id', $this->userId)
            ->get()
            ->map(function ($lote) {
                return [
                    $lote->lote_nombre,
                    $lote->lote_cantidad,
                    $lote->consumo_total_alimento,
                    $lote->costo_total_alimento, 
                    $lote->corral ? $lote->corral->corral_nombre : 'N/A',
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Nombre del Lote',
            'Cantidad de animales',
            'Consumo total',
            'Costo total',
            'Corral' 
        ];
    }
}
