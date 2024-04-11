<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Agregar un producto al carrito de compras.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function addToCart(Request $request)
    {
        $request->validate([
            'Quantity' => 'required|integer|min:1',
            'IdUserFk' => 'required|exists:users,id',
            'IdProductFk' => 'required|exists:products,id',
        ]);

        // Crea un nuevo elemento en el carrito de compras
        $shoppingCart = Cart::create([
            'Quantity' => $request->input('Quantity'),
            'IdUserFk' => $request->input('IdUserFk'),
            'IdProductFk' => $request->input('IdProductFk'),
        ]);

        return response()->json(['message' => 'Producto agregado al carrito'], 201);
    }
}
