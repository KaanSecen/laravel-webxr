<?php

namespace App\GraphQL\Queries\ArtWork;

use App\Models\ArtWork;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ArtWorksQuery extends Query
{
    protected $attributes = [
        'name' => 'artworks',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('ArtWork'));
    }

    public function resolve($root, $args)
    {
        return ArtWork::all();
    }
}
