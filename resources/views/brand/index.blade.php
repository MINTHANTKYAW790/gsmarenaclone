@extends('layouts.app')

@section('title', 'Brand')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Brand',
'bc_data' => [
[
'link' => route('brand.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => '',
'text' => 'Brand',
'is_active' => true
],
]
])

<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('brand.create') }}" class="btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('brand.index') }}" id="index_route_route">
                <table id="brand_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Website Url</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection