@extends('layouts.application')

@section('content')
<div class="py-3">
    <div class="row col-12" style="margin: 0 auto;">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-lg border-0">
                <div class="card-body">
                    <h4 class="card-title mb-1">{{ $review->device->name }}</h4>
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <div class="flex-grow-1">
                            <h4 class="card-title mb-1">{{ $review->heading }}</h4>
                            <div class="mb-2" style="font-size: 1.2rem; color: #FFD700;">
                                {!! str_repeat('★', (int) $review->rating) . str_repeat('☆', 5 - (int) $review->rating) !!}
                            </div>
                        </div>
                        <div class="text-end ms-3" style="min-width: 180px;">
                            <div class="text-right">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y')}}</div>
                            <div class="text-right">Review By - {{ $review->user->name }}</div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . basename($review->image_1)) }}" class="img-fluid rounded shadow-sm mb-3" alt="Review Image 1" style="max-height: 170px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <p class="card-text">{!! nl2br(e($review->paragraph_1)) !!}</p>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-2">
                        <div class="col-md-8 order-md-2">
                            <p class="card-text">{!! nl2br(e($review->paragraph_2)) !!}</p>
                        </div>
                        <div class="col-md-4 order-md-1">
                            <img src="{{ asset('images/' . basename($review->image_2)) }}" class="img-fluid rounded shadow-sm mb-3" alt="Review Image 2" style="max-height: 170px; object-fit: cover; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection