<?php

namespace App\Http\Controllers\Api;

use App\Services\NewsFeedService;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class NewsFeedController extends BaseController
{
    private $newsFeedService;

    public function __construct(NewsFeedService $newsFeedService)
    {
        $this->newsFeedService = $newsFeedService;
    }

    public function getFeed(Request $request)
    {
        $userId = $request->user()->id;

        $articles = $this->newsFeedService->getNewsFeed($userId);

        $articles = array_map(function($article) {
            return $article['_source'];
        }, $articles);
        

        return $this->sendResponse($articles,"Success, Articles found.");
    }
}