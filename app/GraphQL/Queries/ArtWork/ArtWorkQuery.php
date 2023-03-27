<?php

namespace App\GraphQL\Queries\ArtWork;

use App\Models\ArtWork;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ArtWorkQuery extends Query
{
    protected $attributes = [
        'name' => 'artwork',
    ];

    public function type(): Type
    {
        return GraphQL::type('ArtWork');
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
        return ArtWork::findOrFail($args['id']);
    }
}
