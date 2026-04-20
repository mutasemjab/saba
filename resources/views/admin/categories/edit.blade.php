@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">{{ __('messages.edit_category') }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>{{ __('messages.category') }} (EN)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $category->name_en }}" required>
                </div>

                <div class="form-group">
                    <label>{{ __('messages.category') }} (AR)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $category->name_ar }}" required>
                </div>

                <div class="form-group">
                    <label>{{ __('messages.category') }} (FR)</label>
                    <input type="text" name="name_fr" class="form-control" value="{{ $category->name_fr }}" placeholder="Optionnel">
                </div>

                <div class="form-group mt-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                            {{ $category->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (visible on site)</label>
                    </div>
                </div>

                <button class="btn btn-primary mt-3">{{ __('messages.update') }}</button>
            </form>

        </div>
    </div>

</div>
@endsection
