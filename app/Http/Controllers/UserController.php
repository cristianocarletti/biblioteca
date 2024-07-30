<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $response = [];

        try {
            
            $array = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'password_confirmation' => $request->input('password_confirmation'),
            ];
            
            if( $response = User::create($array) )

                return response()->json([
                    'success' => true,
                    'message' => 'Usuário criado com sucesso.',
                    'response' => $response
                ], 201);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $response
            ], 500);
        }
    }
}
