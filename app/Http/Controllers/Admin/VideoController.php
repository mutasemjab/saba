<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:video-table')->only('index');
        $this->middleware('permission:video-add')->only(['create', 'store']);
        $this->middleware('permission:video-edit')->only(['edit', 'update']);
        $this->middleware('permission:video-delete')->only('destroy');
    }

    public function index()
    {
        $videos = Video::orderBy('sort_order')->orderBy('id')->paginate(100);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar'   => 'required|string|max:255',
            'title_en'   => 'required|string|max:255',
            'title_fr'   => 'nullable|string|max:255',
            'thumbnail'  => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'video_url'  => 'nullable',
            'duration'   => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $thumbnail = uploadImage('assets/admin/uploads', $request->thumbnail);
        $video = uploadImage('assets/admin/uploads', $request->video_url);

        Video::create([
            'title_ar'   => $request->title_ar,
            'title_en'   => $request->title_en,
            'title_fr'   => $request->title_fr ?: $request->title_en,
            'thumbnail'  => $thumbnail,
            'video_url'  => $video,
            'duration'   => $request->duration,
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('videos.index')->with('success', 'تم إضافة الفيديو بنجاح');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title_ar'   => 'required|string|max:255',
            'title_en'   => 'required|string|max:255',
            'title_fr'   => 'nullable|string|max:255',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'video_url'  => 'nullable',
            'duration'   => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title_ar'   => $request->title_ar,
            'title_en'   => $request->title_en,
            'title_fr'   => $request->title_fr ?: $request->title_en,
            'duration'   => $request->duration,
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = uploadImage('assets/admin/uploads', $request->thumbnail);
        }
        if ($request->hasFile('video_url')) {
            $data['video_url'] = uploadImage('assets/admin/uploads', $request->video_url);

        }


        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
