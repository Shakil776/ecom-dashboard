<?php

namespace App\Http\Controllers;

use App\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreCategoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = StoreCategory::get()->toArray();
        return view('layouts.admin_layouts.store_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('layouts.admin_layouts.store_category.create');
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

        $customMessages = ['name.required' => 'Category name is required.'];

        $this->validate($request, $rules, $customMessages);

        StoreCategory::create(['name' => $request->name]);

        Session::flash('success', 'Category Added Successfully.');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /* Category json  */
    public function getCategoryJson() {
        $categories = StoreCategory::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'data'    => $categories,
        ], 200);
    }
}
