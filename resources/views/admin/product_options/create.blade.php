@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>{{ __('messages.add') }}</h3>

    <form action="{{ route('product-options.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label>{{ __('messages.product') }}</label>
            <select name="product_id" class="form-control">
                @foreach($products as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control">
        </div>

        <div class="mb-2">
            <label>Nom (FR)</label>
            <input type="text" name="name_fr" class="form-control" placeholder="Optionnel — si vide, l'anglais sera utilisé">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.price') }}</label>
            <input type="number" name="price" class="form-control">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.price_unit_ar') }}</label>
            <input type="text" name="price_unit_ar" class="form-control" value="درهم" dir="rtl">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.price_unit_en') }}</label>
            <input type="text" name="price_unit_en" class="form-control" value="MAD">
        </div>

        <div class="mb-2">
            <label>Unité de prix (FR)</label>
            <input type="text" name="price_unit_fr" class="form-control" value="MAD" placeholder="Optionnel">
        </div>

        <button class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>

@endsection