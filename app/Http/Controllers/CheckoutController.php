<?php

namespace App\Http\Controllers;

use App\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkout = Checkout::orderBy('id', 'desc')->get();

        $data = [
            'checkout' => $checkout
        ];

        return view('checkout.index', $data);
    }

    public function upload(Request $request)
    {
        DB::beginTransaction();
        try {
            $checkout = Checkout::find($request->id_checkout);
            $format = $request->file('image')->getClientOriginalName();
            $name = Str::random(11);
            $newName = $name . $format;
            $request->file('image')->move(public_path() . '/bukti', $newName);
            $checkout->image = $newName;

            if ($checkout->save()) {
                $request->session()->flash('alert', 'success');
                $request->session()->flash('message', 'Checkout updated successfully');

                DB::commit();
                return redirect()->to(url(''));
            }
        } catch (\Exception $e) {
            throw $e;
            return redirect()->to(url(''));
        }
    }


    public function destroy(Request $request, $id)
    {
        $checkout = Checkout::find($id);

        if ($checkout->delete()) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'checkout deleted successfully');
            return redirect()->to(route('checkout.index'));
        }
    }
}
