@extends('layouts.application')

@section('content')

<!-- Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
        font-family: 'Inter', Arial, sans-serif;
    }
    .review-form-card {
        max-width: 440px;
        margin: 40px auto;
        background: #fff;
        box-shadow: 0 8px 32px rgba(37,99,235,0.10), 0 1.5px 6px rgba(0,0,0,0.04);
        border-radius: 18px;
        border: none;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .review-form-card:hover {
        box-shadow: 0 12px 40px rgba(37,99,235,0.16), 0 2px 8px rgba(0,0,0,0.06);
    }
    .card-header {
        background: linear-gradient(90deg, #6366f1 0%, #2563eb 100%);
        color: #fff;
        padding: 22px 28px 18px 28px;
        border-bottom: none;
        text-align: center;
    }
    .card-header h4 {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0;
        letter-spacing: 0.5px;
    }
    .card-body {
        padding: 1.7rem 1.7rem 1.2rem 1.7rem;
    }
    .review-form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.35rem;
        font-size: 1.01rem;
        letter-spacing: 0.01em;
    }
    .form-control, select, textarea {
        border-radius: 9px;
        border: 1.5px solid #c7d2fe;
        font-size: 1.01rem;
        padding: 0.55rem 0.85rem;
        background: #f1f5fd;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 1px 2px #6366f11a;
    }
    .form-control:focus, select:focus, textarea:focus {
        border-color: #6366f1;
        background: #fff;
        box-shadow: 0 0 0 2px #6366f133;
    }
    .img-container {
        cursor: pointer;
        border: 2px dashed #a5b4fc;
        background: linear-gradient(120deg, #f1f5f9 60%, #e0e7ff 100%);
        border-radius: 10px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        margin-bottom: 0.3rem;
        transition: border-color 0.2s;
    }
    .img-container:hover {
        border-color: #6366f1;
        background: #e0e7ff;
    }
    .img-container img {
        object-fit: cover;
        max-height: 90px;
        max-width: 100%;
        border-radius: 8px;
        transition: transform 0.2s;
        filter: drop-shadow(0 2px 8px #6366f122);
    }
    .btn-cancel {
        background: #f3f4f6;
        color: #334155;
        border: 1.5px solid #cbd5e1;
        border-radius: 7px;
        font-weight: 500;
        padding: 0.45rem 1.1rem;
        font-size: 0.97rem;
        margin-right: 0.5rem;
        transition: background 0.15s, color 0.15s, border 0.15s;
    }
    .btn-cancel:hover {
        background: #e0e7ef;
        border-color: #6366f1;
        color: #2563eb;
    }
    .btn-primary {
        background: linear-gradient(90deg, #6366f1 0%, #2563eb 100%);
        border: none;
        border-radius: 7px;
        font-weight: 700;
        padding: 0.45rem 1.4rem;
        font-size: 1.01rem;
        color: #fff;
        box-shadow: 0 2px 8px #6366f122;
        transition: background 0.15s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #2563eb 0%, #6366f1 100%);
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .text-danger {
        font-weight: 500;
        font-size: 0.96rem;
    }
    small.text-muted {
        font-size: 0.87rem;
        color: #64748b;
    }
    .required-star {
        color: #f43f5e;
        font-size: 1.1em;
        margin-left: 2px;
    }
    @media (max-width: 500px) {
        .review-form-card, .card-body {
            padding: 0.7rem !important;
        }
        .review-form-card {
            max-width: 98vw;
        }
    }
</style>

<div class="card review-form-card">
    <div class="card-header">
        <h4>
            <svg width="24" height="24" fill="none" style="vertical-align:middle;margin-right:7px;margin-top:-3px;" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" fill="#fff"/></svg>
            Create Device Review
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('storeReview') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="device_id" class="review-form-label">Device <span class="required-star">*</span></label>
                <select name="device_id" class="form-control @error('device_id') is-invalid @enderror" id="device_id" required>
                    <option value="">-- Select --</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
                @error('device_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="heading" class="review-form-label">Heading <span class="required-star">*</span></label>
                <input type="text" id="heading" class="form-control @error('heading') is-invalid @enderror"
                    name="heading" placeholder="Review heading" required>
                @error('heading')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_1" class="review-form-label">Image 1 <span class="required-star">*</span></label>
                <input type="file" id="image_1" name="image_1" hidden accept="image/*" required>
                <div class="img-container" onclick="document.getElementById('image_1').click()">
                    <img src="{{ asset('images/default.png') }}" alt="Default Image" id="preview_image_1">
                </div>
                <small class="text-muted">Click to select image.</small>
                @error('image_1') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="paragraph_1" class="review-form-label">Paragraph 1 <span class="required-star">*</span></label>
                <textarea id="paragraph_1" class="form-control @error('paragraph_1') is-invalid @enderror"
                    name="paragraph_1" rows="2" placeholder="First paragraph..." required></textarea>
                @error('paragraph_1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_2" class="review-form-label">Image 2 <span class="required-star">*</span></label>
                <input type="file" id="image_2" name="image_2" hidden accept="image/*" required>
                <div class="img-container" onclick="document.getElementById('image_2').click()">
                    <img src="{{ asset('images/default.png') }}" alt="Default Image" id="preview_image_2">
                </div>
                <small class="text-muted">Click to select image.</small>
                @error('image_2') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="paragraph_2" class="review-form-label">Paragraph 2 <span class="required-star">*</span></label>
                <textarea id="paragraph_2" class="form-control @error('paragraph_2') is-invalid @enderror"
                    name="paragraph_2" rows="2" placeholder="Second paragraph..." required></textarea>
                @error('paragraph_2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="rating" class="review-form-label">Rating <span class="required-star">*</span></label>
                <select id="rating" name="rating" class="form-control @error('rating') is-invalid @enderror" required>
                    <option value="">-- Rating --</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
                @error('rating')
                    <span class="text-danger ml-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-cancel back">Back</button>
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" fill="none" style="vertical-align:middle;margin-right:4px;margin-top:-2px;" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Create
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
