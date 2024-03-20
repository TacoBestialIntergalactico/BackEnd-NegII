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
        $products = Products::all();
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
                'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:30720', // Ajusta las reglas de validación según tus necesidades
                'IdcategoriesFK' => 'required'
            ]);

            // Obtener el archivo de imagen del request
            $image = $request->file('Image');

            // Guardar la imagen en el directorio de almacenamiento
            $path = $image->store('public/images');

            // Guardar el producto en la base de datos junto con la ruta de la imagen
            $product = Products::create([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Image' => $path, // Almacenar la ruta de la imagen en lugar del nombre del archivo
                'IdcategoriesFK' => $request->IdcategoriesFK
            ]);

            return response()->json(["success" => 'Producto almacenado: ' . $product], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Se produjo un error al intentar almacenar: ' . $e->getMessage()], 500);
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
    public function update(Request $request, $id)
    {
        try {
            $product = Products::findOrFail($id);
            $product->update([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Image' => $request->Image,
                'IdcategoriesFK' => $request->IdcategoriesFK
            ]);

            return response()->json(["success" => 'Product updated: ' . $product], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to update: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Products::destroy($id);
            return response()->json(["success" => 'Product deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to delete: ' . $e->getMessage()], 500);
        }
    }
}
