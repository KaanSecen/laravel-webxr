<?php

return [
    'includes' => [
         App\Filament\Resources\ArtWorksResource::class,
        App\Filament\Resources\CategoryResource::class,
        App\Filament\Resources\RoomResource::class,
    ],
    'excludes' => [
        //
    ],
    'should_convert_count' => true,
    'enable_convert_tooltip' => true,
];
