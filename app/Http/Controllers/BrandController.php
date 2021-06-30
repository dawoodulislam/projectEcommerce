<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add()
    {
        return view('admin.brand.add');
    }

    public function manage()
    {
        return view('admin.brand.manage', [
            'brands' => Brand::all()
        ]);
    }

    public function new(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status'  => 'required'
        ]);

        $brand = new Brand();

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->back()->with('message', 'New Brand Created Successfully');
    }

    public function edit($id)
    {
        return view('admin.brand.edit', [
            'brand' => Brand::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $brand = Brand::find($request->id);

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->save();

        return redirect('/manage-brand')->with('message', 'Brand Info Updated Successfully');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect('/manage-brand')->with('message', 'Brand Info Deleted Successfully');
    }
}
