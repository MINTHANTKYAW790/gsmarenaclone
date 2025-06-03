@extends('layouts.application')

@section('content')
<div class="container py-4">
    <h4 class="ml-2 mb-3" style="color: #003684;">Search Results for "{{ $query }}"</h4>

    {{-- Devices Section --}}
    <div class="">
        <h6 class="ml-2 mb-2" style="color: #003684;">Devices Found</h6>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;" class="ml-2">
            @forelse ($devices as $device)
            <div style="border: 1px solid #ccc; text-align: center;" class="card">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <p class="m-0">{{ $device->name }}</p>
                    @if(!in_array($device->id, $savedDeviceIds))
                    <form method="POST" action="{{ route('savedDevices.store', $device->id) }}" style="margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary" style="border: transparent;"><i class="fa fa-bookmark" style="color: black;"></i></button>
                    </form>
                    @endif
                </div>

                <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}" style="width: 170px; height: 200px; margin: 0 auto;">

                <div style="display: flex; align-items: center; justify-content: space-between;" class="mb-2">
                    <div class="phoneDetailLeft" style="width: 65%;">
                        @php
                        $memorySpecs = $device->specs->filter(fn($spec) => $spec->category->name === 'Memory');
                        @endphp

                        @if ($memorySpecs->isNotEmpty())
                        <p class="m-0 pl-2 text-left">{{ $memorySpecs->pluck('value')->implode(', ') }}</p>
                        @else
                        <p class="m-0 pl-2 text-left">-</p>
                        @endif

                        <p style="color: #003684;" class="m-0 pl-2 text-left">{{ number_format($device->price) }} MMK</p>
                    </div>
                    <div style="width: 35%;" class="phoneDetailLeft">
                        <a href="{{ route('devices.show', $device->id) }}" class="ml-2" style="white-space: nowrap;"><i class="fa fa-eye" style="color: black;"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <p class="ml-2">No matching devices found.</p>
            @endforelse
        </div>
    </div>

    {{-- Brands Section --}}
    <div class="mt-5">
        <h6 class="ml-2 mb-2" style="color: #003684;">Brands Found</h6>
        @if($brands->count())
        <div class="row ml-1">
            @foreach($brands as $brand)
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="{{ route('branded.filter', $brand->id) }}" class="text-decoration-none">
                    <div class="card text-center p-3 shadow-sm">
                        @if ($brand->logo_url)
                        <img src="/images/{{ $brand->logo_url }}" alt="{{ $brand->name }}" style="height: 60px; object-fit: contain; margin-bottom: 8px;">
                        @endif
                        <h6 class="text-dark">{{ $brand->name }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="ml-2">No matching brands found.</p>
        @endif
    </div>
</div>
@endsection
