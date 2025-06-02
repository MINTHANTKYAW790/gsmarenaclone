@extends('layouts.application')

@section('content')
<div class="container py-4">
    {{-- Right Content: Devices --}}
        <div class="">
            <h6 class="ml-2 mt-2 mb-2" style="color: #003684;">
                {{ isset($selectedBrand) ? "The products of " . strtoupper($selectedBrand->name) . " : " : "All Saved Devices" }}
            </h6>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;" class="ml-2">
                {{-- Display the selected brand name --}}
                {{-- Display devices for the selected brand --}}
                @forelse ($savedDevices as $savedDevice)
                <div style="border: 1px solid #ccc; text-align: center;" class="card">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <p class="m-0 mb-0" style="flex: 1;">{{ $savedDevice->device->name }}</p>
                        <form method="POST" action="{{ route('savedDevices.destroy', $savedDevice->id) }}" style="margin-left: 10px;" onsubmit="return confirm('Are you sure you want to remove this device from your saved list?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary" style="border: transparent;">
                                <i class="fa fa-trash" style="color: black;"></i>
                            </button>
                        </form>
                    </div>
                    <img src="/images/{{ $savedDevice->device->image_url }}" alt="{{ $savedDevice->device->name }}" style="width: 170px;height: 200px;margin: 0 auto;">
                    <div style="display: flex; align-items: center; justify-content: space-between;" class="mb-2">
                        <div class="phoneDetailLeft" style="width: 65%;">
                            @php
                            $memorySpecs = $savedDevice->device->specs->filter(function ($spec) {
                            return $spec->category->name === 'Memory';
                            });
                            @endphp

                            @if ($memorySpecs->isNotEmpty())
                            <p class="m-0 pl-2 text-left">{{ $memorySpecs->pluck('value')->implode(', ') }}</p>
                            @else
                            <p> - </p>
                            @endif

                            <p style="color: #003684;" class="m-0 pl-2 text-left">{{ number_format($savedDevice->device->price) }} MMK</p>
                        </div>
                        <div style="width: 35%;" class="phoneDetailLeft">
                            <a href="{{ route('devices.show', $savedDevice->device->id) }}" class="ml-2" style="white-space: nowrap;"><i class="fa fa-eye" style="color: black;"></i></a>
                            @if ($savedDevice->device->reviews->isNotEmpty())
                            <a href="{{ route('devices.reviews', $savedDevice->device->id) }}" class=" ml-2 btn btn-primary btn-sm px-1 py-0 " style=" white-space: nowrap;">Review</a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p>No Saved Devices.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $savedDevices->links() }}
    </div>
</div>
@endsection