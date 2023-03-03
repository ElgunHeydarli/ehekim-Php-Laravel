<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.setting', compact('setting'));
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        $setting = Setting::first();
        if ($setting) {
            if ($request->hasFile('logo')) {
                FileManager::fileDelete('setting',$setting->logo);
                $data['logo'] = FileManager::fileUpload($request->file('logo'), 'setting');
            }
            $setting->update($data);
        }else{
            if ($request->hasFile('logo')) {
                $data['logo'] = FileManager::fileUpload($request->file('logo'), 'setting');
            }
            Setting::create($data);
        }

        toastr('Tənzimləmə məlumatları redaktə edildi');
        return redirect()->back();
    }
}
