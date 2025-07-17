<?php

namespace App\Filament\Resources\ComidaResource\Pages;

use App\Filament\Resources\ComidaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditComida extends EditRecord
{
    protected static string $resource = ComidaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Deletar Comida')
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
