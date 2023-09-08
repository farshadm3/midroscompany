<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        return  view('admin.categories.all',compact('categories'));
    }

    public function getSub(Category $category)
    {
        return response()->json([
            'data' => $category->child,
            'parents' => $category->getParentsAttribute()
        ]);
    }

    public function getParent()
    {
        $category = Category::where('parent_id', 0)->latest()->get();
        return response()->json([
            'data' => $category,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'image'      => 'nullable',
        ]);
        if($request->parent_id) {
            $request->validate([
                'parent_id' => 'required|int|exists:categories,id'
            ]);
        }

        $response = Category::create([
            'name' => $request->name,
            'image'     => $request->image,
            'status'    => 1,
            'parent_id' => $request->parent_id ?? 0
        ]);

        return response()->json([
            'category' =>new CategoryResource($response)
        ], Response::HTTP_CREATED);
    }

    public function changeStatus(Request $request, Category $category)
    {
        $validData = $request->validate([
            'status'    => 'required|boolean'
        ]);
        return $category->update($validData);
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
    public function edit(Category $category)
    {
        return response()->json([
            'category'  => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required',
            'image'      => 'nullable',
        ]);

        $response = $category->update([
            'name'  => $request->name,
            'image'  => $request->image,
        ]);

        if ($response) {
            return response()->json([
                'category'   => $category
            ], Response::HTTP_ACCEPTED);
        }

        return response()->json([
            'عملیات شما با مشکل مواجه شد!لطفا مجددا تلاش نمایید.'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): bool
    {
        $category->delete();
        return true;
    }
}
