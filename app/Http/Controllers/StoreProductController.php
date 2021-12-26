<?php

namespace App\Http\Controllers;

use App\ProductSizeStock;
use App\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = StoreProduct::with(['category', 'brand'])->orderBy('id', 'desc')->get()->toArray();
        return view('layouts.admin_layouts.store_product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('layouts.admin_layouts.store_product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        // save product
        $product = new StoreProduct();
        $product->user_id = Auth::guard('admin')->id();
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->name = $data['name'];
        $product->sku = $data['sku'];
        $product->cost_price = $data['cost_price'];
        $product->retail_price = $data['retail_price'];
        $product->year = $data['year'];
        $product->description = $data['description'];

        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = Str::random(50) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/product-image', $name);
            $product->image = $name;
        }

        $product->save();

        // save product size stocks
        if ($request->items) {
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id = $item->size_id;
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                $size_stock->save();
            }
        }

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreProduct  $storeProduct
     * @return \Illuminate\Http\Response
     */
    public function show(StoreProduct $storeProduct) {
        return view('layouts.admin_layouts.store_product.show', compact('storeProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreProduct  $storeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreProduct $storeProduct) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreProduct  $storeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreProduct $storeProduct) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreProduct  $storeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreProduct $storeProduct) {
        //
    }
}
