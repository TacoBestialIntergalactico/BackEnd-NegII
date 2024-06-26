<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return response()->json($products);
    }

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
                'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Ajusta las reglas de validación según tus necesidades
                'IdcategoriesFK' => 'required'
            ]);

            // Obtener el archivo de imagen del request
            $image = $request->file('Image');

            // Guardar la imagen en el directorio de almacenamiento
            $path = $image->store('');

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

    public function show($id)
    {
        try {
            $product = Products::findOrFail($id);
            return response()->json($product);
        } catch (Exception $e) {
            return response()->json(['error' => 'Se produjo un error al intentar mostrar: ' . $e->getMessage()], 500);
        }
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
            $imagePath = $request->file('Image')->store('');

            $product->update([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Image' => $imagePath,
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
    public function destroy($id)
    {
        try {
            Products::destroy($id);
            return response()->json(["success" => 'Product deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to delete: ' . $e->getMessage()], 500);
        }
    }
}
