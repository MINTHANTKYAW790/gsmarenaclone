@extends('layouts.app')

@section('title', 'Review')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Review',
'bc_data' => [
[
'link' => route('review.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('review.index'),
'text' => 'Review List',
'is_active' => false
],
[
'link' => '',
'text' => 'Create',
'is_active' => true
]
]
])
<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Brand:</div>
                <div class="col-md-9">{{ $review->device->brand->name }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Device:</div>
                <div class="col-md-9">{{ $review->device->name }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Review Heading:</div>
                <div class="col-md-9">{{ $review->heading }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Image 1:</div>
                <div class="col-md-9">
                    @if($review->image_1)
                        <img src="{{ asset('images/' . basename($review->image_1)) }}" alt="Image 1" height="150">
                    @else
                        <span>No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Paragraph 1:</div>
                <div class="col-md-9">{{ $review->paragraph_1 }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Image 2:</div>
                <div class="col-md-9">
                    @if($review->image_2)
                        <img src="{{ asset('images/' . basename($review->image_2)) }}" alt="Image 2" height="150">
                    @else
                        <span>No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Paragraph 2:</div>
                <div class="col-md-9">{{ $review->paragraph_2 }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Rating:</div>
                <div class="col-md-9">{{ $review->rating }} / 5</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">logo1:</div>
                <div class="col-md-9">
                    @if($review->logo1)
                        <img src="{{ asset('images/' . basename($review->logo1)) }}" alt="logo1" height="150">
                    @else
                        <span>No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">link2:</div>
                <div class="col-md-9">{{ $review->link1 }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">logo2:</div>
                <div class="col-md-9">
                    @if($review->logo2)
                        <img src="{{ asset('images/' . basename($review->logo2)) }}" alt="logo1" height="150">
                    @else
                        <span>No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">link2:</div>
                <div class="col-md-9">{{ $review->link1 }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">logo3:</div>
                <div class="col-md-9">
                    @if($review->logo3)
                        <img src="{{ asset('images/' . basename($review->logo3)) }}" alt="logo1" height="150">
                    @else
                        <span>No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">link3:</div>
                <div class="col-md-9">{{ $review->link1 }}</div>
            </div>

        </div>
    </div>
</div>


@endsection