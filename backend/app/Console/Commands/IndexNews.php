<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Jobs\IndexNewsJob;
use Carbon\Carbon;
use Exception;

class IndexNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    private $indexNewsService;

    public function __construct()
    {
        parent::__construct();

    }
    public function handle()
    {
        $posts = News::where('created_at', '>=', Carbon::now()->subHour())->get();
        if ($posts && count($posts) > 0) {
            try {
                \Log::info('Indexing News...');
                IndexNewsJob::dispatch($posts->toArray());
            } catch (Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        $this->info("News were successfully indexed");
    }
}
