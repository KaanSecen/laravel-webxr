<?php

namespace App\GraphQL\Queries\Page;

use App\Models\Page;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PageQuery extends Query
{
    protected $attributes = [
        'name' => 'page',
    ];

    public function type(): Type
    {
        return GraphQL::type('Page');
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
        return Page::findOrFail($args['id']);
    }
}
