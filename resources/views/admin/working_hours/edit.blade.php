@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-edit me-2 text-warning"></i>
            تعديل وقت الدوام
        </h4>
        <a href="{{ route('working-hours.index') }}" class="btn btn-outline-secondary btn-sm">
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
            <form action="{{ route('working-hours.update', $workingHour->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3">

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">اسم اليوم (AR) <span class="text-danger">*</span></label>
                        <input type="text" name="day_ar" dir="rtl"
                               class="form-control @error('day_ar') is-invalid @enderror"
                               value="{{ old('day_ar', $workingHour->day_ar) }}" required>
                        @error('day_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Day Name (EN) <span class="text-danger">*</span></label>
                        <input type="text" name="day_en"
                               class="form-control @error('day_en') is-invalid @enderror"
                               value="{{ old('day_en', $workingHour->day_en) }}" required>
                        @error('day_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Nom du jour (FR)</label>
                        <input type="text" name="day_fr"
                               class="form-control @error('day_fr') is-invalid @enderror"
                               value="{{ old('day_fr', $workingHour->day_fr) }}" placeholder="Lundi – Mardi">
                        <div class="form-text">Optionnel</div>
                        @error('day_fr')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Day Index <span class="text-danger">*</span></label>
                        <select name="day_index" class="form-control @error('day_index') is-invalid @enderror" required>
                            <option value="0"  {{ old('day_index',$workingHour->day_index)==0  ? 'selected':'' }}>0 — الأحد</option>
                            <option value="1"  {{ old('day_index',$workingHour->day_index)==1  ? 'selected':'' }}>1 — الاثنين</option>
                            <option value="2"  {{ old('day_index',$workingHour->day_index)==2  ? 'selected':'' }}>2 — الثلاثاء</option>
                            <option value="3"  {{ old('day_index',$workingHour->day_index)==3  ? 'selected':'' }}>3 — الأربعاء</option>
                            <option value="4"  {{ old('day_index',$workingHour->day_index)==4  ? 'selected':'' }}>4 — الخميس</option>
                            <option value="5"  {{ old('day_index',$workingHour->day_index)==5  ? 'selected':'' }}>5 — الجمعة</option>
                            <option value="6"  {{ old('day_index',$workingHour->day_index)==6  ? 'selected':'' }}>6 — السبت</option>
                            <option value="-1" {{ old('day_index',$workingHour->day_index)==-1 ? 'selected':'' }}>-1 — خاص</option>
                        </select>
                        @error('day_index')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">وقت الفتح</label>
                        <input type="time" name="open_time" class="form-control"
                               value="{{ old('open_time', $workingHour->open_time) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">وقت الإغلاق</label>
                        <input type="time" name="close_time" class="form-control"
                               value="{{ old('close_time', $workingHour->close_time) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">ملاحظة (AR)</label>
                        <input type="text" name="note_ar" dir="rtl" class="form-control"
                               value="{{ old('note_ar', $workingHour->note_ar) }}" placeholder="الغداء · العشاء">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Note (EN)</label>
                        <input type="text" name="note_en" class="form-control"
                               value="{{ old('note_en', $workingHour->note_en) }}" placeholder="Lunch · Dinner">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Note (FR)</label>
                        <input type="text" name="note_fr" class="form-control"
                               value="{{ old('note_fr', $workingHour->note_fr) }}" placeholder="Déjeuner · Dîner">
                        <div class="form-text">Optionnel</div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">الترتيب</label>
                        <input type="number" name="sort_order" min="0" class="form-control"
                               value="{{ old('sort_order', $workingHour->sort_order) }}">
                    </div>

                    <div class="col-md-5 d-flex gap-4 align-items-center pt-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1"
                                   {{ $workingHour->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">نشط</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_ramadan"
                                   id="is_ramadan" value="1"
                                   {{ $workingHour->is_ramadan ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_ramadan">
                                <i class="fas fa-moon text-warning me-1"></i>صف رمضان
                            </label>
                        </div>
                    </div>

                </div>

                <hr class="my-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> تحديث
                    </button>
                    <a href="{{ route('working-hours.index') }}" class="btn btn-outline-secondary px-4">إلغاء</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
