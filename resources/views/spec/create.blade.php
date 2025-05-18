@extends('layouts.app')

@section('title', 'Spec')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Spec',
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
            <form action="{{ route('spec.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Select Devices</label>
                    <div class="col-sm-8">
                        <select name="device_id" class=" form-control form-control-sm @error('device_id') is-invalid @enderror" id="device_id">
                            <option value="">-- Select Device --</option>
                            @foreach ($devices as $device)
                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                        @error('device_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="spec_category" class="col-sm-4 col-form-label">Select Category</label>
                    <div class="col-sm-8">
                        <select name="spec_category" class=" form-control form-control-sm @error('spec_category') is-invalid @enderror" id="spec_category">
                            <option value="">-- Select Category --</option>
                            @foreach ($spec_categories as $spec_category)
                            <option value="{{ $spec_category->id }}">{{ $spec_category->name }}</option>
                            @endforeach
                        </select>
                        @error('spec_category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="key" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="key" class="form-control form-control-sm @error('key') is-invalid @enderror"
                            name="key">
                        @error('key')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="value" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="value" class="form-control form-control-sm @error('value') is-invalid @enderror"
                            name="value">
                        @error('value')
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