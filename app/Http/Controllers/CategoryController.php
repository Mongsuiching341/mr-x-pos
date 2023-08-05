<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $userId = $request->header('user_id');

        $categories = User::where('id', $userId)->first()->category;

        return Inertia('dashboard/Category', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia('dashboard/CategoryCreate');
    }
    public function store(Request $request)
    {

        $userId = $request->header('user_id');

        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);

        $category =  Category::create([
            'name' => $validated['name'],
            'user_id' => $userId,
        ]);

        if ($category) {
            return redirect('/dashboard/products/categories')->with(['msg' => 'Category Created']);
        } else {
            // return redirect('/dashboard/products/categories')->with(['msg' => 'Something went wrong']);
        }
    }

    public function update(Request $request, Category $category)
    {
        return Inertia('dashboard/CategoryUpdate', ['category' => $category]);
    }

    public function edit(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);
        $updated = $category->update([
            'name' => $validated['name'],
        ]);

        if ($updated) {
            return redirect('/dashboard/products/categories')->with(['msg' => 'Category Updated']);
        } else {
            return redirect('/dashboard/products/categories')->with(['msg' => 'Something went wrong']);
        }
    }

    public function destroy(Category $category)
    {
        $deleted = $category->delete();

        if ($deleted) {
            return redirect('/dashboard/products/categories')->with(['msg' => 'Category deleted']);
        } else {
            return redirect('/dashboard/products/categories')->with(['msg' => 'Something went wrong']);
        }
    }
}
