<x-filament-panels::page>
    <x-filament::tabs>
        {{-- comidas --}}
        <x-filament::tabs.item 
            :active="$activeTab === 'comidas'" 
            wire:click="$set('activeTab', 'comidas')"
            icon="heroicon-m-beaker">
            Comidas
        </x-filament::tabs.item>

        {{-- categorias --}}
        <x-filament::tabs.item 
            :active="$activeTab === 'categorias'" 
            wire:click="$set('activeTab', 'categorias')"
            icon="heroicon-m-tag">
            Categorias
        </x-filament::tabs.item>

        {{-- tipos --}}
        <x-filament::tabs.item 
            :active="$activeTab === 'tipos'" 
            wire:click="$set('activeTab', 'tipos')"
            icon="heroicon-m-swatch">
            Tipos
        </x-filament::tabs.item>
    </x-filament::tabs>

    {{-- abas --}}
    <div class="mt-4">
        @switch($activeTab)
            @case('comidas')
                @livewire(\App\Filament\Widgets\ComidasTableWidget::class)
                @break
            @case('categorias')
                @livewire(\App\Filament\Widgets\CategoriasTableWidget::class)
                @break
            @case('tipos')
                @livewire(\App\Filament\Widgets\TiposTableWidget::class)
                @break
        @endswitch
    </div>

</x-filament-panels::page>