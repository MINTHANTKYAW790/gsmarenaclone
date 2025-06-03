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
'link' => '',
'text' => 'Device',
'is_active' => true
],
]
])

<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('device.create') }}" class="btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('device.index') }}" id="index_route_route">
                <table id="device_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th>Release Date</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Os</th>
                            <th>Device Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection