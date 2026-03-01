@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-plus-circle me-2 text-primary"></i>
            {{ __('messages.add_product') }}
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
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.product') }} (EN) <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                               value="{{ old('name_en') }}" placeholder="Product name in English" required>
                        @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.product') }} (AR) <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                               value="{{ old('name_ar') }}" placeholder="اسم المنتج بالعربي" dir="rtl" required>
                        @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description (EN) <span class="text-danger">*</span></label>
                        <textarea name="description_en" rows="4"
                                  class="form-control @error('description_en') is-invalid @enderror"
                                  placeholder="Product description in English" required>{{ old('description_en') }}</textarea>
                        @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description (AR) <span class="text-danger">*</span></label>
                        <textarea name="description_ar" rows="4" dir="rtl"
                                  class="form-control @error('description_ar') is-invalid @enderror"
                                  placeholder="وصف المنتج بالعربي" required>{{ old('description_ar') }}</textarea>
                        @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- {{ __('messages.select') }} --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected':'' }}>
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
                            <option value="2" {{ old('is_featured',2)==2 ? 'selected':'' }}>{{ __('messages.no') }}</option>
                            <option value="1" {{ old('is_featured')==1 ? 'selected':'' }}>{{ __('messages.yes') }} ⭐</option>
                        </select>
                        <div class="form-text">المنتجات المميزة تظهر في سلايدر "الأكثر طلباً"</div>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">{{ __('messages.price') }}</label>
                        <input type="number" name="price" step="0.01" min="0"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price') }}" placeholder="0.00">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">وحدة السعر (AR)</label>
                        <input type="text" name="price_unit_ar" class="form-control"
                               value="{{ old('price_unit_ar','درهم') }}" dir="rtl">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price Unit (EN)</label>
                        <input type="text" name="price_unit_en" class="form-control"
                               value="{{ old('price_unit_en','MAD') }}">
                    </div>

                 
                    {{-- Photo --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">{{ __('messages.photo') }} <span class="text-danger">*</span></label>
                        <input type="file" name="photo" accept="image/*"
                               class="form-control @error('photo') is-invalid @enderror"
                               id="photoInput" required>
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="mt-2">
                            <img id="photoPreview" src="#" alt="Preview"
                                 style="display:none;height:100px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6">
                        </div>
                    </div>

                </div>

                <hr class="my-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> {{ __('messages.save') }}
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
        const img = document.getElementById('photoPreview');
        img.src = ev.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
