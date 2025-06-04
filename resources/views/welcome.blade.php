@extends('layouts.application')

@section('content')
<div class="container py-4">
    {{-- Upper Bar: Brands --}}
    <div class="bg-white rounded shadow-sm p-3 mb-4">
        <h5 class="text-center mb-4" style="color: #F26522;">Filter Laptop</h5>
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

    {{-- Lower Bar: Devices --}}
    <div class="bg-white rounded shadow-sm p-3">
        <div class="mb-3">
            <h6 style="color: #F26522;">
                {{ isset($selectedBrand) ? "The products of " . strtoupper($selectedBrand->name) . " :" : "All Devices" }}
            </h6>
        </div>
        <div class="row">
            @forelse ($devices as $device)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">{{ $device->name }}</span>
                        @if(!in_array($device->id, $savedDeviceIds))
                        <form method="POST" action="{{ route('savedDevices.store', $device->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light" title="Save">
                                <i class="fa fa-bookmark"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                    <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}"
                         class="card-img-top mx-auto d-block" style="width: 170px; height: 200px; object-fit: contain;">
                    <div class="card-body">
                        @php
                        $memorySpecs = $device->specs->filter(function ($spec) {
                            return $spec->category->name === 'Memory';
                        });
                        @endphp

                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted">
                                {{ $memorySpecs->isNotEmpty() ? $memorySpecs->pluck('value')->implode(', ') : '-' }}
                            </span>
                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1" title="View" style="border-radius: 20px; padding: 4px 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin-right: 4px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span style="font-size: 13px;">View</span>
                            </a>
                        </div>
                        <p class="mb-2 font-weight-bold" style="color: #F26522;">{{ number_format($device->price) }} MMK</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">No devices found for this brand.</div>
            </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $devices->links() }}
        </div>
    </div>
</div>
@endsection
