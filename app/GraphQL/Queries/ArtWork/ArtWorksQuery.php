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
        return Type::listOf(GraphQL::type('ArtWork'));
    }

    public function args(): array
    {
        return [
            'room_id' => [
                'name' => 'room_id',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, $args): Collection|array
    {
        if (isset($args['room_id'])) {
            return ArtWork::query()->where('room_id' , $args['room_id'])->get();
        }

        return ArtWork::all();
    }
}
