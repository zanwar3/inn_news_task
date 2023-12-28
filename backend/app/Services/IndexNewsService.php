<?php

namespace App\Services;

use Elasticsearch\Client;

class IndexNewsService
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch){
        $this->elasticsearch = $elasticsearch;
    }

    public function indexToElasticsearch(array $data) {
        foreach ($data as $item) {
            $params = [
                'index' => 'news', 
                'id'    => $item['url_hash'], 
                'body'  => $item 
            ];
            $this->elasticsearch->index($params);
        }
    }
}