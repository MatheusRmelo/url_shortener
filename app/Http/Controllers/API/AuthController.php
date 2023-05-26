<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->unauthorized(null, 'E-mail e/ou senha inválidos');
        }

        return $this->success($user->createToken($request->device)->plainTextToken, 'Sucesso ao realizar login');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            return $this->forbidden(null, 'Esse e-mail não está disponível');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->create($user->createToken('first-use')->plainTextToken, 'Sucesso ao criar o usuário');
    }

    public function validadeUser(Request $request)
    {
        $token = $request->session()->get('token');
        return $token;
    }
}
