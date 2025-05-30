@extends('layouts.application')

@section('content')
<div class="container py-4">
    <div class="row">
        @foreach($reviews as $review)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                @if ($review->image_1)
                    <img src="{{ asset('images/' . basename($review->image_1)) }}" class="card-img-top" alt="Review Image">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $review->heading }}</h5>
                    <div class=" text-warning">
                        {!! str_repeat('★', (int)$review->rating) !!}
                        {!! str_repeat('☆', 5 - (int)$review->rating) !!}
                    </div>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</p>
                    <a href="{{ route('devices.reviews', $review->id) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links() }}
    </div>
</div>
@endsection