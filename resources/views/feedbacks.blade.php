@extends('layouts.application')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('feedback.create') }}" class="btn btn-success" style="background-color:#003684">Create Feedback</a>
    </div>
    <div class="row">
        @foreach($feedbacks as $feedback)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                @if ($feedback->image_1)
                <img src="{{ asset('images/' . basename($feedback->image_1)) }}" class="card-img-top" alt="Review Image" style="height: 190px;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $feedback->device->name }}</h5>

                    <h5 class="card-title">{{ $feedback->heading }}</h5>
                    <div class=" text-warning">
                        {!! str_repeat('★', (int)$feedback->rating) !!}
                        {!! str_repeat('☆', 5 - (int)$feedback->rating) !!}
                    </div>
                    <p>Review By - {{ $feedback->user->name }}</p>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($feedback->created_at)->format('d M Y') }}</p>
                    <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection