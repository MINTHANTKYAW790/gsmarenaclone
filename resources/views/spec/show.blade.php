@extends('layouts.app')

@section('title', 'Device')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Device',
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
        <div class="card-body">

            {{-- Brand --}}
            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Brand:</div>
                <div class="col-md-9">{{ $spec->device->brand->name }}</div>
            </div>

            {{-- Device --}}
            <div class="row mb-2">
                <div class="col-md-3 font-weight-bold">Device:</div>
                <div class="col-md-9">{{ $spec->device->name }}</div>
            </div>

            {{-- Specs Grouped by Category --}}
            @php
                $groupedSpecs = $spec->device->specs->groupBy(fn($s) => $s->category->name);
            @endphp

            @foreach ($groupedSpecs as $categoryName => $specs)
                <div class="mt-4 p-3 border rounded bg-light">
                    <h5 class="mb-3 text-primary">{{ $categoryName }}</h5>
                    
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 30%">Spec Name</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specs as $item)
                                <tr>
                                    <td>{{ $item->key }}</td>
                                    <td>{{ $item->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

        </div>
    </div>
</div>


@endsection