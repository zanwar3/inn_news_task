<?php

use Illuminate\Support\Facades\Route;
use App\Services\ScrapeNewsService;
use App\Services\IndexNewsService;
use App\Models\News;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    app(ScrapeNewsService::class)->scrapeNews('general');
    app(IndexNewsService::class)->indexToElasticsearch(News::All()->toArray());
    return view('welcome');
});
