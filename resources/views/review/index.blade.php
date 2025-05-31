@extends('layouts.app')

@section('title', 'Review')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Review',
'bc_data' => [
[
'link' => '',
'text' => 'Home',
'is_active' => false
],
[
'link' => '',
'text' => 'Review',
'is_active' => true
],
]
])

<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('review.create') }}" class="btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('review.index') }}" id="index_route_route">
                <table id="review_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Device</th>
                            <th>User Name</th>
                            <th>Heading</th>
                            <th>Image 1</th>
                            <th>Image 2</th>
                            <th>Rating</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection