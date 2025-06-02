@extends('layouts.application')

@section('content')
<div>
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
                    @if($brand->logo_url)
                    <img src="/images/{{ $brand->logo_url }}" alt="{{ $brand->name }}" style="width: 24px; height: 24px; object-fit: contain; border-radius: 8px; margin-right: 12px;">
                    @endif
                </li>
                @endforeach
            </ul>
            <a href="{{ url('/filter') }}" class="mb-4" style="display: block; margin-top: 10px; font-weight: bold;text-align:center; background-color:#F5F5F5;color:#333333;margin: 0 auto;width:80%; text-decoration: none;border-radius:10px 10px 10px 10px;">All Brands</a>
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
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <p class="m-0 mb-0" style="flex: 1;">{{ $device->name }}</p>
                        @if(!in_array($device->id, $savedDeviceIds))
                        <form method="POST" action="{{ route('savedDevices.store', $device->id) }}" style="margin-left: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary" style="border: transparent; hover:transparent"><i class="fa fa-bookmark" style="color: black;"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                    <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}" style="width: 170px;height: 200px;margin: 0 auto;">
                    <div style="display: flex; align-items: center; justify-content: space-between;" class="mb-2">
                        <div class="phoneDetailLeft" style="width: 65%;">
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
                        <div style="width: 35%;" class="phoneDetailLeft">
                            <a href="{{ route('devices.show', $device->id) }}" class="ml-2" style="white-space: nowrap;"><i class="fa fa-eye" style="color: black;"></i></a>
                            @if ($device->reviews->isNotEmpty())
                            <a href="{{ route('devices.reviews', $device->id) }}" class=" ml-2 btn btn-primary btn-sm px-1 py-0 " style=" white-space: nowrap;">Review</a>
                            @else
                            <a href="{{ route('createReview') }}" class=" ml-2 btn btn-primary btn-sm px-1 py-0 " style=" white-space: nowrap;">Write</a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p>No devices found for this brand.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $devices->links() }}
    </div>
</div>


@endsection