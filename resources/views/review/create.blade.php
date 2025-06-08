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
            <form action="{{ route('review.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Select Device</label>
                    <div class="col-sm-8">
                        <select name="device_id" class="form-control form-control-sm @error('device_id') is-invalid @enderror" id="device_id" required>
                            <option value="">-- Select Device --</option>
                            @foreach ($devices as $device)
                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                        @error('device_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="heading" class="col-sm-4 col-form-label">Heading <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="heading" class="form-control form-control-sm @error('heading') is-invalid @enderror"
                            name="heading" required>
                        @error('heading')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="image_1" class="col-sm-4 col-form-label">Image 1<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_1" name="image_1" hidden accept="image/*" required>
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_1') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="paragraph_1" class="col-sm-4 col-form-label">Paragraph 1 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <textarea id="paragraph_1" class="form-control form-control-sm @error('paragraph_1') is-invalid @enderror"
                            name="paragraph_1" rows="4" required></textarea>
                        @error('paragraph_1')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="image_2" class="col-sm-4 col-form-label">Image 2    <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_2" name="image_2" hidden accept="image/*" required>
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="paragraph_2" class="col-sm-4 col-form-label">Paragraph 2 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <textarea id="paragraph_2" class="form-control form-control-sm @error('paragraph_2') is-invalid @enderror"
                            name="paragraph_2" rows="4" required></textarea>
                        @error('paragraph_2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="rating" class="col-sm-4 col-form-label">Rating <span class="text-danger">*</span></label>
                    <div class="col-sm-8 d-flex align-items-center">
                        <select id="rating" name="rating" class="form-control form-control-sm @error('rating') is-invalid @enderror" required>
                            <option value="">-- Select Rating --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('rating')
                        <span class="text-danger ml-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row col-md-7">
                    <label for="logo1" class="col-sm-4 col-form-label">Logo 1<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="logo1" name="logo1" hidden accept="image/*" required>
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 150px;width:150px !important;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('logo1') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="link1" class="col-sm-4 col-form-label">Link 1<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="link1" class="form-control form-control-sm @error('link1') is-invalid @enderror"
                            name="link1" required>
                        @error('link1')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row col-md-7">
                    <label for="logo2" class="col-sm-4 col-form-label">Logo 2<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="logo2" name="logo2" hidden accept="image/*" required>
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 150px;width:150px !important;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('logo2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="link2" class="col-sm-4 col-form-label">Link 2 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="link2" class="form-control form-control-sm @error('link2') is-invalid @enderror"
                            name="link2" required>
                        @error('link2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row col-md-7">
                    <label for="logo3" class="col-sm-4 col-form-label">Logo 3<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="logo3" name="logo3" hidden accept="image/*" required>
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 150px;width:150px !important;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('logo3') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="link3" class="col-sm-4 col-form-label">Link 3<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="link3" class="form-control form-control-sm @error('link3') is-invalid @enderror"
                            name="link3" required>
                        @error('link3')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3 text-right">
                    <button type="button" class="btn btn-sm btn-cancel back">Back</button>
                    <button type="submit" class="ml-2 btn btn-sm btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection