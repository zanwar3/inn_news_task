<?php

namespace App\Services;

use Elasticsearch\Client;

class SearchNewsService
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }
    public function searchArticles(string $keyword, array $categories = null, array $sources = null, string $fromDate = null, string $toDate = null,$page=1, $size=50)
    {
        $params = [
            'index' => 'news',
            'from' => ($page - 1) * $size,
            'size'=> $size,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [],
                        'should' => [],
                        'minimum_should_match' => ($categories || $sources || $fromDate || $toDate) ? 1 : 0
                    ]
                ]
            ]
        ];
    
        if ($keyword) {
            $params['body']['query']['bool']['must'][] = [
                'multi_match' => [
                    'query' => $keyword,
                    'fields' => ['title', 'description', 'content']
                ]
            ];
        }
    
        if ($categories) {
            $params['body']['query']['bool']['should'][] = ['terms' => ['category' => $categories]];
        }
    
        if ($sources) {
            $params['body']['query']['bool']['should'][] = ['terms' => ['source' => $sources]];
        }
    
        if ($fromDate && $toDate) {
            $params['body']['query']['bool']['should'][] = [
                'range' => [
                    'published_at' => [
                        'gte' => $fromDate,
                        'lte' => $toDate
                    ]
                ]
            ];
        }
    
        if (!$keyword && !$categories && !$sources && !$fromDate && !$toDate) {
            $params['body']['query'] = ['match_all' => new \stdClass()];
        }
    
        $results = $this->elasticsearch->search($params);
        return $results['hits']['hits'];
    }
}