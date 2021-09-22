<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $products = category::all()->toArray();
        return array_reverse($products);     
    }
    public function store(Request $request)
    {
        $product = new category([
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
        $product = category::find($id);
        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        $product = category::find($id);
        $product->update($request->all());

        return response()->json('Product updated!');
    }

    public function destroy($id)
    {
        $product = category::find($id);
        $product->delete();

        return response()->json('Product deleted!');
    }



}
