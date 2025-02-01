<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function showProductListing(Request $request)
    {
        $products = Product::get();

        if ($request->ajax()) {
            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('product_name', function($model) {
                    return $model->product_name;
                })
                ->editColumn('product_price', function($model) {
                    return number_format($model->product_price, 2);
                })
                ->editColumn('created_at', function ($model) {
                    return Carbon::parse($model->created_at)->format('M d h:i');
                })
                ->addColumn('action', function ($model) {
                    $html = "";
                    $html .="<button class='edit_button' data-id='" . $model->id . "'>Edit</button>";
                    $html .= "<button class='delete_button' data-id='" . $model->id . "'>Delete</button>";
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth.productlisting');
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

    public function delete($id) {
        $product = Product::find($id);

        $product->delete();

        return response()->json(['Product delete successfully']);
    }

    public function edit($id)
{
    $product = Product::find($id);
    if ($product) {
        return response()->json($product);
    }
    return response()->json(['error' => 'Product not found'], 404);
}

public function update(Request $request, $id)
{
    $product = Product::find($id);
    if ($product) {
        $product->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
        ]);
        return response()->json(['success' => 'Product updated successfully.']);
    }
    return response()->json(['error' => 'Product not found'], 404);
}



}
