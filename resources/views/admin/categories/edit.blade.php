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

                <button class="btn btn-primary mt-3">{{ __('messages.update') }}</button>
            </form>

        </div>
    </div>

</div>
@endsection
