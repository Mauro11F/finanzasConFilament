<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPresupuesto extends EditRecord
{
    protected static string $resource = PresupuestoResource::class;

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
            ->title('Presupuesto Actualizado')
            ->body('El presupuesto fue Actualizado exitosamente.')
            ->success() # icono
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Presupuesto Eliminada')
                    ->body('El presupuesto ha sido eliminado exitosamente.')
                    ->success() # icono
            ),
        ];
    }
}
