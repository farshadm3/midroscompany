<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function single(Request $request, $slug)
    {
        $product = Product::whereSlug($slug)->first();
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::take(4)->get();

        return view('home.single',compact('product','categories','products'));
    }
}
