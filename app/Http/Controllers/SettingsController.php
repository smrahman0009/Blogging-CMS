<?php

namespace App\Http\Controllers;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.setting.edit')->with('setting',Setting::first());
    }

    public function update(Request $request){
        $setting = Setting::first();

        $this->validate($request,[
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
            'address' => 'required'
        ]);

        $setting->site_name = $request->site_name;
        $setting->contact_number = $request->contact_number;
        $setting->contact_email = $request->contact_email;
        $setting->address = $request->address;

        $setting->update();

        toastr()->success('Update Settings successfully');

        return redirect()->back();
    }
}
