<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Room;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RoomType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Room',
        'description' => 'Collection of rooms',
        'model' => Room::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of room'
            ],
            'template' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of template'
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of category'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the room'
            ],
            'filename' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image Filename of the room'
            ],
            'cover_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the cover room',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->cover_image;
                },
            ],
            'background_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the background room',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->background_image;
                },
            ],
            'sound' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the sound',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->sound;
                },
            ],
            'date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Date of the room'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of the room'
            ],
            'intro' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of the room'
            ],
            'rooms' => [
                'type' => GraphQL::paginate('Room'),
                'description' => 'Pagination of rooms'
            ]
        ];
    }
}
