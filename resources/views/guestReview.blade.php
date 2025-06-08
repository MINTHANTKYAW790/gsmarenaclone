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
                        <div class="col-12">
                            <img src="{{ asset('images/' . basename($review->image_1)) }}" class="img-fluid rounded shadow-sm mb-3 w-100 col-md-4"  alt="Review Image 1" style="max-height: 250px; object-fit: cover;">
                            <p class="card-text mt-2">{!! nl2br(e($review->paragraph_1)) !!}</p>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-12">
                            <img src="{{ asset('images/' . basename($review->image_2)) }}" class="img-fluid rounded shadow-sm mb-3 w-100 col-md-4" alt="Review Image 2" style="max-height: 250px; object-fit: cover;">
                            <p class="card-text mt-2">{!! nl2br(e($review->paragraph_2)) !!}</p>
                        </div>
                    </div>
                    @if($review->logo1 || $review->logo2 || $review->logo3)
                        <div class="mt-4">
                            <h5>Explore Trusted Reviews</h5>
                            <div class="row">
                                @if($review->logo1 && $review->link1)
                                    <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/' . basename($review->logo1)) }}" alt="Logo 1" class="img-fluid me-2 mr-2" style="height: 50px; width: 50px;">
                                        <a href="{{ $review->link1 }}" target="_blank" rel="noopener">Link 1</a>
                                    </div>
                                @endif
                                @if($review->logo2 && $review->link2)
                                    <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/' . basename($review->logo2)) }}" alt="Logo 2" class="img-fluid me-2 mr-2" style="height: 50px; width: 50px;">
                                        <a href="{{ $review->link2 }}" target="_blank" rel="noopener">Link 2</a>
                                    </div>
                                @endif
                                @if($review->logo3 && $review->link3)
                                    <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/' . basename($review->logo3)) }}" alt="Logo 3" class="img-fluid me-2 mr-2" style="height: 50px; width: 50px;">
                                        <a href="{{ $review->link3 }}" target="_blank" rel="noopener">Link 3</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection