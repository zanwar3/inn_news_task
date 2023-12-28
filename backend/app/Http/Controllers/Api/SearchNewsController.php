<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\SearchNewsService;

class SearchNewsController extends BaseController
{
    private $searchService;

    public function __construct(SearchNewsService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword') ?? "";
        $categories = $request->input('categories') ?? [];
        $sources = $request->input('sources') ?? [];
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $page = $request->input('page') ?? 1;
        $size = $request->input('size') ?? 50;
        $articles = $this->searchService->searchArticles($keyword, $categories, $sources, $fromDate, $toDate, $page, $size);

        $articles = array_map(function ($article) {
            return $article['_source'];
        }, $articles);

        return $this->sendResponse($articles, "Success, Articles Retrived");
    }
}