<?php

namespace App\Services;

use Carbon\Carbon;

use App\Models\News;




class ScrapeNewsService
{

    private $client;
    private $endpoint = "https://newsapi.org/v2/top-headlines?";

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    private function getNews(int $page = 1, string $category)
    {
        $response = $this->client->request('GET', $this->endpoint, ['query' => [
            'from' => Carbon::now()->format('Y-m-d'),
            'category' => $category,
            'page' => $page,
            'pageSize' => 100,
            'apiKey' => env('NEWS_API_KEY'),
        ]]);
        return json_decode($response->getBody());

    }




    public function scrapeNews(string $category)
    {
        $data = [];
        $resp = null;
        $page = 1;
        $resp = $this->getNews($page, $category);
        foreach ($resp->articles as $article) {
            $temp = [];
            $temp['source'] = $article->source->name;
            $temp['author'] = $article->author;
            $temp['title'] = $article->title;
            $temp['description'] = $article->description;
            $temp['url'] = $article->url;
            $temp['url_hash'] = hash('sha256', $article->url);
            $temp['url_to_image'] = $article->urlToImage;
            $temp['content'] = $article->content;
            $temp['category'] = $category;
            $temp['published_at'] = new Carbon($article->publishedAt);
            $temp['created_at'] = Carbon::now();
            $temp['updated_at'] = Carbon::now();
            array_push($data, $temp);
        }

        News::insertOrIgnore($data);
    }
}
