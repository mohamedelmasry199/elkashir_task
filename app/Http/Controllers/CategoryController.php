<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view("categories",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');

    }

    /**
     * Store a newly created resource in storage.
     */
    function store(Request $request){
        $request->validate([
            'name'=>'required|string|min:3|max:25',
            'image'=>'required',
        ]);
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
        $request->file('image')->move('storage/images',$imageName);
        Category::create([
            'name'=>$request['name'],
            'image'=>$imagePath,
        ]);
        return redirect()->route('categories.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($category) //show subCategories
    {
        $category = Category::where('name', $category)->firstOrFail();
        $subcategories = $category->subcategories()->get();
        return view('subcategory.subCategories', compact('category', 'subcategories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('update',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        if ($category) {
            $request->validate([
                'name' => 'required|string|min:3|max:25',
                'image' => 'required|image',
            ]);
             $oldImage=$category->image;
            if ($request->hasFile('image')) {
                // Use the original image name for the updated image
                $imageName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
                $request->file('image')->move('storage/images' , $imageName);
            }
            $category->update([
                'name' => $request['name'],
                'image' => $imagePath,
            ]);
            //  unlink($oldImage);

            return redirect()->route('categories.index');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        //   $oldImage=$category->image;
          if ($category) {
             $category->delete();
            //  unlink($oldImage);
             return redirect()->route('categories.index');
    }
    else {
    // Handle the case when the product is not found
    return redirect()->back()->with('error', 'category not found.');
    }
}
}
