<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Tipo;
use Illuminate\Database\Eloquent\Builder;

class TiposTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Tipo::query();
    }
    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
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
                    ->infolist(\App\Filament\Resources\TipoResource::getInfolistComponents())
                    ->label('Visualizar'),

                Tables\Actions\EditAction::make()
                    ->form(\App\Filament\Resources\TipoResource::getFormComponents())
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
                    ->form(\App\Filament\Resources\TipoResource::getFormComponents())
                    ->label('Novo Tipo')
                    ->color('success')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Registrar Novo Tipo')
                    ->modalSubmitActionLabel('Salvar')
                    ->modalCancelActionLabel('Cancelar')
                    ->createAnother(false),
            ]);
    }
}