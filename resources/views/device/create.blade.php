@extends('layouts.app')

@section('title', 'Device')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Device',
'bc_data' => [
[
'link' => route('device.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('device.index'),
'text' => 'Device List',
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
            <form action="{{ route('device.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group row col-md-7">
                    <label for="brand_id" class="col-sm-4 col-form-label">Select Brand</label>
                    <div class="col-sm-8">
                        <select name="brand_id" class="form-control form-control-sm @error('brand_id') is-invalid @enderror" id="brand_id" required>
                            <option value="">-- Select Brand --</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                @push('styles')
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                @endpush
                @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#brand_id').select2({
                            placeholder: "-- Select Brand --",
                            allowClear: true,
                            width: '100%'
                        });
                    });
                </script>
                @endpush
                <div class="form-group row col-md-7">
                    <label for="name" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            name="name" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="release_date" class="col-sm-4 col-form-label">Release Date<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" id="release_date" class="form-control form-control-sm @error('release_date') is-invalid @enderror" name="release_date" required>
                        @error('release_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="price" class="col-sm-4 col-form-label">Price<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="price" class="form-control form-control-sm @error('price') is-invalid @enderror"
                            name="price" required>
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7" >
                    <label for="image_url" class="col-sm-4 col-form-label">Logo Image <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" id="image_url" name="image_url" hidden accept="image/*" >
                        <div class="align-items-center bg-light d-flex justify-content-center rounded w-100 img-container" style="height: 250px;">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-fluid default">
                            <img alt="Preview Image" class="img-fluid d-none w-100 h-100 rounded">
                        </div>
                        @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="os" class="col-sm-4 col-form-label">Operation System<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="os" class="form-control form-control-sm @error('os') is-invalid @enderror"
                            name="os" required>
                        @error('os')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-7">
                    <label for="device_type" class="col-sm-4 col-form-label">Device Type <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select id="device_type" name="device_type" class="form-control form-control-sm @error('device_type') is-invalid @enderror" required>
                            <option value="">-- Select Device Type --</option>
                            <option value="phone" {{ old('device_type') == 'phone' ? 'selected' : '' }}>Phone</option>
                            <option value="tablet" {{ old('device_type') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="smartwatch" {{ old('device_type') == 'smartwatch' ? 'selected' : '' }}>Smartwatch</option>
                        </select>
                        @error('device_type')
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
<script>
    $(function() {
        $("#release_date").datepicker({
            dateFormat: "yy-mm-dd", 
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2030"
        });
    });
</script>

@endsection