<?php

namespace App\GraphQL\Queries\Page;

use App\Models\Page;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PagesQuery extends Query
{
    protected $attributes = [
        'name' => 'pages',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Page');
    }

    public function args(): array
    {
        return [
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
        ];
    }

    public function resolve($root, $args)
    {
        $query = Page::query();

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
