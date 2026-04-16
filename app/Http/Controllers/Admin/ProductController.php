<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:product-table')->only('index');
        $this->middleware('permission:product-add')->only(['create', 'store']);
        $this->middleware('permission:product-edit')->only(['edit', 'update']);
        $this->middleware('permission:product-delete')->only('destroy');
    }

    public function index()
    {
        $products = Product::with('category')
            ->paginate(2000);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name_ar')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'name_fr'        => 'nullable|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_fr' => 'nullable|string',
            'photo'          => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'nullable|numeric|min:0',
        ]);

        $fileName = uploadImage('assets/admin/uploads', $request->photo);

        Product::create([
            'name_en'        => $request->name_en,
            'name_ar'        => $request->name_ar,
            'name_fr'        => $request->name_fr ?: $request->name_en,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'description_fr' => $request->description_fr ?: $request->description_en,
            'photo'          => $fileName,
            'is_featured'    => $request->is_featured ?? 2,
            'category_id'    => $request->category_id,
            'price'          => $request->price,
            'price_unit_ar'  => $request->price_unit_ar ?? 'درهم',
            'price_unit_en'  => $request->price_unit_en ?? 'MAD',
            'price_unit_fr'  => $request->price_unit_fr ?? 'MAD',
        ]);

        return redirect()->route('products.index')->with('success', 'تم الإضافة بنجاح');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name_ar')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'name_fr'        => 'nullable|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_fr' => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(
            'name_en', 'name_ar', 'name_fr',
            'description_en', 'description_ar', 'description_fr',
            'is_featured', 'category_id',
            'price', 'price_unit_ar', 'price_unit_en', 'price_unit_fr',
        );

        $data['is_featured']    = $request->is_featured ?? 2;
        $data['price_unit_ar']  = $request->price_unit_ar ?? 'درهم';
        $data['price_unit_en']  = $request->price_unit_en ?? 'MAD';
        $data['price_unit_fr']  = $request->price_unit_fr ?? 'MAD';
        $data['name_fr']        = $request->name_fr ?: $request->name_en;
        $data['description_fr'] = $request->description_fr ?: $request->description_en;

        if ($request->hasFile('photo')) {
            $data['photo'] = uploadImage('assets/admin/uploads', $request->photo);
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
