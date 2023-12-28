<?php

namespace Tests\Unit;

use App\Services\IndexNewsService;
use Elasticsearch\Client;
use Tests\TestCase;
use Mockery;

class IndexNewsServiceTest extends TestCase
{
    public function testIndexToElasticsearch()
    {
        // Mock the Elasticsearch client
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('index')->once();

        // Create an instance of the service with the mocked client
        $service = new IndexNewsService($client);

        // Define the data to be indexed
        $data = [
            [
                'url_hash' => 'hash1',
                'title' => 'Title 1',
                'content' => 'Content 1',
            ],
            [
                'url_hash' => 'hash2',
                'title' => 'Title 2',
                'content' => 'Content 2',
            ],
        ];

        // Call the method to be tested
        $service->indexToElasticsearch($data);

        // Assertions are made via the mock
    }
}