<?php

namespace App\Http\Controllers;

use App\Checkout;
use Illuminate\Http\Request;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => Settings::where('name', '!=', 'about_us')->where('name', '!=', 'cara_order')->orderBy('id', 'asc')->get()
        ];
        return view('settings.index', $data);
    }

    public function update(Request $request)
    {
        // dd($request->id[0]);

        foreach ($request->kolom as $index => $row) {
            $setting = Settings::find($request->id[$index]);
            $setting->text = $row;
            $setting->save();
        }

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', 'Settings updated successfully');
        return redirect()->to(route('settings.index'));
    }

    public function aboutUs()
    {
        $data = [
            'settings' => Settings::where('name', 'about_us')->orderBy('id', 'asc')->first()
        ];
        return view('settings.aboutus', $data);
    }

    public function caraOrder()
    {
        $data = [
            'settings' => Settings::where('name', 'cara_order')->orderBy('id', 'asc')->first()
        ];
        return view('settings.cara_order', $data);
    }

    public function updateAboutUs(Request $request)
    {
        $setting = Settings::find($request->id);
        $setting->text = $request->kolom;
        $setting->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', 'About US updated successfully');
        return redirect()->to(route('aboutus.index'));
    }


    public function upload(Request $request, $trx)
    {
        $checkout = Checkout::where('trx_no', $trx)->firstOrFail();

        $data = [
            'checkout' => $checkout
        ];

        return view('upload', $data);
    }

    public function updateCaraOrder(Request $request)
    {
        $setting = Settings::find($request->id);
        $setting->text = $request->kolom;
        $setting->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', 'Cara Order updated successfully');
        return redirect()->to(route('caraorder.index'));
    }
}
