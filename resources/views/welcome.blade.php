@extends('layouts.application')

@section('content')
<div style="display: flex;">
    {{-- Left Sidebar: Brands --}}
    <div style="width: 20%; padding: 20px;">
        <h3>Phone Finder</h3>
        <ul style="list-style: none; padding: 0;">
            @foreach ($brands as $brand)
                <li style="margin-bottom: 10px;">
                    <a href="{{ route('branded.filter', $brand->id) }}"
                       style="{{ isset($selectedBrand) && $selectedBrand->id == $brand->id ? 'font-weight: bold; color: blue;' : '' }}">
                        {{ strtoupper($brand->name) }}
                    </a>
                </li>
            @endforeach
        </ul>
        <a href="{{ url('/') }}" style="display: block; margin-top: 10px; font-weight: bold;">All Brands</a>
    </div>

    {{-- Right Content: Devices --}}
    <div style="width: 80%; padding: 20px;">
        <h2>
            {{ isset($selectedBrand) ? "The products of " . strtoupper($selectedBrand->name) : "All Devices" }}
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @forelse ($devices as $device)
                <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                    <img src="{{ $device->image_url }}" alt="{{ $device->name }}" style="max-width: 100%; height: auto;">
                    <h4>{{ $device->name }}</h4>
                    <p>{{ $device->os ?? 'Unknown OS' }}</p>
                    <p><strong>{{ number_format($device->price) }} MMK</strong></p>
                </div>
            @empty
                <p>No devices found for this brand.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
