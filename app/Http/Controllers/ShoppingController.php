<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shoppings=shoppings::all();
        return $shoppings;

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
            'Quantity'=>'required',
            'IdUserFk'=>'required',
            'IdProductFk'=>'required'
        ]);
        $shoppings=shoppings::create([
            'Quantity'=>$request->Quantity,
            'IdUserFk'=>$request->IdUserFk,
            'IdProductFk'=>$request->IdProductFk
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shopping $shopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shopping $shopping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shopping $shopping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        shoppings::destroy($id);
    }
}
