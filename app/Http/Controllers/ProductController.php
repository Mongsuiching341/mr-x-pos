<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function productsPage(Request $request)
    {
        $userId = $request->header('user_id');
        $products  = Product::with('category')->where('user_id', $userId)->get();
        return Inertia('dashboard/Products', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $userId = $request->header('user_id');

        $user = User::where('id', $userId)->first();

        $categories = $user->category;

        return Inertia('dashboard/ProductCreate', ['categories' => $categories]);
    }
    public function store(Request $request)
    {

        $validated =   $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'unit' => 'required',
            'category_id' => 'required',
        ]);

        $userId = $request->header('user_id');

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'unit' => $validated['unit'],
            'user_id' => $userId,
            'category_id' => $validated['category_id'],
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $images[] = 'uploads/' . $imageName;
            }
        }

        $product->images = json_encode($images);

        $product =  $product->save();

        if ($product) {
            return redirect('/dashboard/products')->with(['msg' => 'Product created']);
        } else {
            return Inertia('dashboard/Products', ['msg' => 'Something went wrong']);
        }
    }




    public function update(Request $request, Product $product)
    {
        $userId = $request->header('user_id');

        $categories = User::where('id', $userId)->first()->category;

        $category = $product->category;

        // $products  = Product::with('category')->where('user_id', $userId)->first();
        return Inertia('dashboard/ProductUpdate', ['product' => $product, 'category' => $category, 'categories' => $categories]);
    }

    public function edit(Request $request, Product $product)
    {
        $userId = $request->header('user_id');

        // Product::where('user_id',$userId)->update()
        $product->update(
            [

                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'category_id' => $request->input('category_id'),
            ]

        );


        if ($request->input('oldfiles')) {
            foreach ($request->input('oldfiles') as $image) {
                File::delete($image);
            }
        }

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $images[] = 'uploads/' . $imageName;
            }
        }


        $product->images = json_encode($images);

        $product->save();

        return redirect('/dashboard/products')->with(['msg' => 'updated successfully']);
        // $products  = Product::with('category')->where('user_id', $userId)->first();
        // return Inertia('dashboard/ProductUpdate', ['product' => $product, 'category' => $category, 'categories' => $categories]);
    }
}
