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
            <label>{{ __('messages.price') }}</label>
            <input type="number" name="price" class="form-control">
        </div>

        <button class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>

@endsection