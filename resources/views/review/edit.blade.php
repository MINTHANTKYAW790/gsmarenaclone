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
        <div class="card-body p-3">
            <form action="{{ route('review.update',['review' => $review]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Select Device</label>
                    <div class="col-sm-8">
                        <select name="device_id" class="form-control form-control-sm @error('device_id') is-invalid @enderror" id="device_id" readonly>
                            <option value="{{ $device->id }}" selected>{{ $device->name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="heading" class="col-sm-4 col-form-label">Heading <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="heading" class="form-control form-control-sm @error('heading') is-invalid @enderror"
                            name="heading" value="{{ old('heading', $review->heading) }}">
                        @error('heading')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="image_1" class="col-sm-4">Image 1<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_1" hidden name="image_1" accept="image/*">
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ $review->image_1 }}" alt="Default Image" class="img-fluid w-100 h-100 default">
                            <img alt="Default Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_1') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="paragraph_1" class="col-sm-4 col-form-label">Paragraph 1 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <textarea id="paragraph_1" class="form-control form-control-sm @error('paragraph_1') is-invalid @enderror"
                            name="paragraph_1" rows="4">{{ old('paragraph_1', $review->paragraph_1) }}</textarea>
                        @error('paragraph_1')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="image_2" class="col-sm-4">Image 2<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_2" hidden name="image_2" accept="image/*">
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ $review->image_2 }}" alt="Default Image" class="img-fluid w-100 h-100 default">
                            <img alt="Default Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="paragraph_2" class="col-sm-4 col-form-label">Paragraph 2 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <textarea id="paragraph_2" class="form-control form-control-sm @error('paragraph_2') is-invalid @enderror"
                            name="paragraph_2" rows="4">{{ old('paragraph_2', $review->paragraph_2) }}</textarea>
                        @error('paragraph_2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="rating" class="col-sm-4 col-form-label">Rating <span class="text-danger">*</span></label>
                    <div class="col-sm-8 d-flex align-items-center">
                        <select id="rating" name="rating" class="form-control form-control-sm @error('rating') is-invalid @enderror">
                            <option value="">-- Select Rating --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>
                        @error('rating')
                        <span class="text-danger ml-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3 text-right">
                    <button type="button" class="btn btn-sm btn-cancel back">Back</button>
                    <button type="submit" class="ml-2 btn btn-sm btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection