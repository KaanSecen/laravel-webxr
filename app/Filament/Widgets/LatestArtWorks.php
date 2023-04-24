<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\ArtWork;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArtWorks extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return ArtWork::query()
            ->latest()
            ->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\ImageColumn::make('image'),
            Tables\Columns\TextColumn::make('date')
                ->dateTime('d/m/Y'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
