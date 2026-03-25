@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>{{ __('messages.product_options') }}</h3>

    <button class="btn btn-success mb-3" id="addBtn">
        {{ __('messages.add') }}
    </button>

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.price_unit') }}</th>
                <th>{{ __('messages.sort_order') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <form id="form">
            @csrf
            <input type="hidden" id="id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{ __('messages.add_edit') }}</h5>
                </div>

                <div class="modal-body">

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

                    <div class="mb-2">
                        <label>{{ __('messages.price_unit_ar') }}</label>
                        <input type="text" name="price_unit_ar" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>{{ __('messages.price_unit_en') }}</label>
                        <input type="text" name="price_unit_en" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>{{ __('messages.sort_order') }}</label>
                        <input type="number" name="sort_order" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection