<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        paginate($request, $limit, $offset);

        $articles = Article::query()
            ->select('name', 'description', 'type')
            ->limit($limit)->offset($offset)
            ->get();

        return apiResponse(
            'Articles retrieved successfully',
            [
                'articles' => $articles
            ],
            [
                'page'  => $request->page != null ? (int)$request->page : 1,
                'limit' => $limit
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
            ->select('name', 'description', 'type', 'file')
            ->where('id', $id)
            ->first();

        if ($article) {
            $article->append('temporary_url');
            $article->makeHidden(['file']);

            return apiResponse(
                "Article retrieved successfully!",
                $article
            );

        } else {
            return apiResponse(
                "Article don't find!",
                $article
            );
        }
    }
}
