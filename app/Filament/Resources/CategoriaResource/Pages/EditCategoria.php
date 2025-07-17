<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Actions\Action;

use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Deletar Categoria')
            ->color('danger')
            ->icon('heroicon-o-trash'),
        ];
    }

     protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Salvar Categoria')
            ->color('success')
            ->icon('heroicon-o-check')
            ->action(fn () => $this->save());
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar')
            ->color('danger')
            ->icon('heroicon-o-x-mark');

    }
}
