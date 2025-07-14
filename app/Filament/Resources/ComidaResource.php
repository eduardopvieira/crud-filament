<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComidaResource\Pages;
use App\Models\Comida;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use \Filament\Tables\Filters\SelectFilter;

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

                Select::make('modo-de-preparo')
                    ->label('Modo de Preparo')
                    ->options([
                        'frito' => 'Frito',
                        'assado' => 'Assado',
                        'cozido' => 'Cozido',
                        'puro' => 'Puro (In Natura)',
                        'nao_aplica' => 'Não se Aplica',
                    ])
                    ->required(),

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
            ->columns([
                TextColumn::make('nome')
                    ->searchable() 
                    ->sortable()
                    ->label('Nome'),

                TextColumn::make('descricao')
                    ->searchable()
                    ->words(4)
                    ->label('Descrição'),

                TextColumn::make('categoria.nome')
                    ->sortable()
                    ->label('Categoria'),

                TextColumn::make('tipo.nome')
                    ->sortable()
                    ->label('Tipo'),

                TextColumn::make('modo-de-preparo')
                    ->badge()
                    ->label('Preparo'),

                TextColumn::make('preco')
                    ->money('BRL')
                    ->label('Preço'),

                TextColumn::make('quantidade')
                    ->sortable()
                    ->label('Quantidade'),
            ])
            ->filters([
                SelectFilter::make('categoria')
                    ->relationship('categoria', 'nome')
                    ->label('Filtrar por Categoria'),

                SelectFilter::make('tipo')
                    ->relationship('tipo', 'nome')
                    ->label('Filtrar por Tipo'),

                SelectFilter::make('busca_texto')
                    ->form([
                        TextInput::make('termo')
                            ->label('Buscar por Nome ou Descrição'),
                    ])

                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['termo'],
                            fn (Builder $query, $termo) => $query->whereFullText(['nome', 'descricao'], $termo)
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['categoria', 'tipo']);
    }

    public static function applyGlobalSearchToQuery(Builder $query, string $search): Builder
    {
        return $query->whereFullText(['nome', 'descricao'], $search);
    }
}