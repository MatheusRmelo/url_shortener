<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\LinkRegister;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    use ApiResponse;

    public function open(Request $request)
    {
        $link = Link::where('slug', $request->slug)->first();
        if(!$link){
            return $this->notFound(null, 'Slug não encontrado');
        }

        $register = LinkRegister::create([
            'link_id' => $link->id,
            'request_ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        $link->update([
            'hits' => $link->hits + 1
        ]);

        return $this->success($link->url, 'Sucesso ao encontrar link');
    }
}
