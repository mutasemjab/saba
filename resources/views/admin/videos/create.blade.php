@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-plus-circle me-2 text-primary"></i>
            إضافة فيديو جديد
        </h4>
        <a href="{{ route('videos.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i> العودة
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">العنوان (AR) <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" dir="rtl"
                               class="form-control @error('title_ar') is-invalid @enderror"
                               value="{{ old('title_ar') }}" placeholder="عنوان الفيديو بالعربي" required>
                        @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Title (EN) <span class="text-danger">*</span></label>
                        <input type="text" name="title_en"
                               class="form-control @error('title_en') is-invalid @enderror"
                               value="{{ old('title_en') }}" placeholder="Video title in English" required>
                        @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-semibold">رابط اليوتيوب / الفيديو</label>
                        <input type="url" name="video_url"
                               class="form-control @error('video_url') is-invalid @enderror"
                               value="{{ old('video_url') }}"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">اختياري — رابط يوتيوب أو أي رابط فيديو</div>
                        @error('video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">المدة</label>
                        <input type="text" name="duration" class="form-control"
                               value="{{ old('duration') }}" placeholder="٨:٢٤">
                        <div class="form-text">مثال: ٨:٢٤ أو 8:24</div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">الترتيب</label>
                        <input type="number" name="sort_order" min="0" class="form-control"
                               value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-semibold">صورة الغلاف (Thumbnail) <span class="text-danger">*</span></label>
                        <input type="file" name="thumbnail" accept="image/*"
                               class="form-control @error('thumbnail') is-invalid @enderror"
                               id="thumbInput" required>
                        @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="mt-2">
                            <img id="thumbPreview" src="#" alt="Preview"
                                 style="display:none;height:120px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check form-switch mt-4 pt-2">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1" checked>
                            <label class="form-check-label fw-semibold" for="is_active">
                                نشط (ظاهر في الموقع)
                            </label>
                        </div>
                    </div>

                </div>

                <hr class="my-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> حفظ الفيديو
                    </button>
                    <a href="{{ route('videos.index') }}" class="btn btn-outline-secondary px-4">إلغاء</a>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.getElementById('thumbInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        const img = document.getElementById('thumbPreview');
        img.src = ev.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
