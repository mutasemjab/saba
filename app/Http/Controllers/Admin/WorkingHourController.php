<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:working-hours-table')->only('index');
        $this->middleware('permission:working-hours-add')->only(['create', 'store']);
        $this->middleware('permission:working-hours-edit')->only(['edit', 'update']);
        $this->middleware('permission:working-hours-delete')->only('destroy');
    }

    public function index()
    {
        $hours = WorkingHour::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.working_hours.index', compact('hours'));
    }

    public function create()
    {
        return view('admin.working_hours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_ar'      => 'required|string|max:100',
            'day_en'      => 'required|string|max:100',
            'day_index'   => 'required|integer|min:-1|max:6',
            'open_time'   => 'nullable|string|max:10',
            'close_time'  => 'nullable|string|max:10',
            'note_ar'     => 'nullable|string|max:255',
            'note_en'     => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        WorkingHour::create([
            'day_ar'     => $request->day_ar,
            'day_en'     => $request->day_en,
            'day_index'  => $request->day_index,
            'open_time'  => $request->open_time,
            'close_time' => $request->close_time,
            'note_ar'    => $request->note_ar,
            'note_en'    => $request->note_en,
            'is_ramadan' => $request->has('is_ramadan') ? 1 : 0,
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('working-hours.index')->with('success', 'تم الإضافة بنجاح');
    }

    public function edit(WorkingHour $workingHour)
    {
        return view('admin.working_hours.edit', compact('workingHour'));
    }

    public function update(Request $request, WorkingHour $workingHour)
    {
        $request->validate([
            'day_ar'      => 'required|string|max:100',
            'day_en'      => 'required|string|max:100',
            'day_index'   => 'required|integer|min:-1|max:6',
            'open_time'   => 'nullable|string|max:10',
            'close_time'  => 'nullable|string|max:10',
            'note_ar'     => 'nullable|string|max:255',
            'note_en'     => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $workingHour->update([
            'day_ar'     => $request->day_ar,
            'day_en'     => $request->day_en,
            'day_index'  => $request->day_index,
            'open_time'  => $request->open_time,
            'close_time' => $request->close_time,
            'note_ar'    => $request->note_ar,
            'note_en'    => $request->note_en,
            'is_ramadan' => $request->has('is_ramadan') ? 1 : 0,
            'is_active'  => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('working-hours.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(WorkingHour $workingHour)
    {
        $workingHour->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
