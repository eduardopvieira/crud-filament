<?php

namespace App\Filament\Resources;

use App\Models\Categoria;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getFormComponents(): array
    {
        return [
            TextInput::make('nome')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->label('Nome da Categoria'),
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
}