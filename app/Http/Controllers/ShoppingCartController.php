<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingCart = ShoppingCart::all();
        return response()->json([
            'success' => true,
            'msg' => 'Shopping cart retryvied successfully',
            'dataCount' => $shoppingCart->count(),
            'cart' => $shoppingCart->load('user', 'product'),
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
        {
            try {
                $request->validate(
                    [
                        'product_id' => 'required|exists:products,id',
                        'user_id' => 'required|exists:users,id',
    
                    ],
                    [
                        'product_id.required' => 'Product is required',
                        'product_id.exists' => 'Product must be a valid Shopping Cart',
                        'user_id.required' => 'User must be a valid user',
                        'user_id.exists' => 'User must be a valid Shopping Cart',
    
                    ]
                );
    
                $shoppingCart = ShoppingCart::create($request->all());
            } catch (\Exception $error) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Error occurred while adding product to shopping cart',
                    'error' => $error->getMessage(),
                ], 500);
            }
    
            return response()->json([
                'success' => true,
                'msg' => ' Product add to shopping cart successfully',
                'cart' => $shoppingCart->load('user','product')
            ], 201);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $cart = ShoppingCart::findOrFail($id);
            $cart->delete();

            return response()->json([
                'succes' => true,
                'msg' => "Produt deleted successfully from cart"
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while deleting product from cart',
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
