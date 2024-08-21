<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->paginate(10);

        return view('products',compact('products'));
    }
    //add product
    public function addProduct(Request $request){
        $request->validate(
            [
                'name'=>'required|unique:products',
                'description'=>'required',
                'price'=>'required|numeric',

            ],
            [
                'name.required'=>'Name is Required',
                'name.unique'=>'Product Already Exists',
                'description.required' => 'Description is Required',
                'price.required'=>'Price is Required',
                'price.numeric'=>'Price is Required Numeric Value',

            ]

        );

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return response()->json([
            'status'=>'success',
        ]);

    }


    //update product
    public function updateProduct(Request $request){
        $request->validate(
            [
                'up_name'=>'required|unique:products,name,'.$request->up_id,
                'up_description'=>'required',
                'up_price'=>'required|numeric',

            ],
            [
                'name.required'=>'Name is Required',
                'name.unique'=>'Product Already Exists',
                'description.required' => 'Description is Required',
                'price.required'=>'Price is Required',
                'price.numeric'=>'Price is Required Numeric Value',
            ]

        );


        Product::where('id',$request->up_id)->update([
            'name'=>$request->up_name,'description'=>$request->up_description,
            'price'=>$request->up_price,

        ]);

        return response()->json([
            'status'=>'success',
        ]);

    }
    //delete product
    public function deleteProduct(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
            'status'=>'success',

        ]);

    }

    public function pagination(Request $request){
        $products = Product::latest()->paginate(10);
        return view('pagination_products',compact('products'))->render();

    }

    //search product
    public function searchProduct(Request $request){
        $products = Product::where('name', 'like', '%'.$request->search_string.'%')
        // ->orWhere('price', 'like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        if($products->count() >= 1){
            return view('pagination_products',compact('products'))->render();

        }else{
            return response()->json([
                'status'=>'nothing_found',
            ]);

        }

    }

}
