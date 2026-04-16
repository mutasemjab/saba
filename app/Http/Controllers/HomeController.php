<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Video;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $locale           = app()->getLocale();
        $featuredProducts = Product::where('is_featured', 1)->get();
        $categories       = Category::orderBy('created_at', 'desc')->get();

        // أول كاتيجوري بشكل افتراضي
        $firstCategory    = $categories->first();
        $products         = Product::with(['category', 'options'])
            ->when($firstCategory, fn($q) => $q->where('category_id', $firstCategory->id))
            ->orderBy('category_id')->get();

        $setting      = Setting::first();
        $about        = About::where('type', 'company_profile')->first();
        $vision       = About::where('type', 'vision')->first();
        $videos       = Video::active()->get();
        $workingHours = WorkingHour::active()->get();

        return view('user.home', compact(
            'featuredProducts',
            'categories',
            'products',
            'about',
            'vision',
            'locale',
            'setting',
            'videos',
            'workingHours',
            'firstCategory'
        ));
    }

    public function filterProducts(Request $request)
    {
        $locale     = app()->getLocale();
        $categoryId = $request->get('category_id');
        $products   = Product::with('options')
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->get();

        // أضف الـ options في الـ JSON response
        $products = $products->map(function ($p) {
            $p->options_data = $p->options->map(fn($o) => [
                'id'            => $o->id,
                'name_ar'       => $o->name_ar,
                'name_en'       => $o->name_en,
                'name_fr'       => $o->name_fr,
                'price'         => $o->price,
                'price_unit_ar' => $o->price_unit_ar,
                'price_unit_en' => $o->price_unit_en,
                'price_unit_fr' => $o->price_unit_fr,
            ]);
            return $p;
        });

        return response()->json(['success' => true, 'products' => $products, 'locale' => $locale]);
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'phone', 'subject', 'message'));

        return back()->with('success', __('front.message_sent'));
    }
}
