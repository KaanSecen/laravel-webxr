<?php

namespace App\GraphQL\Queries\Room;

use App\Models\Room;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class RoomQuery extends Query
{
    protected $attributes = [
        'name' => 'room',
    ];

    public function type(): Type
    {
        return GraphQL::type('Room');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Room::findOrFail($args['id']);
    }
}
