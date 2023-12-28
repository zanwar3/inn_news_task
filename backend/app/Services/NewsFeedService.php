<?php

namespace App\Services;

use App\Repositories\UserPreferenceRepository;

class NewsFeedService
{
    private $userPreferenceRepository;
    private $searchService;

    public function __construct(UserPreferenceRepository $userPreferenceRepository, SearchNewsService $searchService)
    {
        $this->userPreferenceRepository = $userPreferenceRepository;
        $this->searchService = $searchService;
    }

    public function getNewsFeed($userId)
    {
        $preferences = $this->userPreferenceRepository->getPreferencesByUserId($userId);

        $articles = [];
        if (count($preferences) > 0) {

            $categories = array_filter($preferences->pluck('category')->toArray(), 'strlen') ?? [];
            $sources = array_filter($preferences->pluck('source')->toArray(), 'strlen') ?? [];

            $articles = $this->searchService->searchArticles(
                '',
                $categories,
                $sources
            );
        }
        return $articles;
    }
}