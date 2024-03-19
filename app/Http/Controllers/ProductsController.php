<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = products::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'Name' => 'required',
                'Description' => 'required',
                'Price' => 'required',
                'Image' => 'required',
                'IdcategoriesFK' => 'required'
            ]);

            $products = products::create([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Image' => $request->Image,
                'IdcategoriesFK' => $request->IdcategoriesFK
            ]);
            return response()->json(["succes" => 'product stored: ' + $products], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurred when trying to store: ' + $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Products::findOrFail($id);

            $request->validate([
                'Name' => 'required',
                'Description' => 'required',
                'Price' => 'required',
                'Image' => 'required',
                'IdcategoriesFK' => 'required'
            ]);

            $product->update([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Image' => $request->Image,
                'IdcategoriesFK' => $request->IdcategoriesFK
            ]);

            // Rest of your code (if any) goes here...

            return response()->json(["success" => "Product updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            products::destroy($id);
            return response()->json(["success" => "success while deleting"], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurred when trying to delete: ' + $e->getMessage()], 500);
        }
    }
}
