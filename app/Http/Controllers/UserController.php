<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'success' => true,
            'msg' => 'Users retryvied successfully',
            'dataCount' => $user->count(),
            'users' => $user->load('product')
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
                        'name' => 'required|string',
                        'password' => 'required|string',
                        'email' => 'required|string'
                    ],
                    [
                        'name.required' => 'Name is required',
                        'email.required' => 'Email is required',
                        'password.required' => 'Password is required',
                    ]
                );
    
                $user = User::create($request->all());
            } catch (\Exception $error) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Error occurred while create user',
                    'error' => $error->getMessage(),
                ], 500);
            }

            return response()->json([
                'success' => true,
                'msg' => ' User created successfully',
                'data' => $user
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
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'password' => 'required|string',
                    'email' => 'required|string'
                ],
                [
                    'name.required' => 'Name is required',
                    'email.required' => 'Email is required',
                    'password.required' => 'Password is required',
                ]
            );
            $user = User::findOrFail($id);
            $user->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while updating message',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => "User updated successfully",
            'user' => $user
        ], 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'succes' => true,
                'msg' => "User deleted successfully"
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while deleting user',
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
