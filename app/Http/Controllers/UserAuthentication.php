<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;


class UserAuthentication extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();
        return $user;
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
    public function login(Request $request){

            $request->validate([
                'email'=>'required',
                'password'=>'required'
            ]);
            $user = User::where('email', $request->email)->first();
            if(!$user|| !Hash::check($request->password, $user->password)){
                return response([
                    'message'=>'The provided credential are incorrect'

                ], 401);
            }
            $token=$user->createToken('auth_token')->accessToken;

            return response([
                'token'=> $token
            ]);


    }
    public function storeRegister(Request $request)
    {
        //
        try {
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'confirmPassword' => 'required|same:password'

            ]);

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response("Successful registration"); // Cambiado de 'respose' a 'response'
        } catch (Exception $e) {
            return response("error", $e->getMessage()); // Corregido el método de acceso a getMessage()
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function User(){
        try{
            $user = auth()->user();

            // Verifica si el usuario está autenticado
            if ($user) {
                return response()->json([
                    'id'=> $user->id,
                    'email' => $user->email,
                    'name' => $user->username,
                    'role'=>$user->role,
                    // Otros datos del usuario si es necesario
                ]);
            }


        }catch(Exception $e){
            return response()->json(['error' => 'Se produjo un error al obtener usuario: ' . $e->getMessage()], 500);
           }

    }
}
