<?php

namespace App\Filament\Resources\MattressResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Mattress;
use App\Models\InventoryCount;

class InventoryCost extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Inventory Cost', $this->getInventoryCost()),
        ];
    }

    public function getInventoryCost(): string
    {
    //    For each mattress id , get the latest inventory count
    //    Multiply the count by the cost per mattress
    //    Sum the results

        $mattresses = Mattress::all();

        $inventoryCounts = [];

        foreach ($mattresses as $mattress) {
            $inventoryCounts[] = InventoryCount::latestCount()->where('mattress_id', $mattress->id)->first();
        }
  
        $cost = 0;
        foreach ($inventoryCounts as $inventoryCount) {
            $cost += $inventoryCount->count * $inventoryCount->mattress->cost;
        }
        return '$' . number_format($cost, 2);
    }
}