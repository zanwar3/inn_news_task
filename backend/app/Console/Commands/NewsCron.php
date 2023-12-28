<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Jobs\NewsScrapeJob;

class NewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command scrapes news based on categories';
    //these can be later fetched from DB or external source
    //for now it is static
    protected $categories = ['general','business','sports','science','health','entertainment','technology'];

       /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach($this->categories as $category){
            \Log::info("scrapping news:".$category);
            dispatch(new NewsScrapeJob($category));
        }
    }
}
