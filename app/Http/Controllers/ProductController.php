<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProductController extends Controller
{
    public function showProductListing()
    {
        $product = Product::get();
        return view('auth.productlisting', compact('product'));
        // return view('auth.productlisting', [
        //     'product' = $product
        // ]);

    }

   public function showProductFrom()
    {
        return view('auth.productform');
    }

// return redirect('/productform');

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

    // \DB::table('products')->insert([
    //     'product_name' => $request->name,
    //     'product_price' => $request->price,
    //     'created_at' => now(),
    //     'updated_at' => now(),
    // ]);

    Product::create([
        'product_name' => $request->name,
        'product_price' =>$request->price
    ]);

     return redirect()->route('productlisting')->with('success', 'Product added successfully!');
}




}
