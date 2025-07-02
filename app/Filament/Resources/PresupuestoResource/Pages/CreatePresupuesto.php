<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePresupuesto extends CreateRecord
{
    protected static string $resource = PresupuestoResource::class;

    protected function getRedirectUrl(): string # Redireccionar el formulario a index(listado)
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification # Metodo para ocupar la funcion ()
    {
        return null;
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Presupuesto creado')
            ->body('El presupesto ha sido creado exitosamente.')
            ->success() # icono
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
            ->label('Registrar')
            ->color('primary'), # Podemos cambiarle de color al boton
            // $this->getCreateAnotherFormAction()
            // ->label('Guardar y nuevo') # 
            $this->getCancelFormAction()
            ->label('Cancelar')
        ];
    }

}
