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
            <form action="{{ route('spec.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group row col-md-7">
                    <label for="device_id" class="col-sm-4 col-form-label">Select Device</label>
                    <div class="col-sm-8">
                        <select name="device_id" class="form-control form-control-sm @error('device_id') is-invalid @enderror" id="device_id" required>
                            <option value="">-- Select Device --</option>
                            @foreach ($devices as $device)
                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                        @error('device_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                @foreach ($spec_categories as $spec_category)
                <div class="spec-category-section mb-4  p-3 col-12 rounded" data-category-id="{{ $spec_category->id }}">
                    <h5 style="color:#0091ea">{{ $spec_category->name }}</h5>

                    <div class="spec-entries" id="category-{{ $spec_category->id }}-entries">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Spec Name</label>
                                <input type="text" name="specs[{{ $spec_category->id }}][0][key]" class="form-control form-control-sm" placeholder="e.g. Resolution">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Value</label>
                                <input type="text" name="specs[{{ $spec_category->id }}][0][value]" class="form-control form-control-sm" placeholder="e.g. 1440x3088">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 text-right">
                            <button type="button" class="btn btn-sm btn-secondary add-spec" data-category-id="{{ $spec_category->id }}">+ Add More</button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 mt-3 text-right">
                    <button type="button" class="btn btn-sm btn-cancel back">Back</button>
                    <button type="submit" class="ml-2 btn btn-sm btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const specCounters = {};

    document.querySelectorAll('.add-spec').forEach(button => {
        const categoryId = button.dataset.categoryId;
        specCounters[categoryId] = 1;

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