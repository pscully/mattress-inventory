<?php

namespace App\Filament\Resources\MattressResource\Pages;

use App\Filament\Resources\MattressResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMattress extends ViewRecord
{
    protected static string $resource = MattressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
