<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComidaResource\Pages;
use App\Models\Comida;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

class ComidaResource extends Resource
{
    protected static ?string $model = Comida::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->maxLength(255),

                TextInput::make('descricao')
                    ->maxLength(255)
                    ->nullable(),

                Select::make('categoria_id')
                    ->relationship('categoria', 'nome')
                    ->required()
                    ->label('Categoria'),

                Select::make('tipo_id')
                    ->relationship('tipo', 'nome')
                    ->required()
                    ->label('Tipo'),

                TextInput::make('preco')
                    ->required()
                    ->numeric()
                    ->label('Preço')
                    ->prefix('R$'),

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
        ->defaultSort('created_at', 'desc')
        ->columns([
            TextColumn::make('id')
                ->searchable(),

            TextColumn::make('nome')
                ->searchable(),

            TextColumn::make('descricao')
                ->searchable(),

            TextColumn::make('categoria.nome')->sortable(),
            TextColumn::make('tipo.nome')->sortable(),
            TextColumn::make('preco')->money('BRL'),
            TextColumn::make('quantidade')->sortable(),
        ])
        ->filters([
            SelectFilter::make('categoria')
                ->relationship('categoria', 'nome')
                ->label('Categoria'),

            SelectFilter::make('tipo')
                ->relationship('tipo', 'nome')
                ->label('Tipo'),
        ])
        ->actions([
            \Filament\Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            \Filament\Tables\Actions\BulkActionGroup::make([
                \Filament\Tables\Actions\DeleteBulkAction::make(),
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
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['nome', 'descricao'];
    }

    //as funçoes abaixo otimizam consultas globais com algo chamado "eager loading". bem importante.

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['categoria', 'tipo']);
    }

    public static function applyGlobalSearchToQuery(Builder $query, string $search): Builder
    {
        return $query->whereFullText(['nome', 'descricao'], $search);
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['categoria', 'tipo']);
    }
}