<?php

namespace App\GraphQL\Queries\ArtWork;

use App\Models\ArtWork;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Illuminate\Database\Eloquent\Collection;

class ArtWorksQuery extends Query
{
    protected $attributes = [
        'name' => 'artworks',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('ArtWork');
    }

    public function args(): array
    {
        return [
            'room_id' => [
                'name' => 'room_id',
                'type' => Type::int(),
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'defaultValue' => 1,
            ],
            'perPage' => [
                'name' => 'perPage',
                'type' => Type::int(),
                'defaultValue' => 10,
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = ArtWork::query();

        if (isset($args['room_id'])) {
            $query->where('room_id' , $args['room_id']);
        }

        return $query->paginate($args['perPage'], ['*'], 'page', $args['page']);
    }
}
