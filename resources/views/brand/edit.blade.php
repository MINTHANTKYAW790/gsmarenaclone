@extends('layouts.app')

@section('title', 'Brand')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Brand',
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
            <form action="{{ route('brand.update',['brand' => $brand]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row col-md-7">
                    <label for="name" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $brand->name) }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($brand->logo_url)
                <div class="mb-2">
                    <img src="{{ $brand->logo_url }}" alt="Current Logo" style="max-height: 100px;">
                </div>
                @endif

                <div class="form-group row col-md-7">
                    <label for="logo_url" class="col-sm-4 col-form-label">Logo Image <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input id="logo_url" type="file" class="form-control form-control-sm @error('logo_url') is-invalid @enderror" accept="image/*" name="logo_url" value="{{ old('logo_url') }}">
                        @error('logo_url')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="website_url" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="website_url" class="form-control form-control-sm @error('website_url') is-invalid @enderror"
                            name="website_url" value="{{ old('website_url', $brand->website_url) }}">
                        @error('website_url')
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