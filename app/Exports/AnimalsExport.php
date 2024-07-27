<?php

namespace App\Exports;

use App\Models\animal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnimalsExport implements FromCollection, WithHeadings
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
        return Animal::where('user_id', $this->userId)
            ->get()
            ->map(function ($animal) {
                return [
                    $animal->arete,
                    $animal->animal_especie,
                    $animal->animal_genero,
                    $animal->animal_peso_inicial,
                    $animal->animal_peso_final,
                    $animal->animal_valor_compra,
                    $animal->animal_valor_venta,
                    $animal->consumo_total,
                    $animal->costo_total,
                    $animal->fecha_ingreso,
                    $animal->lote ? $animal->lote->lote_nombre : 'N/A', // Nombre del lote
                    $animal->user ? $animal->user->name : 'N/A'
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Arete',
            'Especie',
            'Género',
            'Peso inicial',
            'Peso actual',
            'Valor de compra',
            'Valor de venta',
            'Consumo total',
            'Costo total',
            'Fecha de ingreso',
            'Lote',
            'Usuario'
        ];
    }
    
}

