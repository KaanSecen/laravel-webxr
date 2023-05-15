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
        return GraphQL::paginate('Room');
    }

    public function args(): array
    {
        return [
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int(),
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'defaultValue' => 1,
            ],
            'per_page' => [
                'name' => 'per_page',
                'type' => Type::int(),
                'defaultValue' => 10,
            ],
            'date' => [
                'name' => 'date',
                'type' => Type::string(),
                'defaultValue' => 'desc',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Room::query();

        if (isset($args['category_id'])) {
            $query->where('category_id', $args['category_id']);
        }

        $query->orderBy('date', $args['date']);

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}

