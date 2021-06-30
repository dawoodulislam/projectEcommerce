<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add()
    {
        return view('admin.category.add');
    }

    public function manage()
    {
        return view('admin.category.manage', [
            'categories' => Category::all()
        ]);
    }

    public function new(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        $category->save();

        return redirect()->back()->with('message', 'New Category Created Successfully!');
    }

    public function edit($id)
    {
        return view('admin.category.edit', [
            'category' => Category::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        $category->save();

        return redirect('/manage-category')->with('message', 'Category Info Updated Successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/manage-category')->with('message', 'Category Deleted Successfully');
    }
}
