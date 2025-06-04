@extends('layouts.application')

@section('content')
<div class="container py-4" style="background: #f8f9fa; min-height: 100vh;">
    {{-- Brand Bar --}}
    <div class="bg-white rounded shadow-sm p-3 mb-4">
        <h5 class="text-center mb-4" style="color: #F26522;">Filter Laptop<h5>
        <div class="d-flex flex-row flex-nowrap overflow-auto justify-content-center align-items-center mb-2" style="gap: 16px;">
            @foreach ($brands as $brand)
                <a href="{{ route('branded.filter', $brand->id) }}"
                   class="d-flex align-items-center justify-content-center py-2 px-3 rounded
                   {{ isset($selectedBrand) && $selectedBrand->id == $brand->id ? 'bg-primary text-white' : 'text-dark' }}"
                   style="text-decoration: none; transition: background 0.2s; min-width: 120px;">
                    @if($brand->logo_url)
                        <img src="/images/{{ $brand->logo_url }}" alt="{{ $brand->name }}"
                             class="mr-2" style="width: 24px; height: 24px; object-fit: contain; border-radius: 8px;">
                    @endif
                    <span>{{ strtoupper($brand->name) }}</span>
                </a>
            @endforeach
            <a href="{{ url('/filter') }}"
               class="btn btn-outline-primary font-weight-bold ml-2">
                All Brands
            </a>
        </div>
    </div>

    {{-- Device Detail Card --}}
    <div class="bg-white rounded shadow p-4 mx-auto" style="max-width: 900px;">
        <div class="row">
            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                <div class="bg-light rounded p-2 mb-3" style="box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}"
                         class="rounded" style="width: 220px; height: 260px; object-fit: contain;">
                </div>
                @if(!in_array($device->id, $savedDeviceIds))
                <form method="POST" action="{{ route('savedDevices.store', $device->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm" title="Save" style="border-radius: 20px;">
                        <i class="fa fa-bookmark"></i> Save
                    </button>
                </form>
                @endif
            </div>
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-2">
                    @if ($device->brand->logo_url)
                        <img src="/images/{{ $device->brand->logo_url }}" alt="{{ $device->brand->name }}"
                             style="width: 36px; height: 36px; object-fit: contain; border-radius: 8px; margin-right: 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.07);">
                    @endif
                    <h3 class="mb-0" style="color: #003684; font-weight: 700;">{{ $device->brand->name }}</h3>
                </div>
                @if (!empty($device->brand->website_url))
                <p class="mb-2">
                    <a href="{{ $device->brand->website_url }}" target="_blank" style="color: #003684; text-decoration: underline; font-size: 0.95rem;">
                        {{ $device->brand->website_url }}
                    </a>
                </p>
                @endif
                <h4 class="mb-2" style="color: #003684; font-weight: 600;">{{ $device->name }}</h4>
                <p class="mb-2"><strong>Price:</strong> <span style="color: #F26522; font-size: 1.1rem;">{{ number_format($device->price) }} MMK</span></p>
                {{-- Review/Feedback Button --}}
                <div class="mb-3">
                    @if ($device->reviews->isNotEmpty())
                        <a href="{{ route('devices.reviews', $device->id) }}" class="btn btn-primary btn-sm" style="border-radius: 20px;">Read Review</a>
                    @else
                        <a href="{{ route('createReview') }}" class="btn btn-primary btn-sm" style="border-radius: 20px;">Write Feedback</a>
                    @endif
                </div>
            </div>
        </div>
        {{-- Specs --}}
        <div class="mt-4">
            @php
            $groupedSpecs = $device->specs->groupBy(fn($s) => $s->category->name);
            @endphp
            @foreach ($groupedSpecs as $categoryName => $specs)
            <div class="mb-4 p-3 border rounded bg-light" style="box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
                <h5 class="mb-3 text-primary" style="font-weight: 600;">{{ $categoryName }}</h5>
                <table class="table table-bordered table-sm mb-0" style="background: #fff;">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 30%">Spec Name</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specs as $item)
                        <tr>
                            <td style="font-weight: 500;">{{ $item->key }}</td>
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
