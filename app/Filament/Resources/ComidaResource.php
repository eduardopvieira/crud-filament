<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComidaResource\Pages;
use App\Filament\Resources\ComidaResource\RelationManagers;
use App\Models\Comida;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ComidaResource extends Resource
{
    protected static ?string $model = Comida::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                ->required()
                ->maxLength(255),

                Select::make('categoria_id')
                ->relationship('categoria', 'nome')
                ->required()
                ->label('Categoria'),

                Select::make('tipo_id')
                ->relationship('tipo', 'nome')
                ->required()
                ->label('Tipo'),

                Select::make('modo-de-preparo')
                ->label('Modo de Preparo')
                ->options([
                    'Frito' => 'Frito',
                    'Assado' => 'Assado',
                    'Grelhado' => 'Grelhado',
                    'Cozido' => 'Cozido',
                    'Não Aplicável' => 'Não Aplicável',
                ])
                ->required(),
                
                TextInput::make('preco')
                ->required()
                ->numeric()
                ->label('Preço')
                ->prefix('R$ '),

                TextInput::make('quantidade')
                ->required()
                ->numeric()
                ->default(0)
                ->label('Quantidade'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->searchable()
                ->sortable()
                ->label('ID'),

                TextColumn::make('nome')
                ->searchable()
                ->sortable()
                ->label('Nome'),

                TextColumn::make('categoria.nome')
                ->searchable()
                ->sortable()
                ->label('Categoria'),

                TextColumn::make('tipo.nome')
                ->searchable()
                ->sortable()
                ->label('Tipo'),

                TextColumn::make('preco')
                ->money('BRL')
                ->label('Preço'),

                TextColumn::make('quantidade')
                ->sortable()
                ->label('Quantidade'),

                TextColumn::make('created_at')
                ->dateTime()
                ->label('Criado em'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListComidas::route('/'),
            'create' => Pages\CreateComida::route('/create'),
            'edit' => Pages\EditComida::route('/{record}/edit'),
        ];
    }
}
