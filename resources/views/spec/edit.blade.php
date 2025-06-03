@extends('layouts.app')

@section('title', 'Spec')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Spec',
'bc_data' => [
[
'link' => route('spec.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('spec.index'),
'text' => 'Spec List',
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
        <div class="card-body p-3">
            <form action="{{ route('spec.update', $device->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Select Device</label>
                    <div class="col-sm-8">
                        <select name="device_id" class="form-control form-control-sm @error('device_id') is-invalid @enderror" id="device_id" readonly>
                            <option value="{{ $device->id }}" selected>{{ $device->name }}</option>
                        </select>
                    </div>
                </div>

                @foreach ($spec_categories as $spec_category)
                @php
                $specs = $device->specs->where('spec_category_id', $spec_category->id)->values(); // Ensure index reset
                @endphp

                <div class="spec-category-section mb-4 p-3 col-12 rounded" data-category-id="{{ $spec_category->id }}">
                    <h5 style="color:#0091ea">{{ $spec_category->name }}</h5>
                    <div class="spec-entries" id="category-{{ $spec_category->id }}-entries">
                        @foreach ($specs as $i => $spec)
                        <div class="form-row">
                            <input type="hidden" name="specs[{{ $spec_category->id }}][{{ $i }}][id]" value="{{ $spec->id }}">
                            <div class="form-group col-md-6">
                                <input type="text" name="specs[{{ $spec_category->id }}][{{ $i }}][key]" value="{{ $spec->key }}" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="specs[{{ $spec_category->id }}][{{ $i }}][value]" value="{{ $spec->value }}" class="form-control form-control-sm">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 text-right">
                            <button type="button" class="btn btn-sm btn-secondary add-spec" data-category-id="{{ $spec_category->id }}">+ Add More</button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Submit -->
                <div class="col-12 mt-3 text-right">
                    <a href="{{ route('spec.index') }}" class="btn btn-sm btn-secondary">Back</a>
                    <button type="submit" class="ml-2 btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const specCounters = {};
    document.querySelectorAll('.add-spec').forEach(button => {
        const categoryId = button.dataset.categoryId;

        button.addEventListener('click', function() {
            const container = document.getElementById(`category-${categoryId}-entries`);
            const index = specCounters[categoryId];

            const row = document.createElement('div');
            row.classList.add('form-row');
            row.innerHTML = `
                <div class="form-group col-md-6">
                    <input type="text" name="specs[${categoryId}][${index}][key]" class="form-control form-control-sm" placeholder="e.g. Battery">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="specs[${categoryId}][${index}][value]" class="form-control form-control-sm" placeholder="e.g. 5000 mAh">
                </div>
            `;
            container.appendChild(row);
            specCounters[categoryId]++;
        });
    });
</script>

@endsection