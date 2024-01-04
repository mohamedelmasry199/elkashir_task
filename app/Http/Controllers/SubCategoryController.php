<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'image' => 'required|image', // Add image validation rules,
            'category_id' => 'required|exists:categories,id',
        ]);
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
        $request->file('image')->move('storage/images',$imageName);
        $category = Category::find($request->category_id);


        if (!$category) {
            return redirect()->back()->withInput()->withErrors(['category_id' => 'Selected category not found.']);
        }
        SubCategory::create([
            'name' => $request->name,
            'image' => $imagePath,
            'category_id' => $category->id
        ]);
        return redirect()->route('categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subCategory=SubCategory::find($id);
        return view('subcategory.update',compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $subCategory=SubCategory::find($id);
        if ($subCategory) {
            $request->validate([
                'name' => 'required|string|min:3|max:25',
                'image' => 'image',
                'category_id' => 'required|exists:categories,id',
            ]);
            $oldImage=$subCategory->image;
            if ($request->hasFile('image')) {
                // Use the original image name for the updated image
                $imageName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
                $request->file('image')->move('storage/images' , $imageName );
            }
            else{
                $imagePath = $subCategory->image;
            }
            $subCategory->update([
                'name' => $request['name'],
                'image' => $imagePath,
                'category_id' => $request['category_id'],
            ]);
            if(!$oldImage){
                unlink($oldImage);
               }
            return redirect()->route('categories.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
    // $oldImage=$subCategory->image;
    if ($subCategory) {
        $categoryId = $subCategory->category_id;
        $category = Category::where('id', $categoryId)->value('name');
        $subCategory->delete();
        // unlink($oldImage);
        return redirect()->route('categories.show',compact('category'));
    }
    else
    // Handle the case when the product is not found
    return redirect()->back()->with('error', 'Product not found.');
}
    }

