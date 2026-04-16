<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function index()
    {
        $items = ProductOption::with('product')->latest()->paginate(10);
        return view('admin.product_options.index', compact('items'));
    }

    public function create()
    {
        $products = Product::pluck('name_en', 'id');
        return view('admin.product_options.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'name_fr'        => 'nullable',
            'price'          => 'required|numeric',
            'price_unit_ar'  => 'nullable',
            'price_unit_en'  => 'nullable',
            'price_unit_fr'  => 'nullable',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['name_fr']       = $request->name_fr ?: $request->name_en;
        $data['price_unit_fr'] = $request->price_unit_fr ?: ($request->price_unit_en ?? 'MAD');

        ProductOption::create($data);

        return redirect()->route('product-options.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit($id)
    {
        $item = ProductOption::findOrFail($id);
        $products = Product::pluck('name_en', 'id');

        return view('admin.product_options.edit', compact('item', 'products'));
    }

    public function update(Request $request, $id)
    {
        $item = ProductOption::findOrFail($id);

        $data = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'name_fr'        => 'nullable',
            'price'          => 'required|numeric',
            'price_unit_ar'  => 'nullable',
            'price_unit_en'  => 'nullable',
            'price_unit_fr'  => 'nullable',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['name_fr']       = $request->name_fr ?: $request->name_en;
        $data['price_unit_fr'] = $request->price_unit_fr ?: ($request->price_unit_en ?? 'MAD');

        $item->update($data);

        return redirect()->route('product-options.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        ProductOption::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', __('messages.deleted_successfully'));
    }
}