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
        $categories       = Category::orderBy('name_ar')->get();
        $products         = Product::with('category')->orderBy('category_id')->get();
        $setting          = Setting::first();
        $about            = About::where('type', 'company_profile')->first();
        $vision           = About::where('type', 'vision')->first();
        $videos           = Video::active()->get();
        $workingHours     = WorkingHour::active()->get();

        return view('user.home', compact(
            'featuredProducts','categories','products',
            'about','vision','locale','setting',
            'videos','workingHours'
        ));
    }

    public function filterProducts(Request $request)
    {
        $locale     = app()->getLocale();
        $categoryId = $request->get('category_id');
        $products   = Product::when($categoryId, fn($q)=>$q->where('category_id',$categoryId))->get();

        return response()->json(['success'=>true,'products'=>$products,'locale'=>$locale]);
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name','phone','subject','message'));

        return back()->with('success', __('front.message_sent'));
    }
}
