@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-edit me-2 text-warning"></i>
            تعديل الفيديو
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
            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">العنوان (AR) <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" dir="rtl"
                               class="form-control @error('title_ar') is-invalid @enderror"
                               value="{{ old('title_ar', $video->title_ar) }}" required>
                        @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Title (EN) <span class="text-danger">*</span></label>
                        <input type="text" name="title_en"
                               class="form-control @error('title_en') is-invalid @enderror"
                               value="{{ old('title_en', $video->title_en) }}" required>
                        @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                   <div class="col-md-8">
    <label class="form-label fw-semibold">الفيديو</label>

    <input type="file" name="video_url" id="videoInput"
           accept="video/*"
           class="form-control @error('video_url') is-invalid @enderror">

    <div class="form-text">اتركه فارغاً للإبقاء على الفيديو الحالي</div>

    <div class="mt-3 d-flex gap-3 align-items-start">

        @if($video->video_url)
        <div>
            <small class="text-muted d-block mb-1">الحالي</small>
            <video width="220" controls
                   style="border-radius:6px;border:1px solid #dee2e6">
                <source src="{{ asset('assets/admin/uploads/'.$video->video_url) }}">
            </video>
        </div>
        @endif

        <div id="videoPreviewWrap" style="display:none">
            <small class="text-muted d-block mb-1">الجديد</small>
            <video id="videoPreview"
                   width="220"
                   controls
                   style="border-radius:6px;border:1px solid #dee2e6">
            </video>
        </div>

    </div>

    @error('video_url')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">المدة</label>
                        <input type="text" name="duration" class="form-control"
                               value="{{ old('duration', $video->duration) }}" placeholder="٨:٢٤">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">الترتيب</label>
                        <input type="number" name="sort_order" min="0" class="form-control"
                               value="{{ old('sort_order', $video->sort_order) }}">
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-semibold">صورة الغلاف</label>
                        <input type="file" name="thumbnail" accept="image/*"
                               class="form-control @error('thumbnail') is-invalid @enderror"
                               id="thumbInput">
                        @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">اتركه فارغاً للإبقاء على الصورة الحالية</div>

                        <div class="mt-2 d-flex gap-3 align-items-start">
                            @if($video->thumbnail)
                            <div>
                                <small class="text-muted d-block mb-1">الحالية</small>
                                <img src="{{ asset('assets/admin/uploads/'.$video->thumbnail) }}"
                                     height="90" style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                            </div>
                            @endif
                            <div id="previewWrap" style="display:none">
                                <small class="text-muted d-block mb-1">الجديدة</small>
                                <img id="thumbPreview" src="#" height="90"
                                     style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check form-switch mt-4 pt-2">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1" {{ $video->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                نشط (ظاهر في الموقع)
                            </label>
                        </div>
                    </div>

                </div>

                <hr class="my-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> تحديث
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
        document.getElementById('thumbPreview').src = ev.target.result;
        document.getElementById('previewWrap').style.display = 'block';
    };
    reader.readAsDataURL(file);
});
document.getElementById('videoInput').addEventListener('change', function(e) {

    const file = e.target.files[0];
    if (!file) return;

    const video = document.getElementById('videoPreview');

    video.src = URL.createObjectURL(file);
    document.getElementById('videoPreviewWrap').style.display = 'block';

});
</script>
@endpush
@endsection
