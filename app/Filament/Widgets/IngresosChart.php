<?php

namespace App\Filament\Widgets;

use App\Models\Movimiento;
use Filament\Widgets\ChartWidget;

class IngresosChart extends ChartWidget
{
    protected static ?string $heading = 'Reporte de movimiento de Ingresos';

    protected function getData(): array
    {

        $data = Movimiento::where('tipo', 'entrada')
            ->selectRaw('MONTH(fecha) as month, SUM(monto) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $totalRevenue = array_fill(0, 12, 0); #esto crea un array con 12 ceros para cada mes

        foreach ($data as $entry) {
            $totalRevenue[$entry->month - 1] = $entry->total; // Resta 1 porque los meses en la base de datos son de 1 a 12
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos',
                    'data' => $totalRevenue,
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => '#4CAF50',
                ],
            ],
            'labels' => $meses,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
