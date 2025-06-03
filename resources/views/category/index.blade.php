@extends('layouts.app')

@section('title', 'Spec Category')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Spec Category',
'bc_data' => [
[
'link' => route('brand.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => '',
'text' => 'Spec Category',
'is_active' => true
],
]
])

<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('category.index') }}" id="index_route_route">
                <table id="spec_category_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection