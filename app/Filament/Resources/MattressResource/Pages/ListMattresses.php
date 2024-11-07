<?php

namespace App\Filament\Resources\MattressResource\Pages;

use App\Filament\Resources\MattressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMattresses extends ListRecords
{
    protected static string $resource = MattressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
