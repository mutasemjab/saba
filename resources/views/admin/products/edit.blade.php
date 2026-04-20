@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-edit me-2 text-warning"></i>
            {{ __('messages.edit_product') }}
        </h4>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i> {{ __('messages.back') }}
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.product') }} (EN) <span class="text-danger">*</span></label>
                        <input type="text" name="name_en"
                               class="form-control @error('name_en') is-invalid @enderror"
                               value="{{ old('name_en', $product->name_en) }}" required>
                        @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.product') }} (AR) <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" dir="rtl"
                               class="form-control @error('name_ar') is-invalid @enderror"
                               value="{{ old('name_ar', $product->name_ar) }}" required>
                        @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- FR Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.product') }} (FR)</label>
                        <input type="text" name="name_fr"
                               class="form-control @error('name_fr') is-invalid @enderror"
                               value="{{ old('name_fr', $product->name_fr) }}" placeholder="Optionnel">
                        <div class="form-text">Optionnel — si vide, l'anglais sera utilisé</div>
                        @error('name_fr')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description (EN) <span class="text-danger">*</span></label>
                        <textarea name="description_en" rows="4"
                                  class="form-control @error('description_en') is-invalid @enderror"
                                  required>{{ old('description_en', $product->description_en) }}</textarea>
                        @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description (AR) <span class="text-danger">*</span></label>
                        <textarea name="description_ar" rows="4" dir="rtl"
                                  class="form-control @error('description_ar') is-invalid @enderror"
                                  required>{{ old('description_ar', $product->description_ar) }}</textarea>
                        @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description (FR)</label>
                        <textarea name="description_fr" rows="4"
                                  class="form-control @error('description_fr') is-invalid @enderror"
                                  placeholder="Optionnel">{{ old('description_fr', $product->description_fr) }}</textarea>
                        @error('description_fr')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- {{ __('messages.select') }} --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected':'' }}>
                                {{ app()->getLocale()=='ar' ? $cat->name_ar : $cat->name_en }}
                                ({{ app()->getLocale()=='ar' ? $cat->name_en : $cat->name_ar }})
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Featured --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.featured') }}</label>
                        <select name="is_featured" class="form-select">
                            <option value="2" {{ old('is_featured',$product->is_featured)==2 ? 'selected':'' }}>{{ __('messages.no') }}</option>
                            <option value="1" {{ old('is_featured',$product->is_featured)==1 ? 'selected':'' }}>{{ __('messages.yes') }} ⭐</option>
                        </select>
                        <div class="form-text">المنتجات المميزة تظهر في سلايدر "الأكثر طلباً"</div>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">{{ __('messages.price') }}</label>
                        <input type="number" name="price" step="0.01" min="0"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $product->price) }}">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">وحدة السعر (AR)</label>
                        <input type="text" name="price_unit_ar" class="form-control" dir="rtl"
                               value="{{ old('price_unit_ar', $product->price_unit_ar ?? 'درهم') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price Unit (EN)</label>
                        <input type="text" name="price_unit_en" class="form-control"
                               value="{{ old('price_unit_en', $product->price_unit_en ?? 'MAD') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Unité prix (FR)</label>
                        <input type="text" name="price_unit_fr" class="form-control"
                               value="{{ old('price_unit_fr', $product->price_unit_fr ?? 'MAD') }}">
                    </div>

                    {{-- Photo --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">{{ __('messages.photo') }}</label>
                        <input type="file" name="photo" accept="image/*"
                               class="form-control @error('photo') is-invalid @enderror"
                               id="photoInput">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">اتركه فارغاً للإبقاء على الصورة الحالية</div>

                        {{-- Current photo + preview --}}
                        <div class="mt-2 d-flex gap-3 align-items-start">
                            @if($product->photo)
                            <div>
                                <small class="text-muted d-block mb-1">الصورة الحالية</small>
                                <img id="currentPhoto"
                                     src="{{ asset('assets/admin/uploads/'.$product->photo) }}"
                                     height="90" style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                            </div>
                            @endif
                            <div id="previewWrap" style="display:none">
                                <small class="text-muted d-block mb-1">معاينة الجديدة</small>
                                <img id="photoPreview" src="#" height="90"
                                     style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                            {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Active (visible on site)</label>
                    </div>
                </div>

                <hr class="my-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> {{ __('messages.update') }}
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                        {{ __('messages.cancel') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('photoPreview').src = ev.target.result;
        document.getElementById('previewWrap').style.display = 'block';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
