<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title'         => 'required|min:3',
            'price'         => 'nullable|integer',
            'e_price'       => 'nullable|integer',
            'description'   => 'required|min:3',
            'short_desc'    => 'nullable|string',
            'meta_keywords' => 'nullable|array',
            'categories'    => 'nullable|array',
            'image1'        => 'required|string',
            'image2'        => 'nullable|string',
            'image3'        => 'nullable|string',
        ]);

        $product = new Product();
        $product->user_id       = Auth::id();
        $product->title         = $request->title;
        $product->price         = $request->price;
        $product->e_price       = $request->e_price;
        $product->description   = $request->description;
        $product->meta_keywords = collect($request->meta_keywords)->implode(',');
        $product->image1        = $request->image1;
        $product->image2        = $request->image2;
        $product->image3        = $request->image3;
        $product->short_desc    = $request->short_desc;
        $product->save();

        $product->categories()->sync($validData['categories']);

        alert('done!', 'Your operation done successfully.', 'success')->autoClose(1000);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validData = $request->validate([
            'title'         => 'required|min:3',
            'price'         => 'nullable|integer',
            'e_price'       => 'nullable|integer',
            'description'   => 'required|min:3',
            'short_desc'    => 'nullable|string',
            'meta_keywords' => 'nullable|array',
            'categories'    => 'nullable|array',
            'image1'        => 'required|string',
            'image2'        => 'required|string',
            'image3'        => 'required|string',
        ]);

        $product->user_id       = Auth::id();
        $product->title         = $request->title;
        $product->price         = $request->price;
        $product->e_price         = $request->e_price;
        $product->description   = $request->description;
        $product->meta_keywords = collect($request->meta_keywords)->implode(',');
        $product->image1         = $request->image1;
        $product->image2         = $request->image2;
        $product->image3         = $request->image3;
        $product->short_desc    = $request->short_desc;
        $product->update();

        $product->categories()->sync($validData['categories']);
        alert('done!', 'Your product edited successfully.', 'success')->autoClose(1000);
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
