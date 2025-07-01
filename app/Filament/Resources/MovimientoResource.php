<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make('Rellene lo Datos')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuario')
                            ->required()
                            ->options(User::all()->pluck('name', 'id')), # en las opciones del "Select" traemos "name", "id" sacados de del modelo
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoría')
                            ->required()
                            ->options(Categoria::all()->pluck('name', 'id')),
                        Forms\Components\Select::make('tipo')
                            ->required()
                            ->options([
                                'entrada' => 'Ingreso',
                                'gasto' => 'Gasto',
                            ]),
                        Forms\Components\TextInput::make('monto')
                            ->label('Monto')
                            ->required()
                            ->numeric(),
                        Forms\Components\RichEditor::make('descripcion') # RichEditor es el componente del area completamente enriquecido
                            ->label('Descripción')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('foto') # componenete FileUpload permite subir archivos
                            ->label('Foto')
                            ->image()
                            ->disk('public') # especificamos el disco donde se guardará la foto
                            ->directory('movimientos'), # especificamos el directorio dentro del disco
                        Forms\Components\DatePicker::make('fecha')
                            ->required(),
                    ])->columns(2) # especificamos que el formulario tendrá tantas columnas
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
                    ->searchable() # permite buscar por el nombre del usuario
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(20)
                    ->html(), # limita la cantidad de caracteres que se muestran
                Tables\Columns\ImageColumn::make('foto')
                    ->searchable()
                    ->width(50) # ancho de la imagen en la tabla
                    ->height(50), # alto de la imagen en la tabla
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
                SelectFilter::make('tipo')
                    ->options([
                        'entrada' => 'Entrada',
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
                            ->title('Movimiento Eliminado')
                            ->body('el movimiento ha sido eliminado exitosamente.')
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
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
