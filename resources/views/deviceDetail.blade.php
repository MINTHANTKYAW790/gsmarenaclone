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
            <div class="deviceDetailContainer my-2">
                {{-- Device Detail --}}
                <div class="deviceDetailCard" style="max-width: 700px; margin: 0 auto; border: 1px solid #ccc; border-radius: 10px; padding: 24px; background: #fff;">
                    <div style="display: flex; align-items: flex-start; gap: 32px;">
                        {{-- Upper Left: Image --}}
                        <div style="flex: 0 0 200px;">
                            <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}" style="width: 200px; height: 240px; object-fit: contain; border-radius: 8px;">
                        </div>
                        {{-- Upper Right: Brand, Device, Price --}}
                        <div style="flex: 1;" class="mt-5">
                            {{-- Brand Name and Logo --}}
                            <div style="display: flex; align-items: center; margin-bottom: 8px;">
                                {{-- Brand Logo --}}
                                @if ($device->brand->logo_url)
                                <img src="/images/{{ $device->brand->logo_url }}" alt="{{ $device->brand->logo_url }}" style="width: 32px; height: 32px; object-fit: contain; border-radius: 8px; margin-right: 12px;">
                                @endif
                                <h3 style="color: #003684; margin: 0;">{{ $device->brand->name }}</h3>
                            </div>
                            @if (!empty($device->brand->website_url))
                            <p style="margin-bottom: 8px;">
                                <a href="{{ $device->brand->website_url }}" target="_blank" style="color: #003684; text-decoration: underline;">
                                    {{ $device->brand->website_url }}
                                </a>
                            </p>
                            @endif

                            <h3 style="color: #003684; margin-bottom: 8px;">{{ $device->name }}</h3>
                            <p style="margin-bottom: 4px;"><strong>Price:</strong> {{ number_format($device->price) }} MMK</p>
                        </div>
                        @if(!in_array($device->id, $savedDeviceIds))
                        <form method="POST" action="{{ route('savedDevices.store', $device->id) }}" style="margin-left: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary" style="border: transparent; hover:transparent"><i class="fa fa-bookmark" style="color: black;"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                    {{-- Lower: Specifications and Table --}}
                    <div style="margin-top: 24px;">
                        <div class="container-fluid px-0">
                            {{-- Specs Grouped by Category --}}
                            @php
                            $groupedSpecs = $device->specs->groupBy(fn($s) => $s->category->name);
                            @endphp

                            @foreach ($groupedSpecs as $categoryName => $specs)
                            <div class="mt-4 p-3 border rounded bg-light">
                                <h5 class="mb-3 text-primary">{{ $categoryName }}</h5>

                                <table class="table table-bordered table-sm mb-0">
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
                    {{-- Lower: Review/Feedback Button --}}
                    <div style="margin-top: 24px;">
                        @if ($device->reviews->isNotEmpty())
                        <a href="{{ route('devices.reviews', $device->id) }}" class=" ml-2 btn btn-primary btn-sm px-1 py-0 " style=" white-space: nowrap;">Read Review</a>
                        @else
                        <a href="{{ route('createReview') }}" class=" ml-2 btn btn-primary btn-sm px-1 py-0 " style=" white-space: nowrap;">Write Feedback</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection