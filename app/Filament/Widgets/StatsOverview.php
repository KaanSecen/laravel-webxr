<?php

namespace App\Filament\Widgets;

use App\Models\ArtWork;
use App\Models\Category;
use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Total Rooms', Room::count()),
            Card::make('Total Art Works', ArtWork::count()),
            Card::make('Total Categories', Category::count()),
        ];
    }
}
