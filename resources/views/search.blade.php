@extends('layouts.application')

@section('content')
<div class="container py-4">
    <h1>Search Results for "{{ $query }}"</h1>
    <form action="{{ route('news.search') }}" method="get" class="mb-4">
        <input type="text" name="query" placeholder="Search news..." value="{{ $query }}">
        <button type="submit">Search</button>
    </form>

    <div class="row">
        @foreach ($results['articles'] as $article)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                @if (!empty($article['urlToImage']))
                    <img src="{{ $article['urlToImage'] }}" class="card-img-top" alt="News Image" style="height: 190px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($article['description'] ?? '', 100) }}</p>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}</p>
                    <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary mt-auto">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a href="/news" class="btn btn-link mt-4">Back to Top Headlines</a>
</div>

@endsection
