<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Collection of categories',
        'model' => Category::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of category'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the category'
            ],
            'intro' => [
                'type' => Type::string(),
                'description' => 'Description of the room'
            ],
            'cover_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the cover room',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->cover_image;
                },
            ],
            'categories' => [
                'type' => GraphQL::paginate('Category'),
                'description' => 'List of category'
            ]
        ];
    }
}
