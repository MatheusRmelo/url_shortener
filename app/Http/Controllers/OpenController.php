<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function open(Request $request)
    {
        $link = Link::where('slug', $request->slug)->first();
        if(!$link){
            return view('notfound', ['slug' => $request->slug]);
        }

        /**
         * @TODO Save informations about user that click in link
         */
        return redirect($link->url);
    }
}
