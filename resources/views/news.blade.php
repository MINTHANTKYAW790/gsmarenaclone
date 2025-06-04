@extends('layouts.application')

@section('content')
<style>
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .news-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .news-search {
        max-width: 400px;
        margin: 0 auto 2rem auto;
    }
    .news-card {
        border: 1px solid #e3e3e3;
        border-radius: 8px;
        background: #fff;
        transition: box-shadow 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    }
    .news-card img {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        height: 170px;
        object-fit: cover;
    }
    .news-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .news-card-date {
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 0.5rem;
    }
    .news-card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }
    .news-card-link {
        margin-top: auto;
        color: #0056b3;
        text-decoration: none;
        font-weight: 500;
    }
    .news-card-link:hover {
        text-decoration: underline;
    }
</style>
<div class="container py-4">
    <div class="news-header">
        <h1>Top Headlines</h1>
    </div>
    <form action="{{ route('news.search') }}" method="get" class="news-search d-flex">
        <input 
            type="text" 
            name="query" 
            class="form-control me-2" 
            placeholder="Search news..." 
            aria-label="Search"
        >
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div class="row g-4">
        @foreach ($headlines['articles'] as $article)
        <div class="col-md-4 col-lg-3 mt-2">
            <div class="news-card">
                @if (!empty($article['urlToImage']))
                    <img src="{{ $article['urlToImage'] }}" alt="News Image">
                @endif
                <div class="news-card-body">
                    <div class="news-card-title">{{ $article['title'] }}</div>
                    <div class="news-card-date">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}</div>
                    <div class="mb-2">{{ \Illuminate\Support\Str::limit($article['description'], 90) }}</div>
                    <a href="{{ $article['url'] }}" target="_blank" class="news-card-link">Read More &rarr;</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
