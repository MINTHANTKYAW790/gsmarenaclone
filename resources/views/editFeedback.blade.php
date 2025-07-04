@extends('layouts.application')

@section('content')

<style>
    .review-form-card {
        max-width: 700px;
        margin: 40px auto;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        border-radius: 16px;
        border: none;
    }
    .review-form-label {
        font-weight: 600;
        color: #333;
    }
    .img-container {
        cursor: pointer;
        transition: box-shadow 0.2s;
        border: 2px dashed #e0e0e0;
    }
    .img-container:hover {
        box-shadow: 0 0 0 2px #007bff;
        border-color: #007bff;
    }
    .img-container img {
        object-fit: cover;
        max-height: 220px;
    }
    .btn-cancel {
        background: #f5f5f5;
        color: #333;
        border: 1px solid #ddd;
    }
    .btn-cancel:hover {
        background: #e0e0e0;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
<div class="card review-form-card">
    <div class="card-header bg-primary text-white rounded-top">
        <h4 class="mb-0">Edit Device Review</h4>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="device_id" class="review-form-label">Select Device</label>
                <select name="device_id" class="form-control @error('device_id') is-invalid @enderror" id="device_id" required readonly>
                    <option value="">-- Select Device --</option>
                        <option value="{{ $device->id }}" {{ $feedback->device_id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                </select>
                @error('device_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="heading" class="review-form-label">Heading <span class="text-danger">*</span></label>
                <input type="text" id="heading" class="form-control @error('heading') is-invalid @enderror"
                    name="heading" placeholder="Enter review heading" value="{{ old('heading', $feedback->heading) }}" required>
                @error('heading')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_1" class="review-form-label">Image 1 <span class="text-danger">*</span></label>
                <input type="file" id="image_1" name="image_1" hidden accept="image/*">
                <div class="img-container d-flex align-items-center justify-content-center rounded mb-2" style="height: 220px;" onclick="document.getElementById('image_1').click()">
                    <img src="{{ $feedback->image_1 ? asset('storage/' . $feedback->image_1) : asset('images/default.png') }}" alt="Image" class="img-fluid default" id="preview_image_1">
                </div>
                <small class="text-muted">Click the box to select an image. Leave blank to keep current image.</small>
                @error('image_1') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="paragraph_1" class="review-form-label">Paragraph 1 <span class="text-danger">*</span></label>
                <textarea id="paragraph_1" class="form-control @error('paragraph_1') is-invalid @enderror"
                    name="paragraph_1" rows="4" placeholder="Write your first paragraph..." required>{{ old('paragraph_1', $feedback->paragraph_1) }}</textarea>
                @error('paragraph_1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="rating" class="review-form-label">Rating <span class="text-danger">*</span></label>
                <select id="rating" name="rating" class="form-control @error('rating') is-invalid @enderror" required>
                    <option value="">-- Select Rating --</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $feedback->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('rating')
                    <span class="text-danger ml-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-cancel mr-2 back">Back</button>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview for image_1
    document.getElementById('image_1').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview_image_1').src = ev.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    // Image preview for image_2
    document.getElementById('image_2').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview_image_2').src = ev.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    // Optional: Back button
    document.querySelectorAll('.back').forEach(btn => {
        btn.addEventListener('click', () => window.history.back());
    });
</script>

@endsection