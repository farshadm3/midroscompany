<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
//        $categories = Category::where('parent_id', 0)->get();
//        $products = Product::all();
//        $slides = Product::where('image1','/images/image0.jpeg')->get();
//        $tslides = Product::where('image1','<>','/images/image0.jpeg')->get();
//
//        $vapes = Category::where('name','Vape')->take(10)->get();
//        $cigarettes = Category::where('name','Cigarettes')->take(10)->get();
//        $tobaccos = Category::where('name','Tobacco')->take(10)->get();
//        $pipes = Category::where('name','Pipe')->take(10)->get();

//        return view('home.home', compact('categories','products','vapes','cigarettes','tobaccos','pipes',
//            'slides','tslides'));
    }
}
