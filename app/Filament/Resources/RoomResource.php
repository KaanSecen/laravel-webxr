<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('intro')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])
                    ->maxLength(255),
                Forms\Components\FileUpload::make('cover_image')
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->rules( 'file', 'mimetypes:image/png,image/jpeg,image/webp')
                    ->directory('cover-images')
                    ->maxSize(1024)
                    ->required(),
                Forms\Components\FileUpload::make('background_image')
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->rules( 'file', 'mimetypes:image/png,image/jpeg,image/webp')
                    ->directory('background-images')
                    ->maxSize(5048),
                Forms\Components\ColorPicker::make('color')
                    ->required(),
                Forms\Components\FileUpload::make('sound')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->rules('file', 'mimetypes:audio/mpeg,audio/mp3')
                    ->directory('sounds')
                    ->maxSize(5048)
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\MarkdownEditor::make('description')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'title'),
                Forms\Components\Select::make('template')
                    ->required()
                    ->options([
                        1 => 'Default',
                        2 => 'Heaven',
                        3 => 'Purgatory',
                        4 => 'Hell'
                    ])
                    ->default(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\ImageColumn::make('background_image'),
                Tables\Columns\ColorColumn::make('color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime('d/m/Y'),
                Tables\Columns\SelectColumn::make('template')
                    ->options([
                        1 => 'Default',
                        2 => 'Heaven',
                        3 => 'Purgatory',
                        4 => 'Hell'
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRooms::route('/'),
        ];
    }
}
