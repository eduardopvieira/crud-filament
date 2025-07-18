<?php

namespace App\Filament\Resources\TipoResource\Pages;

use App\Filament\Resources\TipoResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTipo extends CreateRecord
{
    protected static string $resource = TipoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateFormAction(): Action {
        return parent::getCreateFormAction()
            ->label('Criar')
            ->color('success');
    }

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
        return 'Criar Tipo';
    }
}
