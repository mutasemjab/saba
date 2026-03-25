<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $locale         = app()->getLocale();
        $categoryId     = $request->get('category_id');
        $categories     = Category::withCount('products')->orderBy('created_at','desc')->get();
        $products       = Product::with(['category', 'options'])   // ← أضفنا options
                            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                            ->orderBy('category_id')->get();
        $activeCategory = $categoryId ? Category::find($categoryId) : null;

        return view('user.menu', compact('categories','products','activeCategory','locale','categoryId'));
    }

    public function show($id)
    {
        $locale  = app()->getLocale();
        $product = Product::with(['category', 'options'])->findOrFail($id);  // ← أضفنا options

        $similar = Product::with(['category', 'options'])  // ← أضفنا options
            ->where('category_id', $product->category_id)
            ->where('id','!=',$product->id)
            ->limit(6)->get();

        if ($similar->count() < 3) {
            $extra = Product::with(['category', 'options'])  // ← أضفنا options
                ->where('id','!=',$product->id)
                ->whereNotIn('id', $similar->pluck('id'))
                ->inRandomOrder()
                ->limit(6 - $similar->count())->get();
            $similar = $similar->merge($extra);
        }

        return view('user.product', compact('product','similar','locale'));
    }
}