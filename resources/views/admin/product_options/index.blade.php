@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>{{ __('messages.product_options') }}</h3>

    <a href="{{ route('product-options.create') }}" class="btn btn-success mb-3">
        {{ __('messages.add') }}
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('product-options.edit', $item->id) }}" class="btn btn-sm btn-primary">
                            {{ __('messages.edit') }}
                        </a>

                        <form action="{{ route('product-options.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                {{ __('messages.delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>

@endsection