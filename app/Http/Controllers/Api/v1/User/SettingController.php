<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Setting;

class SettingController extends Controller
{
    /** GET /api/v1/user/settings */
    public function index()
    {
        $setting = Setting::first();
        $about   = About::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'settings' => $setting ? [
                    'logo'       => $setting->logo
                        ? url('assets/admin/uploads/' . $setting->logo) : null,
                    'phone'      => $setting->phone,
                    'email'      => $setting->email,
                    'address'    => $setting->address,
                    'google_map' => $setting->google_map,
                    'instagram'  => $setting->instagram,
                    'facebook'   => $setting->facebook,
                    'twitter'    => $setting->twitter,
                ] : null,

                'about' => $about ? [
                    'name_ar'        => $about->name_ar,
                    'name_en'        => $about->name_en,
                    'description_ar' => $about->description_ar,
                    'description_en' => $about->description_en,
                    'photo'          => $about->photo
                        ? url('assets/admin/uploads/' . $about->photo) : null,
                ] : null,
            ],
        ]);
    }
}
