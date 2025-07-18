<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoResource\Pages;
use App\Models\Tipo;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TipoResource extends Resource
{
    protected static ?string $model = Tipo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getFormComponents(): array
    {
        return [
            TextInput::make('nome')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
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
                    ->label('Tipo'),
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
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->form(self::getFormComponents())
                    ->color('gray')
                    ->modalHeading('Editar Tipo')
                    ->modalSubmitActionLabel('Salvar alterações')
                    ->modalCancelActionLabel('Cancelar')
                    ->modalSubmitAction(fn ($action) => $action->color('success'))
                    ->modalCancelAction(fn ($action) => $action->color('danger')),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Novo Tipo')
                    ->color('success')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Registrar Novo Tipo')
                    ->modalSubmitActionLabel('Salvar')
                    ->modalCancelActionLabel('Cancelar')
                    ->createAnother(false),
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
            'index' => Pages\ListTipos::route('/'),
        ];
    }
}