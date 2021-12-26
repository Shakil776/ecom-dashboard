<?php

namespace App\Http\Controllers;

use App\StoreBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreBrandController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $brands = StoreBrand::get()->toArray();
        return view('layouts.admin_layouts.store_brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('layouts.admin_layouts.store_brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validaion
        $rules = ['name' => 'required'];

        $customMessages = ['name.required' => 'Brand name is required.'];

        $this->validate($request, $rules, $customMessages);

        StoreBrand::create(['name' => $request->name]);

        Session::flash('success', 'Brand Added Successfully.');

        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreBrand  $storeBrand
     * @return \Illuminate\Http\Response
     */
    public function show(StoreBrand $storeBrand) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreBrand  $storeBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreBrand $storeBrand) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreBrand  $storeBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreBrand $storeBrand) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreBrand  $storeBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreBrand $storeBrand) {
        //
    }

    /* Brand json  */
    public function getBrandJson() {
        $brands = StoreBrand::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'data'    => $brands,
        ], 200);
    }
}
