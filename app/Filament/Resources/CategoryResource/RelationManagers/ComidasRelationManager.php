<?php

namespace App\Filament\Resources\CategoriaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ComidasRelationManager extends RelationManager
{
    protected static string $relationship = 'comidas';

    protected static ?string $title = 'Comidas nesta Categoria';
    
    protected static ?string $recordTitleAttribute = 'nome';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->maxLength(255),

                Select::make('tipo_id')
                    ->relationship('tipo', 'nome')
                    ->required()
                    ->label('Tipo'),
                
                TextInput::make('descricao')
                    ->maxLength(255)
                    ->nullable()
                    ->columnSpanFull(),

                TextInput::make('preco')
                    ->required()
                    ->numeric()
                    ->prefix('R$'),

                TextInput::make('quantidade')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome da Comida')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipo.nome')
                    ->label('Tipo')
                    ->sortable(),

                Tables\Columns\TextColumn::make('preco')
                    ->money('BRL')
                    ->label('Preço')
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantidade')
                    ->sortable(),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Adicionar Comida'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}