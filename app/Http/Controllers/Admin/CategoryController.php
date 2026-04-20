<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-table')->only('index');
        $this->middleware('permission:category-add')->only(['create', 'store']);
        $this->middleware('permission:category-edit')->only(['edit', 'update', 'toggleActive']);
        $this->middleware('permission:category-delete')->only('destroy');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'name_fr' => 'nullable',
        ]);

        Category::create([
            'name_en'   => $request->name_en,
            'name_ar'   => $request->name_ar,
            'name_fr'   => $request->name_fr ?: $request->name_en,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('categories.index')->with('success', 'Created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'name_fr' => 'nullable',
        ]);

        $category->update([
            'name_en'   => $request->name_en,
            'name_ar'   => $request->name_ar,
            'name_fr'   => $request->name_fr ?: $request->name_en,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('categories.index')->with('success', 'Updated successfully');
    }

    public function toggleActive(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);
        return back()->with('success', 'Status updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
