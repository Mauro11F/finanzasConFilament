<?php

namespace App\Filament\Widgets;

use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios', User::count())
            ->description('Total de Usuarios')
            ->icon('heroicon-o-users')
            ->color('success')
            ->chart([1,2,3,4,5,6,7,8,9,10]),


            Stat::make('Categorias', Categoria::count())
            ->description('Total de Categorias')
            ->icon('heroicon-o-bookmark-square')
            ->color('info')
            ->chart([1,5,10,15,25,40]),

            Stat::make('Movimientos','$'.  Movimiento::where('tipo', 'entrada')->sum('monto'))
            ->description('Total de Movimientos')
            ->icon('heroicon-o-document-chart-bar')
            ->color('primary')
            ->chart([0,15,3,4,25,16,7,40,9,45])

        ];
    }
}
