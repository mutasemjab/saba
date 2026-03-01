@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>{{ __('messages.categories') }}</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        {{ __('messages.add_category') }}
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.category') }}</th>
                <th width="150">{{ __('messages.actions') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en }}</td>
                <td>
                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                    <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('{{ __('messages.are_you_sure') }}')" class="btn btn-sm btn-danger">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
