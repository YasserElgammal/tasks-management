<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated() + ['user_id' => auth()->id()]);

        return to_route('admin.categories.index')->with('message', 'Category Updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('admin.categories.index')->with('message', 'Category Deleted !');
    }

}
