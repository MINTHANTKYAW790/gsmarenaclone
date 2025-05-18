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
            <form action="{{ route('spec.update',['spec' => $spec]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="device_id" class="form-control form-control-sm @error('device_id') is-invalid @enderror"
                            device_id="device_id" value="{{ old('device_id', $spec->device_id) }}">
                        @error('device_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="spec_category_id" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="spec_category_id" class="form-control form-control-sm @error('spec_category_id') is-invalid @enderror"
                            name="spec_category_id" value="{{ old('spec_category_id', $spec->spec_category_id) }}">
                        @error('spec_category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="key" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="key" class="form-control form-control-sm @error('key') is-invalid @enderror"
                            name="key" value="{{ old('key', $spec->key) }}">
                        @error('key')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="value" class="col-sm-4 col-form-label">Website Url <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="value" class="form-control form-control-sm @error('value') is-invalid @enderror"
                            name="value" value="{{ old('value', $spec->value) }}">
                        @error('value')
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