@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-video me-2 text-danger"></i>
                الفيديوهات
            </h4>
            <a href="{{ route('videos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> إضافة فيديو
            </a>
        </div>


        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>
                            <th width="100">الغلاف</th>
                            <th>العنوان</th>
                            <th width="200">الفيديو</th>
                            <th width="90">المدة</th>
                            <th width="80">الترتيب</th>
                            <th width="90">الحالة</th>
                            <th width="160">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                            <tr>
                                <td class="text-center text-muted small">{{ $loop->iteration }}</td>

                                <td class="text-center">
                                    <img src="{{ asset('assets/admin/uploads/' . $video->thumbnail) }}" width="80"
                                        height="52" style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6"
                                        onerror="this.src='https://via.placeholder.com/80x52?text=IMG'">
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $video->title_ar }}</div>
                                    <small class="text-muted">{{ $video->title_en }}</small>
                                </td>

                                <td class="text-center">
                                    @if ($video->video_url)
                                        <video width="120" style="border-radius:6px;border:1px solid #dee2e6" muted>
                                            <source src="{{ asset('assets/admin/uploads/' . $video->video_url) }}">
                                        </video>

                                        <div class="mt-1">
                                            <a href="{{ asset('assets/admin/uploads/' . $video->video_url) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                مشاهدة
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-muted small">بدون فيديو</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $video->duration ?? '—' }}</span>
                                </td>

                                <td class="text-center text-muted small">{{ $video->sort_order }}</td>

                                <td class="text-center">
                                    @if ($video->is_active)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-secondary">مخفي</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-outline-warning"
                                        title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                                        class="d-inline">
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
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="fas fa-video-slash fa-2x mb-2 d-block"></i>
                                    لا توجد فيديوهات بعد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($videos->hasPages())
                <div class="card-footer">{{ $videos->links() }}</div>
            @endif
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
