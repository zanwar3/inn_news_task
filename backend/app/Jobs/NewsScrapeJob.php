<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\ScrapeNewsService;

class NewsScrapeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $category;

    /**
     * Create a new job instance.
     */
    public function __construct(String $category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(ScrapeNewsService::class)->scrapeNews($this->category);
    }
}
