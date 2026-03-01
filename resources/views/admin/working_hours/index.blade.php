@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-clock me-2 text-info"></i>
            أوقات الدوام
        </h4>
        <a href="{{ route('working-hours.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> إضافة وقت دوام
        </a>
    </div>


    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th>
                        <th>اليوم (AR / EN)</th>
                        <th width="80">index</th>
                        <th width="120">وقت الفتح</th>
                        <th width="120">وقت الإغلاق</th>
                        <th>ملاحظة</th>
                        <th width="90">رمضان</th>
                        <th width="80">الترتيب</th>
                        <th width="90">الحالة</th>
                        <th width="160">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hours as $wh)
                    <tr class="{{ $wh->is_ramadan ? 'table-warning' : '' }}">
                        <td class="text-center text-muted small">{{ $loop->iteration }}</td>

                        <td>
                            <div class="fw-semibold" dir="rtl">{{ $wh->day_ar }}</div>
                            <small class="text-muted">{{ $wh->day_en }}</small>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $wh->day_index }}</span>
                        </td>

                        <td class="text-center fw-semibold text-success">
                            {{ $wh->open_time ?: '—' }}
                        </td>

                        <td class="text-center fw-semibold text-danger">
                            {{ $wh->close_time ?: '—' }}
                        </td>

                        <td>
                            @if($wh->note_ar)
                                <div dir="rtl" class="small">{{ $wh->note_ar }}</div>
                                <small class="text-muted">{{ $wh->note_en }}</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($wh->is_ramadan)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-moon me-1"></i>نعم
                                </span>
                            @else
                                <span class="badge bg-light text-muted">لا</span>
                            @endif
                        </td>

                        <td class="text-center text-muted small">{{ $wh->sort_order }}</td>

                        <td class="text-center">
                            @if($wh->is_active)
                                <span class="badge bg-success">نشط</span>
                            @else
                                <span class="badge bg-secondary">مخفي</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('working-hours.edit', $wh->id) }}"
                               class="btn btn-sm btn-outline-warning" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('working-hours.destroy', $wh->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirmDelete(this)" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="fas fa-clock fa-2x mb-2 d-block"></i>
                            لا توجد بيانات — أضف أوقات الدوام
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- day_index guide --}}
    <div class="card mt-3 border-0 bg-light">
        <div class="card-body py-2">
            <small class="text-muted">
                <strong>Day Index:</strong>
                0=أحد (Sun) | 1=اثنين (Mon) | 2=ثلاثاء (Tue) | 3=أربعاء (Wed) | 4=خميس (Thu) | 5=جمعة (Fri) | 6=سبت (Sat) | -1=رمضان/خاص
            </small>
        </div>
    </div>

</div>

@push('scripts')
<script>
function confirmDelete(btn) {
    if (confirm('هل أنت متأكد من الحذف؟')) btn.closest('form').submit();
}
</script>
@endpush
@endsection
