<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreRequest;
use App\Models\Link;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    use ApiResponse;

    public function store(StoreRequest $request)
    {

        $link = Link::create([
            'code' => $this->generateCode(8),
            'user_id' =>  auth()->user()->id,
            'url' => $request->url,
        ]);

        return $this->create($link, 'Gerado novo link');
    }

    private function generateCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
