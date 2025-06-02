<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    protected $apiKey;
    protected $baseUrl = 'https://newsapi.org/v2/';

    public function __construct()
    {
        $this->apiKey = config('services.newsapi.key');
    }

    public function getTopHeadlines($keywords = ['phone', 'tablet', 'smartwatch'])
{
    $query = implode(' OR ', $keywords);

    $response = Http::get($this->baseUrl . 'everything', [
        'q' => $query,
        'language' => 'en',
        'sortBy' => 'publishedAt',
        'apiKey' => $this->apiKey,
    ]);

    return $response->json();
}


    public function searchNews($query)
    {
        $response = Http::get($this->baseUrl . 'everything', [
            'q' => $query,
            'apiKey' => $this->apiKey,
        ]);

        return $response->json();
    }
}
