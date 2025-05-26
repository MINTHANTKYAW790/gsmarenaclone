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
            <form action="{{ route('brand.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group row col-md-7">
                    <label for="name" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            name="name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7" >
                    <label for="logo_url" class="col-sm-4 col-form-label">Logo Image <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="logo_url" name="logo_url" hidden accept="image/*">
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('logo_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="website_url" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="website_url" class="form-control form-control-sm @error('website_url') is-invalid @enderror"
                            name="website_url">
                        @error('website_url')
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