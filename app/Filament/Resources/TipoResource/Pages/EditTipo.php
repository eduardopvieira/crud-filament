<?php

namespace App\Filament\Resources\TipoResource\Pages;

use App\Filament\Resources\TipoResource;
use Filament\Actions;
use Filament\Actions\Action;

use Filament\Resources\Pages\EditRecord;

class EditTipo extends EditRecord
{
    protected static string $resource = TipoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Deletar Tipo')
            ->color('danger')
            ->icon('heroicon-o-trash'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Salvar Comida')
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
