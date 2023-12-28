<?php

namespace Tests\Unit;

use App\Services\ScrapeNewsService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use Mockery;
use App\Models\News;

class ScrapeNewsServiceTest extends TestCase
{
    public function testScrapeNews()
    {
        // Mock the GuzzleHttp client
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')->once()->andReturn(new Response(200, [], json_encode([
            'articles' => [
                [
                    'source' => ['name' => 'Test Source'],
                    'author' => 'Test Author',
                    'title' => 'Test Title',
                    'description' => 'Test Description',
                    'url' => 'https://test.com',
                    'urlToImage' => 'https://test.com/image.jpg',
                    'content' => 'Test Content',
                    'publishedAt' => '2022-01-01T00:00:00Z',
                ]
            ]
        ])));

        // Mock the News model
        $newsMock = Mockery::mock('overload:' . News::class);
        $newsMock->shouldReceive('insertOrIgnore')->once();

        // Create an instance of the service with the mocked client
        $service = new ScrapeNewsService($client);

        // Call the method to be tested
        $service->scrapeNews('test');

        // Assertions are made via the mocks
    }
}