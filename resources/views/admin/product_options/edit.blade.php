@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>{{ __('messages.edit') }}</h3>

    <form action="{{ route('product-options.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>{{ __('messages.product') }}</label>
            <select name="product_id" class="form-control">
                @foreach($products as $id => $name)
                    <option value="{{ $id }}" {{ $item->product_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" value="{{ $item->name_ar }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" value="{{ $item->name_en }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>{{ __('messages.price') }}</label>
            <input type="number" name="price" value="{{ $item->price }}" class="form-control">
        </div>

        <button class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>

@endsection