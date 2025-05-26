@extends('layouts.app')

@section('title', 'Device')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Device',
'bc_data' => [
[
'link' => '',
'text' => 'Home',
'is_active' => false
],
[
'link' => '',
'text' => 'List',
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
            <form action="{{ route('device.update',['device' => $device]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row col-md-7">
                    <label for="brand_id" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="brand_id" class="form-control form-control-sm @error('brand_id') is-invalid @enderror"
                            name="brand_id" value="{{ old('brand_id', $device->brand_id) }}">
                        @error('brand_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="name" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $device->name) }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="release_date" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="release_date" class="form-control form-control-sm @error('release_date') is-invalid @enderror"
                            name="release_date" value="{{ old('release_date', $device->release_date) }}">
                        @error('release_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="price" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="price" class="form-control form-control-sm @error('price') is-invalid @enderror"
                            name="price" value="{{ old('price', $device->price) }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="image_url" class="col-sm-4">image_url<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_url" hidden name="image_url" accept="image/*">
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ asset($device->image_url) }}" alt="Device Image" class="img-fluid w-100 h-100 default">
                            <img alt="Default Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="os" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="os" class="form-control form-control-sm @error('os') is-invalid @enderror"
                            name="os" value="{{ old('os', $device->os) }}">
                        @error('os')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="device_type" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="device_type" class="form-control form-control-sm @error('device_type') is-invalid @enderror"
                            name="device_type" value="{{ old('device_type', $device->device_type) }}">
                        @error('device_type')
                        <span class="text-danger">{{ $message }}</span>
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