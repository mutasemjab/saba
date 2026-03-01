<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /** صفحة المنيو الكاملة */
    public function index(Request $request)
    {
        $locale         = app()->getLocale();
        $categoryId     = $request->get('category_id');
        $categories     = Category::withCount('products')->orderBy('name_ar')->get();
        $products       = Product::with('category')
                            ->when($categoryId, fn($q)=>$q->where('category_id',$categoryId))
                            ->orderBy('category_id')->get();
        $activeCategory = $categoryId ? Category::find($categoryId) : null;

        return view('user.menu', compact('categories','products','activeCategory','locale','categoryId'));
    }

    /** صفحة تفاصيل المنتج */
    public function show($id)
    {
        $locale  = app()->getLocale();
        $product = Product::with('category')->findOrFail($id);

        // أصناف مشابهة: نفس الكاتيجوري أولاً
        $similar = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id','!=',$product->id)
            ->limit(6)->get();

        // لو أقل من 3، نكمّل من منتجات عشوائية
        if ($similar->count() < 3) {
            $extra = Product::with('category')
                ->where('id','!=',$product->id)
                ->whereNotIn('id', $similar->pluck('id'))
                ->inRandomOrder()
                ->limit(6 - $similar->count())->get();
            $similar = $similar->merge($extra);
        }

        return view('user.product', compact('product','similar','locale'));
    }
}
