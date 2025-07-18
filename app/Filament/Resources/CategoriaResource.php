<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Models\Categoria;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;

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
                    ->label('Categoria'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Criado em'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->infolist(self::getFormComponents())
                    ->label('Visualizar'),

                Tables\Actions\EditAction::make()
                    ->form(self::getFormComponents())
                    ->color('primary')
                    ->label('Editar')
                    ->modalHeading('Editar Categoria')
                    ->modalSubmitActionLabel('Salvar alterações')
                    ->modalCancelActionLabel('Cancelar')
                    ->modalSubmitAction(fn ($action) => $action->color('success'))
                    ->modalCancelAction(fn ($action) => $action->color('danger')),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nova Categoria')
                    ->color('success')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Registrar Nova Categoria')
                    ->modalSubmitActionLabel('Salvar')
                    ->modalCancelActionLabel('Cancelar')
                    ->createAnother(false),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
        ];
    }

    public static function getInfolistComponents(): array
    {
        return [
            TextEntry::make('nome')
                ->label('Nome da Categoria'),
            TextEntry::make('created_at')
                ->label('Criado em')
                ->dateTime(),
            TextEntry::make('updated_at')
                ->label('Atualizado em')
                ->dateTime(),
        ];
    }
}