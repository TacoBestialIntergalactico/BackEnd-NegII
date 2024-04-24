<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Shopping;

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

    public function getCartProducts($userId)
    {
        // Obtener los registros del carrito para el usuario dado
        $cartEntries = Cart::where('IdUserFk', $userId)->get();

        // Array para almacenar los detalles completos de los productos del carrito
        $cartProducts = [];

        // Iterar sobre cada entrada del carrito
        foreach ($cartEntries as $cartEntry) {
            // Obtener los detalles completos del producto asociado a esta entrada del carrito
            $product = $cartEntry->product()->first();

            // Verificar si se encontró el producto
            if ($product) {
                // Agregar los detalles del producto al array de productos del carrito
                $cartProducts[] = [
                    'cart_id' => $cartEntry->id, // ID de la tabla carts
                    'product' => $product
                ];
            }
        }

        // Devolver los detalles completos de los productos del carrito
        return response()->json($cartProducts);
    }

    public function removeProductFromCart($cartId)
    {
        // Aquí puedes implementar la lógica para eliminar el producto del carrito
        // Por ejemplo:
        Cart::where('id', $cartId)->delete();

        // Puedes devolver una respuesta apropiada según el resultado de la eliminación
        return response()->json(['message' => 'Producto eliminado del carrito con éxito']);
    }

    public function moveCartsToShoppings($cartId)
    {
        // Obtener el registro del carrito basado en el cart_id proporcionado
        $cart = Cart::findOrFail($cartId);

        // Crear un registro correspondiente en la tabla shoppings
        Shopping::create([
            'Quantity' => $cart->Quantity,
            'IdUserFk' => $cart->IdUserFk,
            'IdProductFk' => $cart->IdProductFk,
        ]);


        // Eliminar los registros de carts una vez movidos a shoppings
        Cart::where('id', $cartId)->delete();


        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Los registros de carts se han movido a shoppings exitosamente']);
    }

}
