@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">{{ __('messages.add_category') }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>{{ __('messages.category') }} (EN)</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ __('messages.category') }} (AR)</label>
                    <input type="text" name="name_ar" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ __('messages.category') }} (FR)</label>
                    <input type="text" name="name_fr" class="form-control" placeholder="Optionnel — si vide, l'anglais sera utilisé">
                </div>

                <button class="btn btn-success mt-3">{{ __('messages.save') }}</button>
            </form>

        </div>
    </div>

</div>
@endsection
