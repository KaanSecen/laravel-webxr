<?php

namespace App\GraphQL\Queries\Room;

use App\Models\Room;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class RoomsQuery extends Query
{
    protected $attributes = [
        'name' => 'rooms',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Room'));
    }

    public function args(): array
    {
        return [
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['category_id'])) {
            return Room::query()->where('category_id' , $args['category_id'])->get();
        }

        return Room::all();
    }
}
