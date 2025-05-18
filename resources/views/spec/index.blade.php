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
'text' => 'Spec',
'is_active' => true
],
]
])

<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('spec.create') }}" class="btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('spec.index') }}" id="index_route_route">
                <table id="brand_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Device</th>
                            <th>Category</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection