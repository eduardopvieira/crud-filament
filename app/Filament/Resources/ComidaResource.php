<?php

namespace App\Filament\Resources;

use App\Models\Comida;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class ComidaResource extends Resource
{
    protected static ?string $model = Comida::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function getFormComponents(): array
    {
        return [
            TextInput::make('nome')
                ->required()
                ->maxLength(255),
            TextInput::make('descricao')
                ->maxLength(255)
                ->nullable()
                ->label('Descrição'),
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
        ];
    }
 
    public static function form(Form $form): Form
    {
        return $form->schema(self::getFormComponents());
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nome', 'descricao'];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['categoria', 'tipo']);
    }

    public static function applyGlobalSearchToQuery(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->whereFullText(['nome', 'descricao'], $search);
        });
    }
}