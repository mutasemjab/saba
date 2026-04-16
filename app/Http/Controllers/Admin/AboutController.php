<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:about-index')->only('index');
        $this->middleware('permission:about-create')->only(['create','store']);
        $this->middleware('permission:about-edit')->only(['edit','update']);
        $this->middleware('permission:about-delete')->only('destroy');
    }

    public function index()
    {
        $items = About::latest()->paginate(20);
        return view('admin.abouts.index', compact('items'));
    }

    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'description_en' => 'required',
            'description_ar' => 'required',
            'description_fr' => 'nullable',
            'photo' => 'required|image',
        ]);

        $filename = uploadImage('assets/admin/uploads', $request->photo);

        About::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'name_fr' => $request->name_fr ?: $request->name_en,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'description_fr' => $request->description_fr ?: $request->description_en,
            'photo' => $filename,
        ]);

        return redirect()->route('abouts.index')->with('success', __('messages.created_success'));
    }

    public function edit(About $about)
    {
        $item = $about;
        return view('admin.abouts.edit', compact('item'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'description_en' => 'required',
            'description_ar' => 'required',
            'description_fr' => 'nullable',
            'photo' => 'nullable|image',
        ]);

        $filename = $about->photo;

        if($request->hasFile('photo')){
            $filename = uploadImage('assets/admin/uploads', $request->photo);
        }

        $about->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'name_fr' => $request->name_fr ?: $request->name_en,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'description_fr' => $request->description_fr ?: $request->description_en,
            'photo' => $filename,
        ]);

        return redirect()->route('abouts.index')->with('success', __('messages.updated_success'));
    }

    public function destroy(About $about)
    {
        $about->delete();
        return back()->with('success', __('messages.deleted_success'));
    }
}
