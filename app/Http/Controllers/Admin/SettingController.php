<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data['gs'] = Setting::first();
        $data['page_title'] = 'General Settings';
        return view('admin.general.index', $data);
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->currency = $request->currency;
        $setting->save();

        return back()->with('success', 'Settings Updated');
    }
}
