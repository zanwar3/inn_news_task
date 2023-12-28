<?php

namespace Tests\Unit;

use App\Services\SearchNewsService;
use Elasticsearch\Client;
use Tests\TestCase;
use Mockery;

class SearchNewsServiceTest extends TestCase
{
    public function testSearchArticles()
    {
        // Mock the Elasticsearch client
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('search')->once()->andReturn([
            'hits' => [
                'hits' => [
                    [
                        '_source' => [
                            'title' => 'Test Title',
                            'description' => 'Test Description',
                            'content' => 'Test Content',
                        ]
                    ]
                ]
            ]
        ]);

        // Create an instance of the service with the mocked client
        $service = new SearchNewsService($client);

        // Call the method to be tested
        $results = $service->searchArticles('test');

        // Assert that the results are as expected
        $this->assertEquals([
            [
                '_source' => [
                    'title' => 'Test Title',
                    'description' => 'Test Description',
                    'content' => 'Test Content',
                ]
            ]
        ], $results);
    }
}