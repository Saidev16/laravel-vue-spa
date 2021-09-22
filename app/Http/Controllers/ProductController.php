<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);      
    }

    public function store(Request $request)
    {
        $product = new Product([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'quantity'=> $request->input('quantity'),
            'status'=> $request->input('status'),

        ]);
        $product->save();

        return response()->json('Product created!');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json('Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Product deleted!');
    }
    public function changeStatus($id){
        $product = Product::find($id);
        if($product->status == 'active'){
            $product->status ='inactive';
        }else{
            $product->status ='active';
        }
        $product->save();
        return Redirect::back();
    }

}
