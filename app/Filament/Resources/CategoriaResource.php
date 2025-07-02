<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make('Rellene el Formulario')
                ->schema([
                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nombre de la categoría')
                            ->placeholder('Ingrese el nombre de la categoría')
                            ->maxLength(255),
                        Forms\Components\Select::make('tipo')
                            ->options([
                                'entrada' => 'Ingreso',
                                'gasto' => 'Gasto',
                            ])
                            ->label('Tipo de movimiento')
                            ->required(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Nro')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable() # bucador en timepo real (en el buscador)
                    ->sortable(), # Agrega la posibilidad de ordenar por esta columna
                Tables\Columns\TextColumn::make('tipo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options([
                        'entrada' => 'Ingreso',
                        'gasto' => 'Gasto',
                    ])
                    ->label('Tipo')
                    ->placeholder('Filtrar por tipo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->button()
                ->color('info'), # Cambia el color del boton
                Tables\Actions\DeleteAction::make()
                ->button()
                ->color('danger') # Cambia el color del boton
                ->successNotification(
                    Notification::make()
                        ->title('Categoría Eliminada')
                        ->body('La categoría ha sido eliminada exitosamente.')
                        ->success() # icono
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
