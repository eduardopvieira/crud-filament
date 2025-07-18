<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;

class CategoriasTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Categoria::query();
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

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->defaultSort('created_at', 'desc')
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
                    ->infolist(\App\Filament\Resources\CategoriaResource::getInfolistComponents())
                    ->label('Visualizar'),

                Tables\Actions\EditAction::make()
                    ->form(\App\Filament\Resources\CategoriaResource::getFormComponents())
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
                    ->form(\App\Filament\Resources\CategoriaResource::getFormComponents())
                    ->label('Nova Categoria')
                    ->color('success')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Registrar Nova Categoria')
                    ->modalSubmitActionLabel('Salvar')
                    ->modalCancelActionLabel('Cancelar')
                    ->createAnother(false),
            ]);
    }
}