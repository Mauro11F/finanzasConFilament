<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;

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
            ->title('Categoría creada')
            ->body('La categoría ha sido creada exitosamente.')
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
