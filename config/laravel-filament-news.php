<?php

return [
    /*
     * Resources used to manage your posts.
     */
    'resources' => [
        'post' => \Novius\LaravelFilamentNews\Filament\Resources\Posts\PostResource::class,
        'category' => \Novius\LaravelFilamentNews\Filament\Resources\Categories\CategoryResource::class,
        'tag' => \Novius\LaravelFilamentNews\Filament\Resources\Tags\TagResource::class,
    ],

    /*
     * Models used to manage your posts.
     */
    'models' => [
        'post' => \Novius\LaravelFilamentNews\Models\NewsPost::class,
        'category' => \Novius\LaravelFilamentNews\Models\NewsCategory::class,
        'tag' => \Novius\LaravelFilamentNews\Models\NewsTag::class,
    ],

    // If you want to restrict the list of possible locals. By default, uses all the locals installed
    'locales' => [
        // 'en',
    ],

    /*
     * The route name used to display news posts and categories.
     */
    'front_routes_name' => [
        'posts'      => 'news.posts',
        'post'       => 'news.post',
        'categories' => 'news.categories',
        'category'   => 'news.category',
        'tag'        => 'news.tag',
    ],

    /*
     * The route name used to display news posts and categories.
     */
    'front_routes_parameters' => [
        'post' => 'post',
        'category' => 'category',
        'tag' => 'tag',
    ],
];
