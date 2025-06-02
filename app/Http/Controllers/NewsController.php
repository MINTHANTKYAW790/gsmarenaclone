<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    protected $news;

    public function __construct(NewsService $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $headlines = $this->news->getTopHeadlines();

        return view('news', compact('headlines'));
    }

    public function search()
    {
        $query = request()->input('query');
        $results = $this->news->searchNews($query);

        return view('search', compact('results', 'query'));
    }
}
