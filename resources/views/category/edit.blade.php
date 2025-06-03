@extends('layouts.app')

@section('title', 'Spec Category')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Spec Category',
'bc_data' => [
[
'link' => route('category.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('category.index'),
'text' => 'Category List',
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
            <form action="{{ route('category.update',['category' => $brand]) }}" method="POST">
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