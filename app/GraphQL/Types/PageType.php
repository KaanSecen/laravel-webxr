<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Page;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Page',
        'description' => 'Collection of pages',
        'model' => Page::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of page'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the page'
            ],
            'intro' => [
                'type' => Type::string(),
                'description' => 'Description of the page'
            ],
            'url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the page',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->image;
                },
            ],
            'pages' => [
                'type' => GraphQL::paginate('Page'),
                'description' => 'Pagination of pages'
            ]
        ];
    }
}
