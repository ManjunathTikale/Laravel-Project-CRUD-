<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = product::orderBy('created_at','DESC')->get();
        return view('products.list', [
        'products' => $products
    ]);

    }

    public function create() {
        return view('products.create');
    }

    // This method will store the product in the database
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];
        if ($request->image != "") {
            $rule['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // Your logic to save the product goes here
        //Here we will insert Product in Database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


    if ($request->image != "") {
            
        
        //here we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;  // Unique image name

        //save image to products directory
        $image->move(public_path('uploads/products'), $imageName);

        //save image to products directory
        $product->image = $imageName;
        $product->save();
    }


        //Save Image Name in DataBase
        $product->description = $request->description;
        $product->save();



       
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
 
    }
    //This Method Will Show Edit Product Page
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
        

    }

    public function update($id, Request $request) {
        
        $product = Product::findOrFail($id);
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];
        if ($request->image != "") {
            $rule['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        // Your logic to save the product goes here
        //Here we will update Product in Database
        
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


    if ($request->image != "") {
        //delete old image
        
           File::delete(public_path('uploads/products/'.$product->image));
        
        //here we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;  // Unique image name

        //save image to products directory
        $image->move(public_path('uploads/products'), $imageName);

        //save image to products directory
        $product->image = $imageName;
        $product->save();
    }


        //Save Image Name in DataBase
        $product->description = $request->description;
        $product->save();



       
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
 
    }

    
 
    public function destroy($id ) {
        $product = Product::findOrFail($id);

        //delete image
        File::delete(public_path('uploads/products/'.$product->image));

        //delete product from DB
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
