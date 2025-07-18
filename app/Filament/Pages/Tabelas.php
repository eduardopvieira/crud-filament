<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\Attributes\Url; // Importe a classe Url

class Tabelas extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static string $view = 'filament.pages.tabelas';

    protected static ?string $navigationLabel = 'Tabelas';

    protected static ?string $title = 'Todas as Tabelas';

    #[Url]
    public $activeTab = 'comidas';
}