<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\LinkRegister;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function open(Request $request)
    {
        $link = Link::where('slug', $request->slug)->first();
        if(!$link){
            return view('notfound', ['slug' => $request->slug]);
        }

        $register = LinkRegister::create([
            'link_id' => $link->id,
            'request_ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        $link->update([
            'hits' => $link->hits + 1
        ]);

        return redirect($link->url);
    }
}
