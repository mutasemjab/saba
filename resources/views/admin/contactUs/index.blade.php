@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.contact_us_management') }}</h3>
                </div>

                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                           placeholder="{{ __('messages.search_by_name_email_subject') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}" 
                                       class="btn btn-outline-secondary {{ request('per_page', 25) == 10 ? 'active' : '' }}">10</a>
                                    <a href="{{ request()->fullUrlWithQuery(['per_page' => 25]) }}" 
                                       class="btn btn-outline-secondary {{ request('per_page', 25) == 25 ? 'active' : '' }}">25</a>
                                    <a href="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}" 
                                       class="btn btn-outline-secondary {{ request('per_page', 25) == 50 ? 'active' : '' }}">50</a>
                                    <a href="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}" 
                                       class="btn btn-outline-secondary {{ request('per_page', 25) == 100 ? 'active' : '' }}">100</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Results Info -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p class="text-muted">
                                {{ __('messages.showing') }} {{ $contacts->firstItem() ?? 0 }} {{ __('messages.to') }} {{ $contacts->lastItem() ?? 0 }} 
                                {{ __('messages.of') }} {{ $contacts->total() }} {{ __('messages.results') }}
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.id') }}
                                            @if(request('sort') == 'id')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.name') }}
                                            @if(request('sort') == 'name')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.email') }}
                                            @if(request('sort') == 'email')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.subject') }}</th>
                                    <th>{{ __('messages.message') }}</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.created') }}
                                            @if(request('sort') == 'created_at' || !request('sort'))
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>
                                        <strong>{{ $contact->name }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $contact->email }}" class="text-primary">
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $contact->subject }}">
                                            {{ Str::limit($contact->subject, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(strlen($contact->message) > 100)
                                            <span class="text-truncate d-inline-block" style="max-width: 300px;" title="{{ $contact->message }}">
                                                {{ Str::limit($contact->message, 100) }}
                                            </span>
                                            <button type="button" class="btn btn-sm btn-outline-info ml-2" 
                                                    data-toggle="modal" data-target="#messageModal{{ $contact->id }}">
                                                <i class="fas fa-eye"></i> {{ __('messages.view_full') }}
                                            </button>

                                            <!-- Message Modal -->
                                            <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('messages.full_message') }} - {{ $contact->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.from') }}:</strong> {{ $contact->name }} ({{ $contact->email }})
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.subject') }}:</strong> {{ $contact->subject }}
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.message') }}:</strong>
                                                            </div>
                                                            <div class="p-3 bg-light rounded">
                                                                {!! nl2br(e($contact->message)) !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                                                               class="btn btn-primary">
                                                                <i class="fas fa-reply"></i> {{ __('messages.reply_via_email') }}
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                {{ __('messages.close') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {!! nl2br(e($contact->message)) !!}
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($contact->created_at)->format('Y-m-d H:i') }}
                                            <br>
                                            <span class="badge badge-secondary">
                                                {{ \Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                            </span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                                               class="btn btn-sm btn-primary" title="{{ __('messages.reply_via_email') }}">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    data-toggle="modal" data-target="#messageModal{{ $contact->id }}" 
                                                    title="{{ __('messages.view_full_message') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete_contact') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ __('messages.delete') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('messages.no_contacts_found') }}</h5>
                                            <p class="text-muted">{{ __('messages.no_contacts_to_display') }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            {{ $contacts->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    // Auto-focus search input if there's a search term
    if ($('input[name="search"]').val()) {
        $('input[name="search"]').focus();
    }
});
</script>

<style>
.table td {
    vertical-align: middle;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.table th a {
    display: block;
    color: white !important;
}

.table th a:hover {
    color: #f8f9fa !important;
}

.modal-body .bg-light {
    max-height: 400px;
    overflow-y: auto;
}
</style>
@endsection