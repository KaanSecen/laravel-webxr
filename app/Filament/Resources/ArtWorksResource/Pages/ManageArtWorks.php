<?php

namespace App\Filament\Resources\ArtWorksResource\Pages;

use App\Filament\Resources\ArtWorksResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageArtWorks extends ManageRecords
{
    protected static string $resource = ArtWorksResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
