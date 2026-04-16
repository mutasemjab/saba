@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">{{ __('messages.edit_about') }}</h3>

    <form action="{{ route('abouts.update',$item->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf @method('PUT')

     
        <div class="form-group">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en',$item->name_en) }}">
        </div>

        <div class="form-group">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar',$item->name_ar) }}">
        </div>

        <div class="form-group">
            <label>Nom (FR)</label>
            <input type="text" name="name_fr" class="form-control" value="{{ old('name_fr',$item->name_fr) }}" placeholder="Optionnel">
        </div>

        <div class="form-group">
            <label>{{ __('messages.description_en') }}</label>
            <textarea name="description_en" class="form-control rich-text" rows="3">{{ old('description_en',$item->description_en) }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('messages.description_ar') }}</label>
            <textarea name="description_ar" class="form-control rich-text" rows="3">{{ old('description_ar',$item->description_ar) }}</textarea>
        </div>

        <div class="form-group">
            <label>Description (FR)</label>
            <textarea name="description_fr" class="form-control rich-text" rows="3" placeholder="Optionnel">{{ old('description_fr',$item->description_fr) }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('messages.photo') }}</label><br>
            <img src="{{ asset('assets/admin/uploads/'.$item->photo) }}" style="width:80px" class="mb-2"><br>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
