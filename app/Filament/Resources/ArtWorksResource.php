<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtWorksResource\Pages;
use App\Models\ArtWork;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ArtWorksResource extends Resource
{
    protected static ?string $model = ArtWork::class;

    protected static ?string $navigationIcon = 'heroicon-o-photograph';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->rules( 'file', 'mimetypes:image/png,image/jpeg,image/webp')
                    ->maxSize(1024)
                    ->directory('artworks')
                    ->required(),
                Forms\Components\FileUpload::make('sound')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->rules('file', 'mimetypes:audio/mpeg,audio/mp3')
                    ->maxSize(5048)
                    ->directory('sounds')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\MarkdownEditor::make('description')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])
                    ->maxLength(255),
                Forms\Components\Select::make('room_id')
                    ->required()
                    ->relationship('room', 'title')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ManageArtWorks::route('/'),
        ];
    }
}
