<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions\Action;;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;

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
}
