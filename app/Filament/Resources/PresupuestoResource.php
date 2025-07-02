<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresupuestoResource\Pages;
use App\Filament\Resources\PresupuestoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Presupuesto;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PresupuestoResource extends Resource
{
    protected static ?string $model = Presupuesto::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make('Rellene el Formulario')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuario')
                            ->required()
                            ->options(User::all()->pluck('name', 'id')),
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoria')
                            ->required()
                            ->options(Categoria::all()->pluck('name', 'id')),
                        Forms\Components\TextInput::make('monto_asignado')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('monto_gastado')
                            ->required()
                            ->numeric()
                            ->default(0.00)
                            ->disabled() # deshabilita el campo para que no se pueda editar.
                            ->dehydrated(), # Envía al servidor el campo aun si esta desabilitado.
                        Forms\Components\DatePicker::make('fecha')
                            ->required(),
                    ])->columns(2)

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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.name')
                    ->label('Categoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_asignado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_gastado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
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
                //
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
                            ->title('Presupuesto Eliminado')
                            ->body('el presupuesto ha sido eliminado exitosamente.')
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
            'index' => Pages\ListPresupuestos::route('/'),
            'create' => Pages\CreatePresupuesto::route('/create'),
            'edit' => Pages\EditPresupuesto::route('/{record}/edit'),
        ];
    }
}
