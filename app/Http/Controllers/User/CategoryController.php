<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\CategoryFormRequest;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        return view('user.category.index', compact('category'));
    }
    public function create()
    {
        return view('user.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $category = new Category;
        $category->name = $data['name'];
        $category->slug = Str::slug($data['slug']);
        $category->description = $data['description'];
        // echo $request->hashfile('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];

        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('user/category')->with('message', 'Category Added Succesfully');
    }
    //Ediit  Category
    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('user.category.edit', compact('category'));
    }
    //Update
    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();
        $category = Category::find($category_id);
        $category->name = $data['name'];
        $category->slug = Str::slug($data['slug']);
        $category->description = $data['description'];
        // echo $request->hashfile('image');
        if ($request->hasFile('image')) {
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];

        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;
        $category->update();

        return redirect('user/category')->with('message', 'Category Updated Succesfully');
    }
    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $category->delete();
            return redirect('user/category')->with('message', 'Category Updated Succesfully');
        }
        return redirect('user/category')->with('message', 'Category ID does not found');
    }
}
