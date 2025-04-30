<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'success' => true,
            'msg' => 'Message retryvied successfully',
            'dataCount' => $product->count(),
            'data' => $product,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate(
                [
                    'seller_id' => 'required|exists:users,id',
                    'name' => 'required|string',
                    'price' => 'required|numeric',
                    'quantity' => 'required|integer',
                    'brand' => 'required|string',
                    'model' => 'required|string',
                    'desc' => 'required|string'   
                ],
                [
                    'seller_id.required' => 'Seller is required',
                    'name.required' => 'Name is required',
                    'price.required' => 'Price is required',
                    'quantity.required' => 'Quantity is required',
                    'brand.required' => 'Brand is required',
                    'model.required' => 'Model is required',
                    'desc.required' => 'Description is required'
                ]
            );

            $product = Product::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while creating the product',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => ' Product add successfully',
            'data' => $product->load('product')
        ], 201);
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
