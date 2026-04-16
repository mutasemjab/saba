@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">{{ __('messages.create_about') }}</h3>

    <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        
        <div class="form-group">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
        </div>

        <div class="form-group">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
        </div>

        <div class="form-group">
            <label>Nom (FR)</label>
            <input type="text" name="name_fr" class="form-control" value="{{ old('name_fr') }}" placeholder="Optionnel — si vide, l'anglais sera utilisé">
        </div>

        <div class="form-group">
            <label>{{ __('messages.description_en') }}</label>
            <textarea name="description_en" class="form-control rich-text" rows="3">{{ old('description_en') }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('messages.description_ar') }}</label>
            <textarea name="description_ar" class="form-control rich-text" rows="3">{{ old('description_ar') }}</textarea>
        </div>

        <div class="form-group">
            <label>Description (FR)</label>
            <textarea name="description_fr" class="form-control rich-text" rows="3" placeholder="Optionnel">{{ old('description_fr') }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('messages.photo') }}</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
