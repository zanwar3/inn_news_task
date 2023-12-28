<?php

namespace App\Utilities;

use Elasticsearch\ClientBuilder;

class ElasticsearchClient
{
    public static function create() {
        return ClientBuilder::create()->setHosts([env('ELASTICSEARCH_HOST').':'.env('ELASTICSEARCH_PORT')])->build();
    }
}