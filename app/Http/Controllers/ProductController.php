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


        $images = [];

        /* 
        //checking files in oldafiles if it's exist or not in newImages, if it is exist then don't 
        delete and if it is not exist delete it from upload folder 
        also adding newImg into images array 

        ====
        Here we are getting string type data so that we used $request->input('images')
        */
        if ($request->input('oldFiles')) {

            $oldImages = $request->input('oldFiles');
            $newImages = $request->input('images') ?? [];

            $deleteThisImg =   array_diff($oldImages, $newImages);

            foreach ($newImages as $img) {
                $images[] = $img;
            }


            if ($deleteThisImg) {

                foreach ($deleteThisImg as $img) {
                    File::delete($img);
                }
            }
        }


        /* 
        We are getting two types data from frontend 
        1- with files 2- without files 
        =====
        here we are checking if request has file then loop it 
        add files to images array also upload it to upload folder
        */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (!empty($image)) {

                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $imageName);
                    $images[] = 'uploads/' . $imageName;
                }
            }
        }



        $product->images = json_encode($images);

        $product->save();

        return redirect('/dashboard/products')->with(['msg' => 'updated successfully']);
    }


    public function destroy(Product $product)
    {

        $images = $product->image;
        foreach ($images as $image) {
            File::delete($image);
        }

        $delete = $product->delete();


        if ($delete) {
            return redirect()->route('products')->with(['msg' => 'Product deleted']);
        } else {
            return redirect()->route('products')->with(['msg' => 'Something went wrong']);
        }
    }
}
