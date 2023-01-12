<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimoni;
use App\Category;
use App\ImageProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimoni = Testimoni::orderBy('id', 'desc')
            ->get();

        $data = [
            'testimoni' => $testimoni
        ];

        return view('testimoni.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        $data = [
            'category' => $category
        ];

        return view('testimoni.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            // dd(public_path() . '/testimoni');
            $testimoni = new Testimoni();
            $format = $request->file('image')->getClientOriginalName();
            $name = Str::random(11);
            $newName = $name . $format;
            $request->file('image')->move(public_path() . '/testimoni', $newName);
            $testimoni->image = $newName;
            $testimoni->order = $request->order;
            $testimoni->status = 1;

            if ($testimoni->save()) {

                $request->session()->flash('alert', 'success');
                $request->session()->flash('message', 'Testimoni created successfully');

                DB::commit();
                return redirect()->to(route('testimoni.index'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->to(route('testimoni.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimoni = Testimoni::find($id);

        $data = [
            'testimoni' => $testimoni
        ];

        return view('testimoni.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $testimoni = Testimoni::find($id);
            if ($request->image != null) {

                $format = $request->file('image')->getClientOriginalName();
                $name = Str::random(11);
                $newName = $name . $format;
                $request->file('image')->move(public_path() . '/testimoni', $newName);
                $testimoni->image = $newName;
            }
            $testimoni->order = $request->order;
            $testimoni->status = 1;

            if ($testimoni->save()) {

                $request->session()->flash('alert', 'success');
                $request->session()->flash('message', 'Testimoni updated successfully');

                DB::commit();
                return redirect()->to(route('testimoni.index'));
            }
        } catch (\Exception $e) {
            throw $e;
            return redirect()->to(route('testimoni.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $testimoni = Testimoni::find($id);

        if ($testimoni->delete()) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Testimoni deleted successfully');
            return redirect()->to(route('testimoni.index'));
        }
    }
}
