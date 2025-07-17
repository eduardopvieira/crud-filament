<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Tabs\Tab;         // Importa a classe Tab correta
use Filament\Pages\Concerns\HasTabs; // Importa o Trait para abas

use App\Filament\Widgets\CategoriasTable;
use App\Filament\Widgets\ComidasTable;
use App\Filament\Widgets\TiposTable;

class Dashboard extends Page
{
    use HasTabs; 
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?int $navigationSort = -2; // Coloca no topo da navegação
    public function getTabs(): array
    {
        return [
            // Aba 1: Categorias
            'categorias' => Tab::make('Categorias')
                ->icon('heroicon-o-tag')
                ->badge(fn() => \App\Models\Categoria::count())
                ->widgets([
                    CategoriasTable::class, // Define o widget para esta aba
                ]),

            // Aba 2: Comidas
            'comidas' => Tab::make('Comidas')
                ->icon('heroicon-o-shopping-bag')
                ->badge(fn() => \App\Models\Comida::count())
                ->widgets([
                    ComidasTable::class,
                ]),

            // Aba 3: Tipos
            'tipos' => Tab::make('Tipos')
                ->icon('heroicon-o-sparkles')
                ->badge(fn() => \App\Models\Tipo::count())
                ->widgets([
                    TiposTable::class,
                ]),
        ];
    }
}
