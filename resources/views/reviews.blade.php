@extends('layouts.application')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('createReview') }}" class="btn btn-lg rounded-pill shadow" style="background: linear-gradient(90deg, #f26522 60%, #ffb347 100%); color: #fff; border:none;">
            <i class="bi bi-plus-circle"></i> Create Review
        </a>
    </div>
    <div class="row g-4">
        @foreach($reviews as $review)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-lg border-0 rounded-4 position-relative review-card" style="overflow:hidden;">
                @if ($review->image_1)
                    <div class="position-relative">
                        <img src="{{ asset('images/' . basename($review->image_1)) }}" class="card-img-top rounded-top-4" alt="Review Image" style="height: 190px; object-fit: cover;">
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-0">
                            <div class="bg-dark bg-opacity-50 text-white px-3 py-2 rounded-bottom-4">
                                <h6 class="mb-0">{{ $review->device->name }}</h6>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2" style="color:#f26522;">{{ $review->heading }}</h5>
                    <div class="mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                        @endfor
                    </div>
                    <p class="mb-1 small">By <span class="fw-semibold">{{ $review->user->name }}</span></p>
                    <p class="text-muted mb-3 small">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</p>
                    <a href="{{ route('devices.reviews', $review->id) }}" class="btn btn-outline-warning mt-auto rounded-pill px-4">
                        <i class="bi bi-eye"></i> Read More
                    </a>
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

@push('styles')
<style>
.review-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 32px rgba(242,101,34,0.15);
    transition: all 0.2s;
}
</style>
@endpush
@endsection