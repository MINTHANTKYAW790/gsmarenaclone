@extends('layouts.application')

@section('content')
<div class="phoneFinderContainer">
    {{-- Left Sidebar: Brands --}}
    <div class="phoneFinder">
        <h5 class="phoneFinderText">Phone Finder</h5>
        <ul style="list-style: none; padding: 0; text-align: center; margin: 0;text-decoration: none;text-underline: none;">
            @foreach ($brands as $brand)
            <li style="margin-bottom: 10px;" class="mt-4">
                <a href="{{ route('branded.filter', $brand->id) }}"
                    style="{{ isset($selectedBrand) && $selectedBrand->id == $brand->id ? 'padding: 0 10px;color: blue;background-color: #F5F5F5; border-radius:10px 10px 10px 10px;' : 'color: black;' }} text-decoration: none;">
                    {{ strtoupper($brand->name) }}
                </a>
            </li>
            @endforeach
        </ul>
        <a href="{{ url('/filter') }}" style="display: block; margin-top: 10px; font-weight: bold;text-align:center; background-color:#F5F5F5;color:#333333;margin: 0 auto;width:80%; text-decoration: none;border-radius:10px 10px 10px 10px;">All Brands</a>
    </div>

    {{-- Right Content: Devices --}}
    <div class="phoneFinderProducts">
        <h6 class="ml-2 mt-2 mb-2" style="color: #003684;">
            {{ isset($selectedBrand) ? "The products of " . strtoupper($selectedBrand->name) . " : " : "All Devices" }}
        </h6>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;" class="ml-2">
            {{-- Display the selected brand name --}}
            {{-- Display devices for the selected brand --}}
            @forelse ($devices as $device)
            <div style="border: 1px solid #ccc; text-align: center;" class="card">
                <p class="m-0">{{ $device->name }}</p>
                <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}" style="width: 170px;height: 200px;margin: 0 auto;">
                @php
                $memorySpecs = $device->specs->filter(function ($spec) {
                return $spec->category->name === 'Memory';
                });
                @endphp

                @if ($memorySpecs->isNotEmpty())
                <p class="m-0 pl-2 text-left">{{ $memorySpecs->pluck('value')->implode(', ') }}</p>
                @else
                <p> - </p>
                @endif

                <p style="color: #003684;" class="m-0 pl-2 text-left">{{ number_format($device->price) }} MMK</p>
            </div>
            @empty
            <p>No devices found for this brand.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection