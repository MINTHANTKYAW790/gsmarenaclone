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
                    <div style="display: flex; align-items: flex-start;">
                        <img src="/images/{{ $device->image_url }}" alt="{{ $device->name }}" style="width: 200px; height: 240px; object-fit: contain; border-radius: 8px; margin-right: 32px;">
                        <div>
                            <div style="display: flex; align-items: center; margin-bottom: 8px;">
                                @if ($device->brand->logo_url)
                                <img src="/images/{{ $device->brand->logo_url }}" alt="{{ $device->brand->logo_url }}" style="width: 24px; height: 24px; object-fit: contain; border-radius: 8px; margin-right: 12px;">
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
                            <hr>
                            <h5 style="margin-top: 16px;">Specifications</h5>
                            <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Key</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $groupedSpecs = $device->specs->groupBy('category.name');
                                    @endphp

                                    @foreach ($groupedSpecs as $categoryName => $specs)
                                    @foreach ($specs as $index => $spec)
                                    <tr>
                                        <td>
                                            @if ($index === 0)
                                            <strong>{{ $categoryName }}</strong>
                                            @endif
                                        </td>
                                        <td>{{ $spec->key }}</td>
                                        <td>{{ $spec->value }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    @if ($device->reviews->isNotEmpty())

                    <div style="margin-top: 24px;">
                        <a href="{{ route('devices.reviews', $device->id) }}" class="btn btn-primary">View Reviews</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection