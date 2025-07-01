<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMovimiento extends EditRecord
{
    protected static string $resource = MovimientoResource::class;

    protected function getRedirectUrl(): string # Redireccionar el formulario a index(listado)
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotification(): ?Notification # Metodo desactivar la notidicacion por defecto
    {
        return null;
    }

    protected function afterSave() # Metodo que se ejecuta al modificar un formulario
    {
        Notification::make()
            ->title('Movimiento Actualizado')
            ->body('El movimieto fue Actualizado exitosamente.')
            ->success() # icono
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Movimiento Eliminado')
                    ->body('El movimiento ha sido eliminado exitosamente.')
                    ->success() # icono
            ),
        ];
    }
}
