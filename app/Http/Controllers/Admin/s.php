<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function index()
    {
        return view('admin.product_options.index');
    }

    public function getList(Request $request)
    {
        $data = ProductOption::with('product')->latest();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return app()->getLocale() == 'ar' ? $row->name_ar : $row->name_en;
            })
            ->addColumn('price_unit', function ($row) {
                return app()->getLocale() == 'ar' ? $row->price_unit_ar : $row->price_unit_en;
            })
            ->addColumn('action', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary editBtn" data-id="'.$row->id.'">'.__('messages.edit').'</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'">'.__('messages.delete').'</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'price'          => 'required|numeric',
            'price_unit_ar'  => 'nullable',
            'price_unit_en'  => 'nullable',
            'sort_order'     => 'nullable|integer',
        ]);

        ProductOption::create($data);

        return response()->json(['success' => true, 'message' => __('messages.created_successfully')]);
    }

    public function edit($id)
    {
        return ProductOption::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = ProductOption::findOrFail($id);

        $data = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'price'          => 'required|numeric',
            'price_unit_ar'  => 'nullable',
            'price_unit_en'  => 'nullable',
            'sort_order'     => 'nullable|integer',
        ]);

        $item->update($data);

        return response()->json(['success' => true, 'message' => __('messages.updated_successfully')]);
    }

    public function destroy($id)
    {
        ProductOption::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => __('messages.deleted_successfully')]);
    }
}