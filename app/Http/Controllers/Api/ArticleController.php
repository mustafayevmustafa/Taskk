<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $articles = Article::query()
            ->select('name', 'description', 'type')
            ->simplePaginate(10);

        return apiResponse(
            'Articles retrieved successfully',
            [
                'articles' => $articles
            ]
        );
    }

    public function store(ArticleRequest $request)
    {
        $image_path = 'article' . time() . '.' . $request->file('file')->extension();
        $request->file('file')->storeAs('articles', $image_path);

        $article = Article::create([
            'name'        => $request->name,
            'description' => $request->description,
            'type'        => $request->type,
            'file'        => $image_path,
        ]);

        $article->makeHidden(['id', 'file', 'created_at', 'updated_at']);

        return apiResponse(
            "Data created successfully!",
            $article,
            null,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::query()
             ->select('name', 'description', 'type', 'file')->findOrFail($id);

            $article->append('temporary_url');

            return apiResponse(
                "Article retrieved successfully!",
                $article
            );
    }

    /**
     * @param $path
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getImage($path){
        return Storage::disk('local')->download(str_replace('-','/',$path));
    }
}
