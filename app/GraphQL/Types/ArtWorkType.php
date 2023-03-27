<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\ArtWork;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ArtWorkType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ArtWork',
        'description' => 'Collection of art works',
        'model' => ArtWork::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of art work'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the art work'
            ],
            'filename' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image Filename of the art work'
            ],
            'url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the art work',
                'resolve' => function ($root, $args) {
                    $url = config('app.url') . Storage::url($root->path . $root->filename);
                    return $url . $root->image;
                },
            ],
            'date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image of the art work'
            ],
            'artworks' => [
                'type' => Type::listOf(GraphQL::type('ArtWork')),
                'description' => 'List of art works'
            ]
        ];
    }
}
