@extends('layouts.application')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Top Headlines</h1>
        <form action="{{ route('news.search') }}" method="get" class="d-flex" style="max-width: 350px;">
            <input 
                type="text" 
                name="query" 
                class="form-control me-2" 
                placeholder="Search news..." 
                aria-label="Search"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    

    <div class="row">
        @foreach ($headlines['articles'] as $article)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                @if (!empty($article['urlToImage']))
                    <img src="{{ $article['urlToImage'] }}" class="card-img-top" alt="News Image" style="height: 190px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($article['description'], 100) }}</p>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}</p>
                    <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary mt-auto">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
