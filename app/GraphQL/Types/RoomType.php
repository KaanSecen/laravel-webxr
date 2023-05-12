<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Room;
use GraphQL\Type\Definition\Type;
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
            'date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Date of the room'
            ],
            'description' => [
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
