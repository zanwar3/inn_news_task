<?php

namespace App\Jobs;

use App\Services\IndexNewsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $posts;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IndexNewsService $indexNewsService)
    {
        $indexNewsService->indexToElasticsearch($this->posts);
    }
}