@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-utensils me-2 text-warning"></i>
            {{ __('messages.products') }}
        </h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> {{ __('messages.add_product') }}
        </a>
    </div>



    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th>
                        <th width="70">{{ __('messages.photo') }}</th>
                        <th>{{ __('messages.product') }}</th>
                        <th>{{ __('messages.category') }}</th>
                        <th width="90">{{ __('messages.price') }}</th>
                        <th width="90">{{ __('messages.featured') }}</th>
                        <th width="100" class="text-center">Active</th>
                        <th width="160">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $item)
                    <tr>
                        <td class="text-center text-muted small">{{ $loop->iteration }}</td>

                        <td class="text-center">
                            <img src="{{ asset('assets/admin/uploads/'.$item->photo) }}"
                                 width="52" height="52"
                                 style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6"
                                 onerror="this.src='https://via.placeholder.com/52x52?text=IMG'">
                        </td>

                        <td>
                            <div class="fw-semibold">{{ app()->getLocale()=='ar' ? $item->name_ar : $item->name_en }}</div>
                            <small class="text-muted">{{ app()->getLocale()=='ar' ? $item->name_en : $item->name_ar }}</small>
                        </td>

                        <td>
                            @if($item->category)
                                <span class="badge bg-secondary">
                                    {{ app()->getLocale()=='ar' ? $item->category->name_ar : $item->category->name_en }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($item->price)
                                <span class="fw-semibold text-success">{{ $item->price }}</span>
                                <small class="text-muted d-block">{{ app()->getLocale()=='ar' ? ($item->price_unit_ar??'درهم') : ($item->price_unit_en??'MAD') }}</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($item->is_featured == 1)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>{{ __('messages.yes') }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted">{{ __('messages.no') }}</span>
                            @endif
                        </td>


                        <td class="text-center">
                            <form action="{{ route('products.toggleActive', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('products.edit', $item->id) }}"
                               class="btn btn-sm btn-outline-warning" title="{{ __('messages.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="{{ __('messages.delete') }}"
                                        onclick="confirmDelete(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                            {{ __('messages.no_data') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="card-footer">{{ $products->links() }}</div>
        @endif
    </div>

</div>

@push('scripts')
<script>
function confirmDelete(btn) {
    if (confirm('{{ __("messages.are_you_sure") }}')) {
        btn.closest('form').submit();
    }
}
</script>
@endpush
@endsection
