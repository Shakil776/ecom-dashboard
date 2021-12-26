<?php

namespace App\Http\Controllers;

use App\StoreSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreSizeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sizes = StoreSize::get()->toArray();
        return view('layouts.admin_layouts.store_size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('layouts.admin_layouts.store_size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validaion
        $rules = ['size' => 'required'];

        $customMessages = ['size.required' => 'Size is required.'];

        $this->validate($request, $rules, $customMessages);

        StoreSize::create(['size' => strtoupper($request->size)]);

        Session::flash('success', 'Size Added Successfully.');

        return redirect()->route('size.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreSize  $storeSize
     * @return \Illuminate\Http\Response
     */
    public function show(StoreSize $storeSize) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreSize  $storeSize
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreSize $storeSize) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreSize  $storeSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreSize $storeSize) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreSize  $storeSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreSize $storeSize) {
        //
    }

    /* Size json  */
    public function getSizeJson() {
        $sizes = StoreSize::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'data'    => $sizes,
        ], 200);
    }
}
