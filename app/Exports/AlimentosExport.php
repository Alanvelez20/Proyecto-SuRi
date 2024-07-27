<?php

namespace App\Exports;

use App\Models\Alimento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlimentosExport implements FromCollection, WithHeadings
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
        return Alimento::where('user_id', $this->userId)
            ->get()
            ->map(function ($alimento) {
                return [
                    $alimento->alimento_descripcion,
                    $alimento->alimento_cantidad,
                    $alimento->alimento_costo,
                    $alimento->user ? $alimento->user->name : 'N/A'
                ];
            });
         
    }

    public function headings(): array
    {
        return [
            'Descripcion',
            'Cantidad',
            'Costo',
            'Usuario',
        ];
    }
}
