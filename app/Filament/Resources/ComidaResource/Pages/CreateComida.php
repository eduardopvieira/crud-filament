<?php

namespace App\Filament\Resources\ComidaResource\Pages;

use App\Filament\Resources\ComidaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateComida extends CreateRecord
{
    protected static string $resource = ComidaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function getCreateFormAction(): Action {
    //     return parent::getCreateFormAction()
    //         ->label('Criar')
    //         ->color('success');
    // }

    protected function getCreateAnotherFormAction(): Action {
        return parent::getCreateAnotherFormAction()
            ->label('Criar e adicionar outro')
            ->color('warning');
    }

    protected function getCancelFormAction(): Action {
        return parent::getCancelFormAction()
            ->label('Cancelar')
            ->color('danger');
    }
    public function getTitle(): string
    {
        return 'Criar Comida';
    }
}
