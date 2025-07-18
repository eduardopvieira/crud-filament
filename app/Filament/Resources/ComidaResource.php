<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComidaResource\Pages;
use App\Models\Comida;
use Faker\Core\Color;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Tables\Actions\EditAction;

class ComidaResource extends Resource
{
    protected static ?string $model = Comida::class;
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function getFormComponents(): array
    {
        return [
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
        ];
    }

  
    public static function form(Form $form): Form
    {
        return $form->schema(self::getFormComponents());
    }

    public static function table(Table $table): Table
    {
        return $table
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
                ->form(ComidaResource::getFormComponents())
                
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
                    ->label('Criar Comida')
                    ->color('success')
                    ->modalSubmitActionLabel('Salvar Comida')
                    ->icon('heroicon-o-plus')
                    ->modalCancelActionLabel('Voltar')
                    ->createAnother(false)
                    ->modalHeading('Registrar Nova Comida'),
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
            //'create' => Pages\CreateComida::route('/create'),
            //'edit' => Pages\EditComida::route('/{record}/edit'),
        ];
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

        return $query->whereFullText(['nome', 'descricao'], $search);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['categoria', 'tipo']);
    }
}