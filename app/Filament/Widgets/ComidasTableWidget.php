<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Comida;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;

class ComidasTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Comida::query()->with(['categoria', 'tipo']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('nome')->searchable(),
                TextColumn::make('descricao')->searchable()->words(4),
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
                Tables\Actions\ViewAction::make()->label('Visualizar'),
                
                Tables\Actions\EditAction::make()
                    ->form(\App\Filament\Resources\ComidaResource::getFormComponents())
                    ->label('Editar')
                    ->color('primary')
                    ->modalHeading('Editar Comida')
                    ->modalSubmitActionLabel('Salvar alterações')
                    ->modalCancelActionLabel('Cancelar')
                    ->modalSubmitAction(fn ($action) => $action->color('success'))
                    ->modalCancelAction(fn ($action) => $action->color('danger')),

                Tables\Actions\DeleteAction::make()->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->form(\App\Filament\Resources\ComidaResource::getFormComponents())
                    ->label('Criar Comida')
                    ->color('success')
                    ->modalSubmitActionLabel('Salvar Comida')
                    ->icon('heroicon-o-plus')
                    ->modalCancelActionLabel('Voltar')
                    ->createAnother(false)
                    ->modalHeading('Registrar Nova Comida'),
            ]);
    }
}