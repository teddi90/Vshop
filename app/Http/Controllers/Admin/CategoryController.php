<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::get();
        return Inertia::render('Admin/Category/Index',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        Category::firstOrCreate([
            'name'=>$request->name,
            'slug'=>$request->slug,
        ]);
        return redirect()->route('admin.categories.index')->with('success','category successfully added');
    }

    public function update(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->update();

        return redirect()->route('admin.categories.index')->with('success','category successfully updated');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.categories.index')->with('success','category successfully deleted');

    }
}
