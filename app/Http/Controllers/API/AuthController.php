<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => 'E-mail e/ou senha inválidos',
                'password' => 'E-mail e/ou senha inválidos'
            ]);
        }

        return $this->success($user->createToken($request->userAgent() ?? "no device")->plainTextToken, 'Sucesso ao realizar login');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            throw ValidationException::withMessages([
                'email' => 'Esse e-mail não está disponível',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->create($user->createToken($request->userAgent() ?? "no device")->plainTextToken, 'Sucesso ao criar o usuário');
    }
}
