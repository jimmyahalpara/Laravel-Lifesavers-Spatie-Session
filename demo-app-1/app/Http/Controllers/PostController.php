<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'show' => ['cacheResponse'],
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                // AllowedFilter::exact('id'),
                // AllowedFilter::operator('id', FilterOperator::GREATER_THAN),
                AllowedFilter::operator('id', FilterOperator::DYNAMIC),
                'title', 'content',
                AllowedFilter::trashed(),
            ])
            ->allowedSorts(['title', 'content', 'created_at', 'id'])
            ->allowedIncludes('user')
            ->paginate(10);
        
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return [
            'post' => $post,
            'tags' => $post->tags,
            'random' => random_int(1, 100),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
