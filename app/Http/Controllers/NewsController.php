<?php

namespace App\Http\Controllers;

use Novius\LaravelFilamentNews\Models\NewsCategory;
use Novius\LaravelFilamentNews\Models\NewsPost;
use Novius\LaravelFilamentNews\Models\NewsTag;
use Novius\LaravelMeta\Facades\CurrentModel;

class NewsController extends Controller
{
    public function posts()
    {
        $posts = NewsPost::published()->get();

        return view('pages.news.posts', ['posts' => $posts]);
    }

    public function post(NewsPost $post)
    {
        CurrentModel::setModel($post);

        return view('pages.news.post', ['post' => $post]);
    }

    public function categories()
    {
        $categories = NewsCategory::all();

        return view('pages.news.categories', ['categories' => $categories]);
    }

    public function category(NewsCategory $category)
    {
        CurrentModel::setModel($category);
        $posts = $category->posts->filter(function (NewsPost $post) {
            return $post->isPublished();
        });

        return view('pages.news.category', ['category' => $category, 'posts' => $posts]);
    }

    public function tag(NewsTag $tag)
    {
        $posts = $tag->posts->filter(function (NewsPost $post) {
            return $post->isPublished();
        });

        return view('pages.news.tag', ['tag' => $tag, 'posts' => $posts]);
    }
}
