<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products=products::all();
        return $products;
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
        //
        $request->validate([
            'Name'=>'required',
            'Description'=>'required',
            'Price'=>'required',
            'Image'=>'required',
            'IdcategoriesFK'=> 'required'
        ]);
        $products=products::create([
            'Name'=>$request->Name,
            'Description'=>$request->Description,
            'Price'=>$request->Price,
            'Image'=>$request->Image,
            'IdcategoriesFK'=> $request->IdcategoriesFK
        ]);
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
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
        products::destroy($id);
    }
}
