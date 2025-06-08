@extends('layouts.application')

@section('content')
<div class="py-3">
    <div class="row col-12" style="margin: 0 auto;">
        @php
            $grouped = $feedbacks->groupBy('device.name');
        @endphp
        @foreach($grouped as $deviceName => $deviceFeedbacks)
            <h3 class="mb-4 ml-4">{{ $deviceName }}</h3>
            @foreach($deviceFeedbacks as $feedback)
            <div class="col-md-12 col-lg-12 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                            <div class="flex-grow-1">
                                <h4 class="card-title mb-1">{{ $feedback->heading }}</h4>
                                <div class="mb-2" style="font-size: 1.2rem; color: #FFD700;">
                                    {!! str_repeat('★', (int) $feedback->rating) . str_repeat('☆', 5 - (int) $feedback->rating) !!}
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end ms-3" style="min-width: 180px;">
                                <div class="text-end mb-2">
                                    @if(auth()->check() && auth()->id() === $feedback->user_id)
                                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="text-end">{{ \Carbon\Carbon::parse($feedback->created_at)->format('M d, Y')}}</div>
                                <div class="text-end">Review By - {{ $feedback->user->name }}</div>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <img src="{{ asset('images/' . basename($feedback->image_1)) }}" class="img-fluid rounded shadow-sm mb-3 col-md-4" alt="Review Image 1" style="max-height: 170px; object-fit: cover; width: 100%;">
                                <p class="card-text mt-2">{!! nl2br(e($feedback->paragraph_1)) !!}</p>
                            </div>
                            <div class="col-md-8"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
@endsection
