@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>{{ __('messages.abouts') }}</h3>
     
    </div>



    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>{{ __('messages.name_en') }}</th>
                <th>{{ __('messages.name_ar') }}</th>
                <th>{{ __('messages.photo') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name_en }}</td>
                <td>{{ $item->name_ar }}</td>
                <td><img src="{{ asset('assets/admin/uploads/'.$item->photo) }}" style="width:60px;"></td>
                <td>
                    <a href="{{ route('abouts.edit',$item->id) }}" class="btn btn-sm btn-success">
                        {{ __('messages.edit') }}
                    </a>

                    <form action="{{ route('abouts.destroy',$item->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
