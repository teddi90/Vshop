<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        $brands=Brand::get();
        return Inertia::render('Admin/Brand/Index',['brands'=>$brands]);
    }

    public function store(Request $request)
    {
        Brand::firstOrCreate([
            'name'=>$request->name,
            'slug'=>$request->slug,
        ]);
        return redirect()->route('admin.brands.index')->with('success','Brand created successfully.');
    }
    public function update(Request $request, $id){
        $brand=Brand::findOrFail($id);
        $brand->name=$request->name;
        $brand->slug=$request->slug;
        $brand->update();

        return redirect()->back()->with('success','Brand updated successfully.');
    }
    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect()->back()->with('success','Brand deleted successfully.');
    }
}
